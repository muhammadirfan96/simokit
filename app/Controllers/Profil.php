<?php

namespace App\Controllers;

use Myth\Auth\Models\UserModel;

class Profil extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {

        $data = [
            'title' => 'my profil'
            // 'user' => $this->userModel->asArray()->where('username', user()->username)->first()
        ];

        // dd($data);

        return view('profil/index', $data);
    }

    public function edit()
    {
        if ($this->request->getFile('picture')->getName()) {
            $img = $this->request->getFile('picture')->getName();

            //hapus gambar profile lama
            if (user()->picture != '') {
                if (file_exists('img-profile/' . user()->picture)) {
                    unlink('img-profile/' . user()->picture);
                }
            }

            //pindahkan foto profil ke img-profile
            $this->request->getFile('picture')->move('img-profile');
        } else {
            $img = user()->picture;
        }

        if ($this->request->getVar('signed')) {
            $imageParts = explode(";base64,", $this->request->getVar('signed'));
            $imageTypeAux = explode("image/", $imageParts[0]);
            $imageType = $imageTypeAux[1];
            $imageBase64 = base64_decode($imageParts[1]);
            $file = uniqid() . '.' . $imageType;

            //hapus ttd lama
            if (user()->signature != '') {
                if (file_exists('img-ttd/' . user()->signature)) {
                    unlink('img-ttd/' . user()->signature);
                }
            }

            // pindahkan ttd ke folder img-ttd
            file_put_contents('img-ttd/' . $file, $imageBase64);
        } else {
            $file = user()->signature;
        }

        $data = [
            'id' => $this->request->getVar('id'),
            'fullname' => $this->request->getVar('fullname'),
            'email' => $this->request->getVar('email'),
            'signature' => $file,
            'picture' => $img
        ];

        // dd($data);

        session()->setFlashdata('pesan', 'Data Anda telah diubah. Silahkan cek kembali');

        $this->userModel->setAllowedFields(array_keys($data));

        $this->userModel->save($data);
        return redirect()->to('/profil');
    }
}
