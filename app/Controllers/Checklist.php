<?php

namespace App\Controllers;

use App\Models\Array_daftarSopIk;
use App\Models\Daftar_pertanyaanModel;
use App\Models\ChecklistModel;
use App\Models\JawabanModel;
use App\Models\KomenModel;
use Myth\Auth\Models\UserModel;
use App\Models\Array_formchecklist;
use App\Models\AtasanModel;
use \Mpdf\Mpdf;

class Checklist extends BaseController
{
    protected $daftar_pertanyaanModel;
    protected $checklistModel;
    protected $jawabanModel;
    protected $komenModel;
    protected $userModel;
    protected $atasanModel;
    public function __construct()
    {
        $this->daftar_pertanyaanModel = new Daftar_pertanyaanModel();
        $this->checklistModel = new ChecklistModel();
        $this->jawabanModel = new JawabanModel();
        $this->komenModel = new KomenModel();
        $this->userModel = new UserModel();
        $this->atasanModel = new AtasanModel();
    }


    public function index()
    {
        $peralatan = new Array_daftarSopIk();

        $data = [
            'title' => 'pilih sop ik',
            'peralatan' => $peralatan->semuaPeralatan()
        ];

        return view('checklist/index', $data);
    }

    public function pilihPeralatan($peralatan)
    {
        $pertanyaan = $this->daftar_pertanyaanModel->where(['untuk' => $peralatan])->findAll();
        $data = [
            'title' => $peralatan,
            'pertanyaan' => $pertanyaan,
            'validation' => \Config\Services::validation()
        ];
        return view('checklist/peralatan', $data);
    }

    public function simpan()
    {
        $keyDataValidate = [];
        $valueDataValidate = [];
        for ($i = 1; $i <= $this->request->getVar('jumlahPertanyaan'); $i++) {
            $keyDataValidate[] = 'pertanyaan' . $i;
            $valueDataValidate[] = 'required';
        }

        $dataValidate = array_combine($keyDataValidate, $valueDataValidate);

        if (!$this->validate($dataValidate)) {
            return redirect()->to(base_url('/checklist/' . $this->request->getVar('namaPeralatan')))->withInput();
        }

        //insert ke tabel checklist

        $this->checklistModel->save([
            'tanggal' => date('d-m-Y'),
            'diinput_oleh' => user()->username,
            'namaPeralatan' => $this->request->getVar('namaPeralatan'),
            'catatan' => $this->request->getVar(htmlspecialchars('catatan'))
        ]);

        //data tabel jawaban

        $keyJawaban = ['diinput_oleh'];
        $valueJawaban = [user()->username];
        for ($i = 1; $i <= $this->request->getVar('jumlahPertanyaan'); $i++) {
            array_push($keyJawaban, 'jawaban' . $i);
            array_push($valueJawaban, $this->request->getVar("pertanyaan" . $i));
        }
        $jawaban = array_combine($keyJawaban, $valueJawaban);

        //data tabel komen

        $keyKomen = ['diinput_oleh'];
        $valueKomen = [user()->username];
        for ($i = 1; $i <= $this->request->getVar('jumlahPertanyaan'); $i++) {
            array_push($keyKomen, 'komen' . $i);
            array_push($valueKomen, $this->request->getVar("komen" . $i));
        }
        $komen = array_combine($keyKomen, $valueKomen);

        //lakukan inser ke tabel jawaban dan komen

        $this->jawabanModel->setAllowedFields($keyJawaban);
        $this->komenModel->setAllowedFields($keyKomen);
        $this->jawabanModel->save($jawaban);
        $this->komenModel->save($komen);

        session()->setFlashdata('pesan', 'Data Cheklist berhasil ditambahkan. Setelah diapprove oleh atasan anda dapat mendownloadnya pada halaman approved');

        return redirect()->to('checklist/' . $this->request->getVar('namaPeralatan'));
    }

    public function print($id = null)
    {
        $mpdf = new Mpdf();

        $checklist = $this->checklistModel->where(['diinput_oleh' => user()->username])->orderBy('id', 'desc')->first();
        $jawaban = $this->jawabanModel->where(['diinput_oleh' => user()->username])->orderBy('id', 'desc')->first();
        $komen = $this->komenModel->where(['diinput_oleh' => user()->username])->orderBy('id', 'desc')->first();

        if ($id != null) {
            $checklist = $this->checklistModel->where(['id' => $id])->orderBy('id', 'desc')->first();
            $jawaban = $this->jawabanModel->where(['id' => $id])->orderBy('id', 'desc')->first();
            $komen = $this->komenModel->where(['id' => $id])->orderBy('id', 'desc')->first();
        }

        $pegawai = $this->userModel->asArray()->where(['username' => $checklist['diinput_oleh']])->first();
        $atasan = $this->atasanModel->where('bawahan', $pegawai['bidang'])->first();
        $detailAtasan = $this->userModel->asArray()->where('fullname', $atasan['nama'])->first();

        $pertanyaan = $this->daftar_pertanyaanModel->where(['untuk' => $checklist['namaPeralatan']])->findAll();

        $ttd = ['<br><br><br><br>', '<br><br><br><br>'];
        if ($detailAtasan['signature'] != '') {
            if (file_exists('img-ttd/' . $detailAtasan['signature'])) {
                $ttd[0] = '<img src="img-ttd/' . $detailAtasan["signature"] . '" width="70px" height="70px">';
            }
        }
        if ($pegawai['signature'] != '') {
            if (file_exists('img-ttd/' . $pegawai['signature'])) {
                $ttd[1] = '<img src="img-ttd/' . $pegawai["signature"] . '" width="70px" height="70px">';
            }
        }

        $i = 1;
        $jwb = [];
        foreach ($pertanyaan as $row) {
            if ($jawaban["jawaban$i"] == "ya") {
                $jwb[] = ["&#9745", "&#9744"];
            } elseif ($jawaban["jawaban$i"] == "tidak") {
                $jwb[] = ["&#9744", "&#9745"];
            }
            $i++;
        }

        $arrayFormChecklist = new Array_formchecklist();

        $hdata = [
            'namaPeralatan' => $checklist['namaPeralatan'],
            'nomorfm' => $arrayFormChecklist->getForm($checklist['namaPeralatan'])[0],
            'revisi' => $arrayFormChecklist->getForm($checklist['namaPeralatan'])[1],
            'tanggal' => $arrayFormChecklist->getForm($checklist['namaPeralatan'])[2]
        ];

        $data = [
            'checklist' => $checklist,
            'jawaban' => $jawaban,
            'komen' => $komen,
            'pegawai' => $pegawai,
            'atasan' => $atasan,
            'ttd' => $ttd,
            'pertanyaan' => $pertanyaan,
            'jwb' => $jwb
        ];

        // $html = 'hello world';

        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->SetHTMLHeader(view('checklist/hprint', $hdata));
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->WriteHTML(view('checklist/print', $data));
        return $mpdf->Output($checklist['id'] . ' ' . $checklist['namaPeralatan'] . ' checklist.pdf', "D");
    }
}
