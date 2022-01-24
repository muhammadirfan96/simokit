<?php

namespace App\Controllers;

use App\Models\AtasanModel;
use App\Models\Daftar_pertanyaanModel;
use App\Models\LimasModel;
use App\Models\NilaiLimasModel;
use Myth\Auth\Models\UserModel;

class Limas extends BaseController
{
    protected $daftar_pertanyaanModel;
    protected $userModel;
    protected $atasanModel;
    protected $limasModel;
    protected $nilaiLimasModel;
    public function __construct()
    {
        $this->daftar_pertanyaanModel = new Daftar_pertanyaanModel();
        $this->userModel = new UserModel();
        $this->atasanModel = new AtasanModel();
        $this->limasModel = new LimasModel();
        $this->nilaiLimasModel = new NilaiLimasModel();
    }
    public function index()
    {
        $pertanyaan = $this->daftar_pertanyaanModel->where(['untuk' => '5s'])->findAll();
        $data = [
            'title' => 'lima es',
            'pertanyaan' => $pertanyaan,
            'validation' => \Config\Services::validation()
        ];

        return view('limas/index', $data);
    }

    public function simpan()
    {
        $dataValidate = [
            'namaPeralatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama peralatan harus di isi'
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'tanggal harus di isi'
                ]
            ],
            'area' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'area harus di isi'
                ]
            ],
            'saran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'saran harus di isi'
                ]
            ],
            'fotoSebelum' => [
                'rules' => 'uploaded[fotoSebelum]|max_size[fotoSebelum,1024]|is_image[fotoSebelum]|mime_in[fotoSebelum,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'pilih gambar terlebih dahulu',
                    'max_size' => 'ukuran gambar maksimal 1 MB',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'format gambar yang dibolehkan .jpg, jpeg, atau .png'
                ]
            ],
            'fotoSetelah' => [
                'rules' => 'uploaded[fotoSetelah]|max_size[fotoSetelah,1024]|is_image[fotoSetelah]|mime_in[fotoSetelah,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'pilih gambar terlebih dahulu',
                    'max_size' => 'ukuran gambar maksimal 1 MB',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'format gambar yang dibolehkan .jpg, jpeg, atau .png'
                ]
            ]
        ];

        for ($i = 1; $i <= 25; $i++) {
            $dataValidate['nilai' . $i]['rules'] = 'required';
            $dataValidate['nilai' . $i]['errors']['required'] = 'pilih nilai 1 - 5';
        }

        if (!$this->validate($dataValidate)) {
            return redirect()->to(base_url('/limas'))->withInput();
        }

        $dataLimas = [
            'diinput_oleh' => user()->username,
            'tanggal' => $this->request->getVar('tanggal'),
            'namaPeralatan' => $this->request->getVar('namaPeralatan'),
            'area' => $this->request->getVar('area'),
            'saran' => $this->request->getVar('saran'),
            'fotoSebelum' => $this->request->getFile('fotoSebelum')->getName(),
            'fotoSetelah' => $this->request->getFile('fotoSetelah')->getName()
        ];

        $this->request->getFile('fotoSebelum')->move('img-5s');
        $this->request->getFile('fotoSetelah')->move('img-5s');

        $keyDataNilaiLimas = ['diinput_oleh'];
        $valueDataNilaiLimas = [user()->username];

        for ($i = 1; $i <= 25; $i++) {
            $keyDataNilaiLimas[] = 'nilai' . $i;
            $valueDataNilaiLimas[] = $this->request->getVar('nilai' . $i);
        }

        $dataNilaiLimas = array_combine($keyDataNilaiLimas, $valueDataNilaiLimas);

        $this->limasModel->setAllowedFields(array_keys($dataLimas));
        $this->nilaiLimasModel->setAllowedFields(array_keys($dataNilaiLimas));

        //d($dataLimas);
        //dd($dataNilaiLimas);

        $this->limasModel->save($dataLimas);
        $this->nilaiLimasModel->save($dataNilaiLimas);

        session()->setFlashdata('pesan', 'Data 5S ' . $dataLimas['namaPeralatan'] . ' berhasil ditambahkan. Setelah diapprove oleh atasan anda dapat mendownloadnya pada halaman approved');

        return redirect()->to(base_url('/limas'));
    }

    public function print($id = null)
    {
        $mpdf = new \Mpdf\Mpdf();

        $limas = $this->limasModel->where(['diinput_oleh' => user()->username])->orderBy('id', 'desc')->first();
        $nilaiLimas = $this->nilaiLimasModel->where(['diinput_oleh' => user()->username])->orderBy('id', 'desc')->first();

        if ($id != null) {
            $limas = $this->limasModel->where(['id' => $id])->orderBy('id', 'desc')->first();
            $nilaiLimas = $this->nilaiLimasModel->where(['id' => $id])->orderBy('id', 'desc')->first();
        }

        $pegawai = $this->userModel->asArray()->where(['username' => $limas['diinput_oleh']])->first();
        $atasan = $this->atasanModel->where('bawahan', $pegawai['bidang'])->first();
        $detailAtasan = $this->userModel->asArray()->where('fullname', $atasan['nama'])->first();

        $pertanyaan = $this->daftar_pertanyaanModel->where(['untuk' => '5s'])->findAll();

        $ttd = ['<br><br><br><br>', '<br><br><br><br>'];
        if ($detailAtasan['signature'] != '') {
            if (file_exists('img-ttd/' . $detailAtasan['signature'])) {
                $ttd[0] = '<img src="img-ttd/' . $detailAtasan["signature"] . '" width="70px" height="70px">';
            }
        }
        if ($pegawai['signature'] != '') {
            if (file_exists('img-ttd/' . $pegawai['signature'])) {
                $ttd[1] = '<img src="img-ttd/' . $pegawai["signature"] . '" width="70px" height="70px">';
            }
        }

        $fotoLimas = ['none.png', 'none.png'];
        if ($limas['fotoSebelum'] != '') {
            if (file_exists('img-5s/' . $limas['fotoSebelum'])) {
                $fotoLimas[0] = $limas['fotoSebelum'];
            }
        }

        if ($limas['fotoSetelah'] != '') {
            if (file_exists('img-5s/' . $limas['fotoSetelah'])) {
                $fotoLimas[1] = $limas['fotoSetelah'];
            }
        }

        $data = [
            'limas' => $limas,
            'fotoLimas' => $fotoLimas,
            'nilaiLimas' => $nilaiLimas,
            'pertanyaan' => $pertanyaan,
            'pegawai' => $pegawai,
            'atasan' => $atasan,
            'ttd' => $ttd,
            'checkItem' => $this->nilaiLimasModel->checkItem
        ];

        // dd($data);

        //$mpdf->setAutoTopMargin = 'stretch';
        $mpdf->SetHTMLHeader(view('limas/hprint'));
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->WriteHTML(view('limas/print', $data));
        return redirect()->to($mpdf->Output($limas['id'] . $limas['namaPeralatan'] . ' 5s.pdf', "I"));
    }
}
