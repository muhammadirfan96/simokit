<?php

namespace App\Controllers;

use App\Models\ServiceRequestModel;
use App\Models\AtasanModel;
use Myth\Auth\Models\UserModel;

class Db_servicerequest extends BaseController
{
    protected $servicerequestModel, $UserModel, $AtasanModel;
    public function __construct()
    {
        $this->servicerequestModel = new ServiceRequestModel();
        $this->UserModel = new UserModel();
        $this->AtasanModel = new AtasanModel();
    }

    public function getUsers()
    {
        if (in_groups('supervisor operasi shift a') || in_groups('supervisor operasi shift b') || in_groups('supervisor operasi shift c') || in_groups('supervisor operasi shift d')) {
            $atasan = $this->AtasanModel->where('nama', user()->fullname)->first();
            $users = $this->UserModel->asArray()->where('bidang', $atasan['bawahan'])->findAll();
        } elseif (in_groups('admin')) {
            $users = $this->UserModel->asArray()->findAll();
        }
        return $users;
    }

    public function index()
    {
        if (in_groups('supervisor operasi shift a') || in_groups('supervisor operasi shift b') || in_groups('supervisor operasi shift c') || in_groups('supervisor operasi shift d')) {

            $res = [];
            foreach ($this->getUsers() as $user) {
                $like = $user['username'];
                $where = "diinput_oleh LIKE '%$like%'";
                $res[] = $this->servicerequestModel->where($where)->findAll();
            }
            $t = [];
            foreach ($res as $re) {
                foreach ($re as $r) {
                    $t[] = $r['id'];
                }
            }
            $u = array_unique($t);
            asort($u);

            $result = [];
            foreach ($u as $v) {
                $result[] = $this->servicerequestModel->find($v);
            }
        } elseif (in_groups('admin')) {
            $result = $this->servicerequestModel->findAll();
        }

        $data = [
            'title' => 'database | servicerequest',
            'servicerequest' => $result
        ];

        return view('db_servicerequest/index', $data);
    }

    public function details($id)
    {
        $servicerequest = $this->servicerequestModel->find($id);

        if ($servicerequest['ket'] == "cm") {
            $evidence = "Evidence";
        } elseif ($servicerequest['ket'] == "flm") {
            $evidence = "Sebelum FLM";
        }

        $data = [
            'title' => 'details servicerequest',
            'evidence' => $evidence,
            'servicerequest' => $servicerequest,
            'users' => $this->getUsers(),
            'validation' => \Config\Services::validation()
        ];

        return view('db_servicerequest/details', $data);
    }

