<?php

namespace App\Controllers;

use App\Models\ServiceRequestModel;
use Myth\Auth\Models\UserModel;
use App\Models\AtasanModel;

class Servicerequest extends BaseController
{
    protected $serviceRequestModel;
    protected $userModel;
    protected $atasanModel;

    public function __construct()
    {
        $this->serviceRequestModel = new ServiceRequestModel();
        $this->userModel = new UserModel();
        $this->atasanModel = new AtasanModel();
    }

    public function index($judul = 'flm')
    {
        if ($judul == "cm") {
            $evidence = "Evidence";
        } elseif ($judul == "flm") {
            $evidence = "Sebelum FLM";
        }
        $data = [
            'title' => 'service request',
            'jenisSr' => $judul,
            'evidence' => $evidence,
            'validation' => \Config\Services::validation()
        ];

        return view('servicerequest/index', $data);
    }

    public function simpan()
    {
        $dataValidate = [
            'nomorSr' => [
                'rules' => 'required|is_unique[srcm.nomorSr]',
                'errors' => [
                    'required' => 'nomor SR harus di isi',
                    'is_unique' => 'nomor SR sudah ada'
                ]
            ],
            'unit' => 'required',
            'area' => 'required',
            'namaPeralatan' => 'required',
            'kks' => 'required',
            'uraianGangguan1' => 'required',
            'normalOperasi1' => 'required',
            'gejala1' => 'required',
            'prioritas' => 'required',
            'akibatKerusakan1' => 'required',
            'kemungkinanDampak1' => 'required',
            'tindakanSementara1' => 'required',
            'tanggal' => 'required',
            'evidence1' => [
                'rules' => 'uploaded[evidence1]|max_size[evidence1,1024]|is_image[evidence1]|mime_in[evidence1,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'pilih gambar terlebih dahulu',
                    'max_size' => 'ukuran gambar maksimal 1 MB',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'format gambar yang dibolehkan .jpg, jpeg, atau .png'
                ]
            ]
        ];

