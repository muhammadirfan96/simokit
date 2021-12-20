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
        $data = $this->request->getVar();
        $this->userModel->save($data);
        return redirect()->to('logout');
    }
}
