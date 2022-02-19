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
    protected $daftar_pertanyaanModel, $checklistModel, $jawabanModel, $komenModel, $userModel, $atasanModel;
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
        $users = $this->userModel->asArray()->where(['bidang' => user()->bidang, 'username !=' => user()->username])->findAll();
        $pertanyaan = $this->daftar_pertanyaanModel->where(['untuk' => $peralatan])->findAll();

        $data = [
            'title' => $peralatan,
            'pertanyaan' => $pertanyaan,
            'users' => $users,
            'validation' => \Config\Services::validation()
        ];
        return view('checklist/peralatan', $data);
    }

    public function simpan()
    {
        if (user()->signature == '') {
            session()->setFlashdata('pesanWarning', 'masukkan tanda tangan terlebih dahulu');
            return redirect()->to(base_url('/profil'));
        }

        $users = $this->userModel->asArray()->where(['bidang' => user()->bidang, 'username !=' => user()->username])->findAll();

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

        $friend = [];
        foreach ($users as $user) {
            if ($this->request->getVar($user['username'])) {

                if ($user['signature'] == '') {
                    $teman = $user['fullname'];
                    session()->setFlashdata('pesanWarning', $teman . ' belum memiliki tanda tangan');
                    return redirect()->to(base_url('/checklist/' . $this->request->getVar('namaPeralatan')))->withInput();
                }

                $friend[] = $this->request->getVar($user['username']);
            }
        }

        if (count($friend) >= 3) {
            session()->setFlashdata('pesanWarning', 'jumlah teman maksimal 2 orang');
            return redirect()->to(base_url('/checklist/' . $this->request->getVar('namaPeralatan')))->withInput();
        }

        if ($friends = implode(' | ', $friend)) {
            $friends = ' | ' . implode(' | ', $friend);
        }

        //data tabel checklist

        $checklist = [
            'tanggal' => date('Y-m-d H:i:s'),
            'diinput_oleh' => user()->username . $friends,
            'namaPeralatan' => $this->request->getVar('namaPeralatan'),
            'catatan' => $this->request->getVar(htmlspecialchars('catatan'))
        ];

        //data tabel jawaban

        $keyJawaban = ['diinput_oleh'];
        $valueJawaban = [user()->username . $friends];
        for ($i = 1; $i <= $this->request->getVar('jumlahPertanyaan'); $i++) {
            array_push($keyJawaban, 'jawaban' . $i);
            array_push($valueJawaban, $this->request->getVar("pertanyaan" . $i));
        }
        $jawaban = array_combine($keyJawaban, $valueJawaban);

        //data tabel komen

        $keyKomen = ['diinput_oleh'];
        $valueKomen = [user()->username . $friends];
        for ($i = 1; $i <= $this->request->getVar('jumlahPertanyaan'); $i++) {
            array_push($keyKomen, 'komen' . $i);
            array_push($valueKomen, $this->request->getVar("komen" . $i));
        }
        $komen = array_combine($keyKomen, $valueKomen);

        // dd($checklist);

        //lakukan inser ke tabel checklist, jawaban dan komen

        $this->checklistModel->setAllowedFields(array_keys($checklist));
        $this->jawabanModel->setAllowedFields($keyJawaban);
        $this->komenModel->setAllowedFields($keyKomen);
        $this->checklistModel->save($checklist);
        $this->jawabanModel->save($jawaban);
        $this->komenModel->save($komen);

        session()->setFlashdata('pesanSuccess', 'Data Cheklist berhasil ditambahkan. Setelah diapprove oleh atasan anda dapat mendownloadnya pada halaman approved');

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

        $users = explode(" | ", $checklist['diinput_oleh']);
        $pegawai = [];
        $atasan = [];
        $detailAtasan = [];
        $ttdAtasan = [];
        $ttdPegawai = [];

        $i = 0;
        foreach ($users as $user) {
            $where = "username LIKE '%$user%'";
            $pegawai[] = $this->userModel->asArray()->where($where)->first();
            $atasan[] = $this->atasanModel->where(['bawahan' => $pegawai[$i]['bidang']])->first();
            $detailAtasan[] = $this->userModel->asArray()->where('fullname', $atasan[$i]['nama'])->first();

            if ($detailAtasan[$i]['signature'] != '') {
                if (file_exists('img-ttd/' . $detailAtasan[$i]['signature'])) {
                    $ttdAtasan[] = '<img src="img-ttd/' . $detailAtasan[$i]["signature"] . '" width="70px" height="70px">';
                }
            } else {
                $ttdAtasan[] = '<img src="img-ttd/none.png" width="70px" height="70px">';
            }
            if ($pegawai[$i]['signature'] != '') {
                if (file_exists('img-ttd/' . $pegawai[$i]['signature'])) {
                    $ttdPegawai[] = '<img src="img-ttd/' . $pegawai[$i]["signature"] . '" width="70px" height="70px">';
                }
            } else {
                $ttdPegawai[] = '<img src="img-ttd/none.png" width="70px" height="70px">';
            }

            $i++;
        }

        $pelaksana = [];
        foreach ($pegawai as $peg) {
            $pelaksana[] = $peg['fullname'] . ' (' . $peg['username'] . ') ';
        }

        $cetakPelaksana = implode(' | ', $pelaksana);

        $pertanyaan = $this->daftar_pertanyaanModel->where(['untuk' => $checklist['namaPeralatan']])->findAll();

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
            'cetakPelaksana' => $cetakPelaksana,
            'atasan' => $atasan,
            'ttdPegawai' => $ttdPegawai,
            'ttdAtasan' => $ttdAtasan,
            'pertanyaan' => $pertanyaan,
            'jwb' => $jwb
        ];

        $this->response->setContentType("application/pdf");

        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->SetHTMLHeader(view('checklist/hprint', $hdata));
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->WriteHTML(view('checklist/print', $data));
        return $mpdf->Output($checklist['id'] . ' ' . $checklist['namaPeralatan'] . ' checklist.pdf', "I");
    }
}