    public function edit()
    {
        $servicerequest = $this->servicerequestModel->find($this->request->getVar('id'));

        $friend = [];
        foreach ($this->getUsers() as $user) {
            if ($this->request->getVar($user['username'])) {

                if ($user['signature'] == '') {
                    $teman = $user['fullname'];
                    session()->setFlashdata('pesanWarning', $teman . ' belum memiliki tanda tangan');
                    return redirect()->to(base_url('/db_servicerequest/details/' . $this->request->getVar('id')))->withInput();
                }

                $friend[] = $this->request->getVar($user['username']);
            }
        }

        if (count($friend) >= 4) {
            session()->setFlashdata('pesanWarning', 'jumlah pelaksana maksimal 3 orang');
            return redirect()->to(base_url('/db_servicerequest/details/' . $this->request->getVar('id')))->withInput();
        }

        $friends = implode(' | ', $friend);

        if (empty($friends)) {
            $friends = $servicerequest['diinput_oleh'];
        }

        $data = [
            'id' => $servicerequest['id'],
            'nomorSr' => $servicerequest['nomorSr'],
            'unit' => $servicerequest['unit'],
            'area' => $servicerequest['area'],
            'namaPeralatan' => $servicerequest['namaPeralatan'],
            'kks' => $servicerequest['kks'],
            'uraianGangguan1' => $servicerequest['uraianGangguan1'],
            'uraianGangguan2' => $servicerequest['uraianGangguan2'],
            'normalOperasi1' => $servicerequest['normalOperasi1'],
            'normalOperasi2' => $servicerequest['normalOperasi2'],
            'gejala1' => $servicerequest['gejala1'],
            'gejala2' => $servicerequest['gejala2'],
            'prioritas' => $servicerequest['prioritas'],
            'akibatKerusakan1' => $servicerequest['akibatKerusakan1'],
            'akibatKerusakan2' => $servicerequest['akibatKerusakan2'],
            'kemungkinanDampak1' => $servicerequest['kemungkinanDampak1'],
            'kemungkinanDampak2' => $servicerequest['kemungkinanDampak2'],
            'tindakanSementara1' => $servicerequest['tindakanSementara1'],
            'tindakanSementara2' => $servicerequest['tindakanSementara2'],
            'tindakanSementara3' => $servicerequest['tindakanSementara3'],
            'diinput_oleh' => $friends,
            'tanggal' => $servicerequest['tanggal'],
            'evidence1' => $servicerequest['evidence1'],
            'evidence2' => $servicerequest['evidence2']
        ];

        if ($this->request->getVar('nomorSr')) {
            $data['nomorSr'] = $this->request->getVar('nomorSr');
        }
        if ($this->request->getVar('unit')) {
            $data['unit'] = $this->request->getVar('unit');
        }
        if ($this->request->getVar('area')) {
            $data['area'] = $this->request->getVar('area');
        }
        if ($this->request->getVar('namaPeralatan')) {
            $data['namaPeralatan'] = $this->request->getVar('namaPeralatan');
        }
        if ($this->request->getVar('kks')) {
            $data['kks'] = $this->request->getVar('kks');
        }
        if ($this->request->getVar('uraianGangguan1')) {
            $data['uraianGangguan1'] = $this->request->getVar('uraianGangguan1');
        }
        if ($this->request->getVar('uraianGangguan2')) {
            $data['uraianGangguan2'] = $this->request->getVar('uraianGangguan2');
        }
        if ($this->request->getVar('normalOperasi1')) {
            $data['normalOperasi1'] = $this->request->getVar('normalOperasi1');
        }
        if ($this->request->getVar('normalOperasi2')) {
            $data['normalOperasi2'] = $this->request->getVar('normalOperasi2');
        }
        if ($this->request->getVar('gejala1')) {
            $data['gejala1'] = $this->request->getVar('gejala1');
        }
        if ($this->request->getVar('gejala2')) {
            $data['gejala2'] = $this->request->getVar('gejala2');
        }
        if ($this->request->getVar('prioritas')) {
            $data['prioritas'] = $this->request->getVar('prioritas');
        }
        if ($this->request->getVar('akibatKerusakan1')) {
            $data['akibatKerusakan1'] = $this->request->getVar('akibatKerusakan1');
        }
        if ($this->request->getVar('akibatKerusakan2')) {
            $data['akibatKerusakan2'] = $this->request->getVar('akibatKerusakan2');
        }
        if ($this->request->getVar('kemungkinanDampak1')) {
            $data['kemungkinanDampak1'] = $this->request->getVar('kemungkinanDampak1');
        }
        if ($this->request->getVar('kemungkinanDampak2')) {
            $data['kemungkinanDampak2'] = $this->request->getVar('kemungkinanDampak2');
        }
        if ($this->request->getVar('tindakanSementara1')) {
            $data['tindakanSementara1'] = $this->request->getVar('tindakanSementara1');
        }
        if ($this->request->getVar('tindakanSementara2')) {
            $data['tindakanSementara2'] = $this->request->getVar('tindakanSementara2');
        }
        if ($this->request->getVar('tindakanSementara3')) {
            $data['tindakanSementara3'] = $this->request->getVar('tindakanSementara3');
        }
        if ($this->request->getVar('tanggal')) {
            $data['tanggal'] = $this->request->getVar('tanggal');
        }

        if ($this->request->getFile('evidence1') != '') {
            $dataValidate = [
                'evidence1' => [
                    'rules' => 'max_size[evidence1,1024]|is_image[evidence1]|mime_in[evidence1,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'ukuran gambar maksimal 1 MB',
                        'is_image' => 'yang anda pilih bukan gambar',
                        'mime_in' => 'format gambar yang dibolehkan .jpg, jpeg, atau .png'
                    ]
                ]
            ];

            if (!$this->validate($dataValidate)) {
                return redirect()->to(base_url('/db_servicerequest/details/' . $this->request->getVar('id')))->withInput();
            }
            //lolos validasi
            $data['evidence1'] = $this->request->getFile('evidence1')->getRandomName();
            //hapus gambar lama
            if ($servicerequest['evidence1'] != '') {
                if (file_exists('img-sr/' . $servicerequest['evidence1'])) {
                    unlink('img-sr/' . $servicerequest['evidence1']);
                }
            }
            //pindahkan baru ke folder img
            $this->request->getFile('evidence1')->move('img-sr', $data['evidence1']);
        }
        if ($this->request->getFile('evidence2') != '') {
            $dataValidate = [
                'evidence2' => [
                    'rules' => 'max_size[evidence2,1024]|is_image[evidence2]|mime_in[evidence2,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'ukuran gambar maksimal 1 MB',
                        'is_image' => 'yang anda pilih bukan gambar',
                        'mime_in' => 'format gambar yang dibolehkan .jpg, jpeg, atau .png'
                    ]
                ]
            ];

