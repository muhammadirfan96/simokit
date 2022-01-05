<?php

namespace App\Controllers;

use Myth\Auth\Models\UserModel;

class Db_users extends BaseController
{
    protected $UserModel;
    public function __construct()
    {
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'database | users',
            'users' => $this->UserModel->asArray()->findAll(),
        ];
        // dd($data);

        return view('db_users/index', $data);
    }

    public function details($id)
    {
        $user = $this->UserModel->asArray()->find($id);
        $data = [
            'title' => 'user details',
            'user' => $user
        ];
        // dd($data['user']['username']);
        return view('db_users/details', $data);
    }

    public function edit()
    {
        $User = $this->UserModel->asArray()->find($this->request->getVar('id'));

        if ($this->request->getFile('picture')->getName()) {
            $img = $this->request->getFile('picture')->getName();

            //hapus gambar profile lama
            if ($User['picture'] != '') {
                if (file_exists('img-profile/' . $User['picture'])) {
                    unlink('img-profile/' . $User['picture']);
                }
            }

            //pindahkan foto profil ke img-profile
            $this->request->getFile('picture')->move('img-profile');
        } else {
            $img = $User['picture'];
        }

        if ($this->request->getVar('signed')) {
            $imageParts = explode(";base64,", $this->request->getVar('signed'));
            $imageTypeAux = explode("image/", $imageParts[0]);
            $imageType = $imageTypeAux[1];
            $imageBase64 = base64_decode($imageParts[1]);
            $file = uniqid() . '.' . $imageType;

            //hapus ttd lama
            if ($User['signature'] != '') {
                if (file_exists('img-ttd/' . $User['signature'])) {
                    unlink('img-ttd/' . $User['signature']);
                }
            }

            // pindahkan ttd ke folder img-ttd
            file_put_contents('img-ttd/' . $file, $imageBase64);
        } else {
            $file = $User['signature'];
        }

        $data = [
            'id' => $this->request->getVar('id'),
            'fullname' => $this->request->getVar('fullname'),
            'email' => $this->request->getVar('email'),
            'active' => $this->request->getVar('active'),
            'signature' => $file,
            'picture' => $img
        ];

        // dd($data);
        session()->setFlashdata('pesan', 'Data ' . $User['username'] . ' telah diubah. Silahkan cek kembali');

        $this->UserModel->setAllowedFields(array_keys($data));
        $this->UserModel->save($data);


        return redirect()->to(base_url('/db_users'));
    }

    public function delete($id)
    {
        //cari gambar
        $User = $this->UserModel->asArray()->find($id);
        // dd($User);

        //hapus gambar
        if ($User['picture'] != '') {
            if (file_exists('img-profile/' . $User['picture'])) {
                unlink('img-profile/' . $User['picture']);
            }
        }
        if ($User['signature'] != '') {
            if (file_exists('img-ttd/' . $User['signature'])) {
                unlink('img-ttd/' . $User['signature']);
            }
        }

        //hapus data
        session()->setFlashdata('pesan', 'user ' . $User['username'] . ' telah dihapus');
        $this->UserModel->delete($id);
        return redirect()->to(base_url('/db_users'));
    }
}
