<?php

namespace App\Controllers;

use App\Models\AtasanModel;
use App\Models\Daftar_pertanyaanModel;
use App\Models\LimasModel;
use App\Models\NilaiLimasModel;
use Myth\Auth\Models\UserModel;
use Mpdf\Mpdf;

class Limas extends BaseController
{
    protected $daftar_pertanyaanModel, $userModel, $atasanModel, $limasModel, $nilaiLimasModel;

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
        $users = $this->userModel->asArray()->where(['bidang' => user()->bidang, 'username !=' => user()->username])->findAll();
        $data = [
            'title' => 'lima es',
            'pertanyaan' => $pertanyaan,
            'users' => $users,
            'validation' => \Config\Services::validation()
        ];

        // dd($data['user']);

        return view('limas/index', $data);
    }

    public function simpan()
    {
        if (user()->signature == '') {
            session()->setFlashdata('pesanWarning', 'masukkan tanda tangan terlebih dahulu');
            return redirect()->to(base_url('/profil'));
        }

        $users = $this->userModel->asArray()->where(['bidang' => user()->bidang, 'username !=' => user()->username])->findAll();

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

        $friend = [];
        foreach ($users as $user) {
            if ($this->request->getVar($user['username'])) {

                if ($user['signature'] == '') {
                    $teman = $user['fullname'];
                    session()->setFlashdata('pesanWarning', $teman . ' belum memiliki tanda tangan');
                    return redirect()->to(base_url('/limas'))->withInput();
                }

                $friend[] = $this->request->getVar($user['username']);
            }
        }

        if (count($friend) >= 3) {
            session()->setFlashdata('pesanWarning', 'jumlah teman maksimal 2 orang');
            return redirect()->to(base_url('/limas'))->withInput();
        }

        if ($friends = implode(' | ', $friend)) {
            $friends = ' | ' . implode(' | ', $friend);
        }

        // dd($friends);

        $dataLimas = [
            'diinput_oleh' => user()->username . $friends,
            'tanggal' => $this->request->getVar('tanggal'),
            'namaPeralatan' => $this->request->getVar('namaPeralatan'),
            'area' => $this->request->getVar('area'),
            'saran' => $this->request->getVar('saran'),
            'fotoSebelum' => $this->request->getFile('fotoSebelum')->getRandomName(),
            'fotoSetelah' => $this->request->getFile('fotoSetelah')->getRandomName()
        ];

        $this->request->getFile('fotoSebelum')->move('img-5s', $dataLimas['fotoSebelum']);
        $this->request->getFile('fotoSetelah')->move('img-5s', $dataLimas['fotoSetelah']);

        $keyDataNilaiLimas = ['diinput_oleh'];
        $valueDataNilaiLimas = [user()->username . ' | '];

        for ($i = 1; $i <= 25; $i++) {
            $keyDataNilaiLimas[] = 'nilai' . $i;
            $valueDataNilaiLimas[] = $this->request->getVar('nilai' . $i);
        }

        $dataNilaiLimas = array_combine($keyDataNilaiLimas, $valueDataNilaiLimas);

        $this->limasModel->setAllowedFields(array_keys($dataLimas));
        $this->nilaiLimasModel->setAllowedFields(array_keys($dataNilaiLimas));

        $this->limasModel->save($dataLimas);
        $this->nilaiLimasModel->save($dataNilaiLimas);

        session()->setFlashdata('pesanSuccess', 'Data 5S ' . $dataLimas['namaPeralatan'] . ' berhasil ditambahkan. Setelah diapprove oleh atasan anda dapat mendownloadnya pada halaman approved');

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

        $users = explode(" | ", $limas['diinput_oleh']);
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

        $pertanyaan = $this->daftar_pertanyaanModel->where(['untuk' => '5s'])->findAll();

        $data = [
            'limas' => $limas,
            'fotoLimas' => $fotoLimas,
            'nilaiLimas' => $nilaiLimas,
            'pertanyaan' => $pertanyaan,
            'pegawai' => $pegawai,
            'cetakPelaksana' => $cetakPelaksana,
            'atasan' => $atasan,
            'ttdPegawai' => $ttdPegawai,
            'ttdAtasan' => $ttdAtasan,
            'checkItem' => $this->nilaiLimasModel->checkItem
        ];

        $this->response->setContentType("application/pdf");

        // $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->SetHTMLHeader(view('limas/hprint'));
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->WriteHTML(view('limas/print', $data));

        return $mpdf->Output($limas['id'] . ' ' . $limas['namaPeralatan'] . ' 5s.pdf', "I");
    }
}
