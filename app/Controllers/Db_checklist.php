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

    public function index()
    {
        if (in_groups('supervisor operasi shift a') || in_groups('supervisor operasi shift b') || in_groups('supervisor operasi shift c') || in_groups('supervisor operasi shift d')) {
            $atasan = $this->AtasanModel->where('nama', user()->fullname)->first();
            $users = $this->UserModel->asArray()->where('bidang', $atasan['bawahan'])->findAll();

            $Checklist = [];
            foreach ($users as $user) {
                $Checklist[] = $this->ChecklistModel->where('diinput_oleh', $user['username'])->findAll();
            }
        } elseif (in_groups('admin')) {
            $Checklist[] = $this->ChecklistModel->findAll();
        }

        $data = [
            'title' => 'database | checklist',
            'checklist' => $Checklist
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
            'pertanyaan' => $pertanyaan
        ];
        return view('db_checklist/details', $data);
    }

    public function edit()
    {
        //insert ke tabel checklist

        $this->ChecklistModel->save([
            'id' => $this->request->getVar('id'),
            'catatan' => $this->request->getVar(htmlspecialchars('catatan'))
        ]);

        //data tabel jawaban

        $keyJawaban = ['id'];
        $valueJawaban = [$this->request->getVar('id')];
        for ($i = 1; $i <= $this->request->getVar('jumlahPertanyaan'); $i++) {
            array_push($keyJawaban, 'jawaban' . $i);
            array_push($valueJawaban, $this->request->getVar("pertanyaan" . $i));
        }
        $jawaban = array_combine($keyJawaban, $valueJawaban);

        //data tabel komen

        $keyKomen = ['id'];
        $valueKomen = [$this->request->getVar('id')];
        for ($i = 1; $i <= $this->request->getVar('jumlahPertanyaan'); $i++) {
            array_push($keyKomen, 'komen' . $i);
            array_push($valueKomen, $this->request->getVar("komen" . $i));
        }
        $komen = array_combine($keyKomen, $valueKomen);

        //lakukan inser ke tabel jawaban dan komen

        $this->JawabanModel->setAllowedFields($keyJawaban);
        $this->KomenModel->setAllowedFields($keyKomen);
        $this->JawabanModel->save($jawaban);
        $this->KomenModel->save($komen);

        session()->setFlashdata('pesan', 'Data Cheklist ' . $this->request->getVar('namaPeralatan') . ' telah diedit');

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
        session()->setFlashdata('pesan', 'Data Checklist ' . $checklist['namaPeralatan'] . ' berhasil dihapus');
        return redirect()->to(base_url('/db_checklist'));
    }

    public function approve($id)
    {
        $checklist = $this->ChecklistModel->find($id);
        $data = [
            'id' => $id,
            'approved' => $this->request->getVar('approve')
        ];

        session()->setFlashdata('pesan', 'Data Checklist ' . $checklist['namaPeralatan'] . ' by ' . $checklist['diinput_oleh'] . ' telah di approve');

        $this->ChecklistModel->setAllowedFields(array_keys($data));
        $this->ChecklistModel->save($data);
        return redirect()->to(base_url('/db_checklist'));
    }
}
