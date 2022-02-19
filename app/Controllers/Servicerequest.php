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

        $users = $this->userModel->asArray()->where(['bidang' => user()->bidang, 'username !=' => user()->username])->findAll();
        $data = [
            'title' => 'service request',
            'jenisSr' => $judul,
            'evidence' => $evidence,
            'users' => $users,
            'validation' => \Config\Services::validation()
        ];

        return view('servicerequest/index', $data);
    }

    public function simpan()
    {
        if (user()->signature == '') {
            session()->setFlashdata('pesanWarning', 'masukkan tanda tangan terlebih dahulu');
            return redirect()->to(base_url('/profil'));
        }

        $users = $this->userModel->asArray()->where(['bidang' => user()->bidang, 'username !=' => user()->username])->findAll();

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

        $friend = [];
        foreach ($users as $user) {
            if ($this->request->getVar($user['username'])) {

                if ($user['signature'] == '') {
                    $teman = $user['fullname'];
                    session()->setFlashdata('pesanWarning', $teman . ' belum memiliki tanda tangan');
                    return redirect()->to(base_url('/servicerequest/' . $this->request->getVar('jenisSr')))->withInput();
                }

                $friend[] = $this->request->getVar($user['username']);
            }
        }

        if (count($friend) >= 3) {
            session()->setFlashdata('pesanWarning', 'jumlah teman maksimal 2 orang');
            return redirect()->to(base_url('/servicerequest/' . $this->request->getVar('jenisSr')))->withInput();
        }

        if ($friends = implode(' | ', $friend)) {
            $friends = ' | ' . implode(' | ', $friend);
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
            'diinput_oleh' => user()->username . $friends,
            'tanggal' => $this->request->getVar('tanggal'),
            'ket' => $this->request->getVar('jenisSr'),
            'evidence1' => '',
            'evidence2' => ''
        ];

        //masukan nama gambar
        $data['evidence1'] = $this->request->getFile('evidence1')->getRandomName();

        //pindahkan gambar ke folder img
        $this->request->getFile('evidence1')->move('img-sr', $data['evidence1']);

        if ($this->request->getVar('jenisSr') == 'flm') {
            $data['evidence2'] = $this->request->getFile('evidence2')->getRandomName();
            $this->request->getFile('evidence2')->move('img-sr', $data['evidence2']);
        }

        $this->serviceRequestModel->setAllowedFields(array_keys($data));

        $this->serviceRequestModel->save($data);

        session()->setFlashdata('pesanSuccess', 'Data SR ' . $data['ket'] . ' berhasil ditambahkan. Setelah diapprove oleh atasan anda dapat mendownloadnya pada halaman approved');

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

        $users = explode(" | ", $serviceRequest['diinput_oleh']);
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

        $fotoSR = ['none.png', 'none.png'];
        if ($serviceRequest['evidence1'] != '') {
            if (file_exists('img-sr/' . $serviceRequest['evidence1'])) {
                $fotoSR[0] = $serviceRequest['evidence1'];
            }
        }

        if ($serviceRequest['evidence2'] != '') {
            if (file_exists('img-sr/' . $serviceRequest['evidence2'])) {
                $fotoSR[1] = $serviceRequest['evidence2'];
            }
        }

        $daftarHari = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];

        $data = [
            'serviceRequest' => $serviceRequest,
            'pegawai' => $pegawai,
            'cetakPelaksana' => $cetakPelaksana,
            'atasan' => $atasan,
            'ttdPegawai' => $ttdPegawai,
            'ttdAtasan' => $ttdAtasan,
            'daftarHari' => $daftarHari,
            'unit' => $unit,
            'area' => $area,
            'prioritas' => $prioritas,
            'evidence' => $evidence[0],
            'fotoSR' => $fotoSR
        ];
        // dd($data);

        $this->response->setContentType("application/pdf");

        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->SetHTMLHeader(view('servicerequest/hprint'));
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->WriteHTML(view('servicerequest/print', $data));
        return $mpdf->Output($serviceRequest['nomorSr'] . ' ' . $serviceRequest['uraianGangguan1'] . ' servicerequest.pdf', "I");
    }
}
