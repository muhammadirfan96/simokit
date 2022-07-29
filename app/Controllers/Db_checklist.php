<?php

namespace App\Controllers;

use App\Models\ChecklistModel;
use App\Models\AtasanModel;
use App\Models\Daftar_pertanyaanModel;
use App\Models\JawabanModel;
use App\Models\KomenModel;
use Myth\Auth\Models\UserModel;

class Db_checklist extends BaseController
{
    protected $ChecklistModel, $JawabanModel, $KomenModel, $daftar_pertanyaanModel, $UserModel, $AtasanModel;
    public function __construct()
    {
        $this->ChecklistModel = new ChecklistModel();
        $this->JawabanModel = new JawabanModel();
        $this->KomenModel = new KomenModel();
        $this->daftar_pertanyaanModel = new Daftar_pertanyaanModel();
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
                $res[] = $this->ChecklistModel->where($where)->findAll();
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
                $result[] = $this->ChecklistModel->find($v);
            }
        } elseif (in_groups('admin')) {
            $result = $this->ChecklistModel->findAll();
        }

        // menemukan bidang
        $bidang = [];
        foreach ($result as $row) {
            $bidang[] = $this->UserModel
                ->asArray()
                ->where(
                    ['username' => explode(' | ', $row['diinput_oleh'])[0]]
                )
                ->first()['bidang'];
        }

        // end

        $data = [
            'title' => 'database | checklist',
            'bidang' => $bidang,
            'checklist' => $result
        ];

        return view('db_checklist/index', $data);
    }

    public function details($id)
    {
        $checklist = $this->ChecklistModel->find($id);
        $jawaban = $this->JawabanModel->find($id);
        $komen = $this->KomenModel->find($id);
        $pertanyaan = $this->daftar_pertanyaanModel->where('untuk', $checklist['namaPeralatan'])->findAll();

        $data = [
            'title' => 'details checklist',
            'checklist' => $checklist,
            'jawaban' => $jawaban,
            'komen' => $komen,
            'pertanyaan' => $pertanyaan,
            'users' => $this->getUsers()
        ];
        return view('db_checklist/details', $data);
    }

    public function edit()
    {
        $checklist = $this->ChecklistModel->find($this->request->getVar('id'));

        $friend = [];
        foreach ($this->getUsers() as $user) {
            if ($this->request->getVar($user['username'])) {

                if ($user['signature'] == '') {
                    $teman = $user['fullname'];
                    session()->setFlashdata('pesanWarning', $teman . ' belum memiliki tanda tangan');
                    return redirect()->to(base_url('/db_checklist/details/' . $this->request->getVar('id')))->withInput();
                }

                $friend[] = $this->request->getVar($user['username']);
            }
        }

        if (count($friend) >= 4) {
            session()->setFlashdata('pesanWarning', 'jumlah pelaksana maksimal 3 orang');
            return redirect()->to(base_url('/db_checklist/details/' . $this->request->getVar('id')))->withInput();
        }

        $friends = implode(' | ', $friend);

        if (empty($friends)) {
            $friends = $checklist['diinput_oleh'];
        }

        //data tabel checklist
        $dtchecklist = [
            'id' => $this->request->getVar('id'),
            'diinput_oleh' => $friends,
            'catatan' => $this->request->getVar(htmlspecialchars('catatan'))
        ];

        //data tabel jawaban
        $keyJawaban = ['id', 'diinput_oleh'];
        $valueJawaban = [$this->request->getVar('id'), $friends];
        for ($i = 1; $i <= $this->request->getVar('jumlahPertanyaan'); $i++) {
            array_push($keyJawaban, 'jawaban' . $i);
            array_push($valueJawaban, $this->request->getVar("pertanyaan" . $i));
        }
        $jawaban = array_combine($keyJawaban, $valueJawaban);

        //data tabel komen
        $keyKomen = ['id', 'diinput_oleh'];
        $valueKomen = [$this->request->getVar('id'), $friends];
        for ($i = 1; $i <= $this->request->getVar('jumlahPertanyaan'); $i++) {
            array_push($keyKomen, 'komen' . $i);
            array_push($valueKomen, $this->request->getVar("komen" . $i));
        }
        $komen = array_combine($keyKomen, $valueKomen);

        //lakukan inser ke tabel checklist, jawaban dan komen
        $this->ChecklistModel->setAllowedFields(array_keys($dtchecklist));
        $this->JawabanModel->setAllowedFields($keyJawaban);
        $this->KomenModel->setAllowedFields($keyKomen);
        $this->ChecklistModel->save($dtchecklist);
        $this->JawabanModel->save($jawaban);
        $this->KomenModel->save($komen);

        session()->setFlashdata('pesanSuccess', 'Data Cheklist ' . $this->request->getVar('namaPeralatan') . ' telah diedit');

        return redirect()->to(base_url('/db_checklist/details/' . $this->request->getVar('id')));
    }

    public function prints($id)
    {
        return redirect()->to(base_url('/checklist/' . $id));
    }

    public function delete($id)
    {
        $checklist = $this->ChecklistModel->find($id);
        //hapus data
        $this->ChecklistModel->delete($id);
        $this->JawabanModel->delete($id);
        $this->KomenModel->delete($id);
        session()->setFlashdata('pesanSuccess', 'Data Checklist ' . $checklist['namaPeralatan'] . ' berhasil dihapus');
        return redirect()->to(base_url('/db_checklist'));
    }

    public function approve($id)
    {
        $checklist = $this->ChecklistModel->find($id);
        $data = [
            'id' => $id,
            'tanggal' => $checklist['tanggal'],
            'approved' => $this->request->getVar('approve')
        ];

        session()->setFlashdata('pesanSuccess', 'Data Checklist ' . $checklist['namaPeralatan'] . ' by ' . $checklist['diinput_oleh'] . ' telah di approve');

        $this->ChecklistModel->setAllowedFields(array_keys($data));
        $this->ChecklistModel->save($data);
        return redirect()->to(base_url('/db_checklist'));
    }
}