            if (!$this->validate($dataValidate)) {
                return redirect()->to(base_url('/db_servicerequest/details/' . $this->request->getVar('id')))->withInput();
            }
            //lolos validasi
            $data['evidence2'] = $this->request->getFile('evidence2')->getRandomName();
            //hapus gambar lama
            if ($servicerequest['evidence2'] != '') {
                if (file_exists('img-sr/' . $servicerequest['evidence2'])) {
                    unlink('img-sr/' . $servicerequest['evidence2']);
                }
            }
            //pindahkan gambar2 ke folder img
            $this->request->getFile('evidence2')->move('img-sr', $data['evidence2']);
        }

        // dd($data);

        $this->servicerequestModel->setAllowedFields(array_keys($data));

        $this->servicerequestModel->save($data);

        session()->setFlashdata('pesanSuccess', 'Data SR ' . $data['nomorSr'] . ' telah diubah');

        return redirect()->to(base_url('/db_servicerequest/details/' . $this->request->getVar('id')));
    }

    public function prints($id)
    {
        return redirect()->to(base_url('/servicerequest/' . $id));
    }

    public function delete($id)
    {
        //cari gambar
        $serviceRequest = $this->servicerequestModel->find($id);
        // dd($serviceRequest);

        //hapus gambar
        if ($serviceRequest['evidence1'] != '') {
            if (file_exists('img-sr/' . $serviceRequest['evidence1'])) {
                unlink('img-sr/' . $serviceRequest['evidence1']);
            }
        }
        if ($serviceRequest['evidence2'] != '') {
            if (file_exists('img-sr/' . $serviceRequest['evidence2'])) {
                unlink('img-sr/' . $serviceRequest['evidence2']);
            }
        }

        //hapus data
        $this->servicerequestModel->delete($id);
        session()->setFlashdata('pesanSuccess', 'Data SR ' . $serviceRequest['nomorSr'] . ' telah dihapus');
        return redirect()->to(base_url('/db_servicerequest'));
    }

    public function approve($id)
    {
        $serviceRequest = $this->servicerequestModel->find($id);
        $data = [
            'id' => $id,
            'tanggal' => $serviceRequest['tanggal'],
            'approved' => $this->request->getVar('approve')
        ];

        session()->setFlashdata('pesanSuccess', 'Data SR ' . $serviceRequest['nomorSr'] . ' by ' . $serviceRequest['diinput_oleh'] . ' telah di approve');

        $this->servicerequestModel->setAllowedFields(array_keys($data));
        $this->servicerequestModel->save($data);
        return redirect()->to(base_url('/db_servicerequest'));
    }
}
