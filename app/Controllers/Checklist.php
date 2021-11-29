<?php

namespace App\Controllers;

use App\Models\Array_daftarSopIk;
use App\Models\Daftar_pertanyaanModel;
use App\Models\ChecklistModel;
use App\Models\JawabanModel;
use App\Models\KomenModel;
use Myth\Auth\Models\UserModel;
use App\Models\Array_formchecklist;
use \Mpdf\Mpdf;

class Checklist extends BaseController
{
    protected $daftar_pertanyaanModel;
    protected $checklistModel;
    protected $jawabanModel;
    protected $komenModel;
    protected $userModel;
    public function __construct()
    {
        $this->daftar_pertanyaanModel = new Daftar_pertanyaanModel();
        $this->checklistModel = new ChecklistModel();
        $this->jawabanModel = new JawabanModel();
        $this->komenModel = new KomenModel();
        $this->userModel = new UserModel();
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
            return redirect()->back()->withInput();
            //echo 'lol';
        }

        //dd($this->request->getVar());

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

        session()->setFlashdata('pesan', 'Data Cheklist berhasil ditambahkan');

        //$print = $this->print();
        //return redirect()->to('/Checklist/print');
        return redirect()->to('checklist/' . $this->request->getVar('namaPeralatan'));
    }

    public function print()
    {
        // $mpdf = new \Mpdf\Mpdf();
        $mpdf = new Mpdf();

        $checklist = $this->checklistModel->orderBy('id', 'desc')->first();
        $jawaban = $this->jawabanModel->orderBy('id', 'desc')->first();
        $komen = $this->komenModel->orderBy('id', 'desc')->first();
        $pegawai = $this->userModel->where(['username' => $checklist['diinput_oleh']])->first();
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
            'pertanyaan' => $pertanyaan,
            'jwb' => $jwb
        ];

        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->SetHTMLHeader(view('checklist/hprint', $hdata));
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->WriteHTML(view('checklist/print', $data));
        return redirect()->to($mpdf->Output('checklist.pdf', "I"));
    }
}