        if ($this->request->getVar('jenisSr') == 'flm') {
            $dataValidate['evidence2'] = [
                'rules' => 'uploaded[evidence2]|max_size[evidence2,1024]|is_image[evidence2]|mime_in[evidence2,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'pilih gambar terlebih dahulu',
                    'max_size' => 'ukuran gambar maksimal 1 MB',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'format gambar yang dibolehkan .jpg, jpeg, atau .png'
                ]
            ];
        }

        if (!$this->validate($dataValidate)) {
            return redirect()->to(base_url('/servicerequest/' . $this->request->getVar('jenisSr')))->withInput();
        }

        $data = [
            'nomorSr' => $this->request->getVar('nomorSr'),
            'unit' => $this->request->getVar('unit'),
            'area' => $this->request->getVar('area'),
            'namaPeralatan' => $this->request->getVar('namaPeralatan'),
            'kks' => $this->request->getVar('kks'),
            'uraianGangguan1' => $this->request->getVar('uraianGangguan1'),
            'uraianGangguan2' => $this->request->getVar('uraianGangguan2'),
            'normalOperasi1' => $this->request->getVar('normalOperasi1'),
            'normalOperasi2' => $this->request->getVar('normalOperasi2'),
            'gejala1' => $this->request->getVar('gejala1'),
            'gejala2' => $this->request->getVar('gejala2'),
            'prioritas' => $this->request->getVar('prioritas'),
            'akibatKerusakan1' => $this->request->getVar('akibatKerusakan1'),
            'akibatKerusakan2' => $this->request->getVar('akibatKerusakan2'),
            'kemungkinanDampak1' => $this->request->getVar('kemungkinanDampak1'),
            'kemungkinanDampak2' => $this->request->getVar('kemungkinanDampak2'),
            'tindakanSementara1' => $this->request->getVar('tindakanSementara1'),
            'tindakanSementara2' => $this->request->getVar('tindakanSementara2'),
            'tindakanSementara3' => $this->request->getVar('tindakanSementara3'),
            'diinput_oleh' => user()->username,
            'tanggal' => $this->request->getVar('tanggal'),
            'ket' => $this->request->getVar('jenisSr'),
            'evidence1' => '',
            'evidence2' => ''
        ];

        //dd($data);

        //ambil gambar
        $evidence1 = $this->request->getFile('evidence1');

        //pindahkan gambar ke folder img
        $evidence1->move('img-sr');

        //masukan nama gambar
        $data['evidence1'] = $evidence1->getName();

        if ($this->request->getVar('jenisSr') == 'flm') {
            $evidence2 = $this->request->getFile('evidence2');
            $evidence2->move('img-sr');
            $data['evidence2'] = $evidence2->getName();
        }

        $this->serviceRequestModel->setAllowedFields(array_keys($data));

        $this->serviceRequestModel->save($data);

        session()->setFlashdata('pesanSR', 'Data SR ' . $data['ket'] . ' berhasil ditambahkan');

        return redirect()->to(base_url('/servicerequest/' . $data['ket']));
    }

    public function print($id = null)
    {
        //dd($id);
        $mpdf = new \Mpdf\Mpdf();

        $serviceRequest = $this->serviceRequestModel->where(['diinput_oleh' => user()->username])->orderBy('id', 'desc')->first();

        if ($id != null) {
            $serviceRequest = $this->serviceRequestModel->where(['id' => $id])->orderBy('id', 'desc')->first();
        }

        //untuk unit
        $unit = [
            "satu" => "&#9744",
            "dua" => "&#9744"
        ];

        switch ($serviceRequest["unit"]) {
            case '#1':
                $unit["satu"] = "&#9745";
                break;
            case '#2':
                $unit["dua"] = "&#9745";
                break;
        }

        //untuk area
        $area = [
            "turbin" => "&#9744",
            "boiler" => "&#9744",
            "wtp" => "&#9744",
            "electrical" => "&#9744"
        ];

        switch ($serviceRequest["area"]) {
            case 'turbin':
                $area["turbin"] = "&#9745";
                break;
            case 'boiler':
                $area["boiler"] = "&#9745";
                break;
            case 'wtp':
                $area["wtp"] = "&#9745";
                break;
            case 'electrical':
                $area["electrical"] = "&#9745";
                break;
        }

        //untuk prioritas
        $prioritas = [
            "emergency" => "&#9744",
            "urgent" => "&#9744",
            "normal" => "&#9744"
        ];

        switch ($serviceRequest["prioritas"]) {
            case 'emergency':
                $prioritas["emergency"] = "&#9745";
                break;
            case 'urgent':
                $prioritas["urgent"] = "&#9745";
                break;
            case 'normal':
                $prioritas["normal"] = "&#9745";
                break;
        }

        //untuk keterangan gambar
        $evidence = [];
        if ($serviceRequest["ket"] == "flm") {
            $evidence[] = ["Sebelum FLM", "Setelah FLM"];
        } else {
            $evidence[] = ["Lampiran", ""];
        }

        $pegawai = $this->userModel->asArray()->where(['username' => $serviceRequest['diinput_oleh']])->first();
        $atasan = $this->atasanModel->where('bawahan', $pegawai['bidang'])->first();

        $daftarHari = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];

        $data = [
            'serviceRequest' => $serviceRequest,
            'pegawai' => $pegawai,
            'atasan' => $atasan,
            'daftarHari' => $daftarHari,
            'unit' => $unit,
            'area' => $area,
            'prioritas' => $prioritas,
            'evidence' => $evidence[0]
        ];
        //dd($data);

        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->SetHTMLHeader(view('servicerequest/hprint'));
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->WriteHTML(view('servicerequest/print', $data));
        return redirect()->to($mpdf->Output('servicerequest.pdf', "I"));
    }
}
