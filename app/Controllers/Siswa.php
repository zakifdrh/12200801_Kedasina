<?php
namespace App\Controllers;

use App\Controllers\M_Siswa as ControllersM_Siswa;
use CodeIgniter\Controller;
use App\Models\M_Siswa;

class Siswa extends Controller
{   
    public function __construct()
    {
        $this->model= new M_Siswa;
    }
    public function index()
    {
        $data =[
            'judul' => 'Data Siswa',
            'siswa' => $this->model->getAllData()
        ];

        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('siswa/index', $data);
        echo view('templates/v_footer');
    }

    public function tambah()
    {
        if (isset($_POST['tambah'])){
            $val = $this->validate([
                'nisn' => [
                    'label' => 'Nomor Induk Siswa Nasional',
                    'rules' => 'required|numeric|max_length[20]|is_unique[siswa.nisn]'
                ],
                'nama' => [
                    'label' => 'Nama Siswa',
                    'rules' => 'required'
                ]
            ]);

            if (!$val){
                session()->setFlashdata('err', \Config\Services::validation()->listErrors());

                $data =[
                    'judul' => 'Data Siswa',
                    'siswa' => $this->model->getAllData()
                ];
        
                echo view('templates/v_header', $data);
                echo view('templates/v_sidebar');
                echo view('templates/v_topbar');
                echo view('siswa/index', $data);
                echo view('templates/v_footer');
            } else {
                $data = [
                    'nisn' => $this->request->getPost('nisn'),
                    'nama' => $this->request->getPost('nama')
                ];
        
                //insert data
                    $success = $this->model->tambah($data);
                    if ($success){
                        session()->setFlashdata('message', 'Ditambahkan');
                        return redirect()->to('/siswa');
                    }
                }
            } else {
                return redirect()->to('/siswa');
            }
        }
    

    public function hapus($id)
    {
        $success = $this->model->hapus($id);
        if ($success){
            session()->setFlashdata('message', 'Dihapus');
            return redirect()->to('/siswa');
        }
    }
    public function ubah()
    {
        if (isset($_POST['ubah'])){

            $id = $this->request->getPost('id');
            $nisn = $this->request->getPost('nisn');
            $db_nisn = $this->model->getDataById($id)['nisn'];

            if ($nisn === $db_nisn){
                $val = $this->validate([
                    'nisn' => [
                        'label' => 'Nomor Induk Siswa Nasional',
                        'rules' => 'required|numeric|max_length[20]'
                    ],
                    'nama' => [
                        'label' => 'Nama Siswa',
                        'rules' => 'required'
                    ]
                ]);
            } else {
                $val = $this->validate([
                    'nisn' => [
                        'label' => 'Nomor Induk Siswa Nasional',
                        'rules' => 'required|numeric|max_length[20]|is_unique[siswa.nisn]'
                    ],
                    'nama' => [
                        'label' => 'Nama Siswa',
                        'rules' => 'required'
                    ]
                ]);
            }

            if (!$val){
                session()->setFlashdata('err', \Config\Services::validation()->listErrors());

                $data =[
                    'judul' => 'Data Siswa',
                    'siswa' => $this->model->getAllData()
                ];
        
                echo view('templates/v_header', $data);
                echo view('templates/v_sidebar');
                echo view('templates/v_topbar');
                echo view('siswa/index', $data);
                echo view('templates/v_footer');
            } else {
                $id = $this->request->getPost('id');

                $data = [
                    'nisn' => $this->request->getPost('nisn'),
                    'nama' => $this->request->getPost('nama')
                ];
        
                //update data
                    $success = $this->model->ubah($data, $id);
                    if ($success){
                        session()->setFlashdata('message', 'Diubah');
                        return redirect()->to('/siswa');
                    }
                }
            } else {
                return redirect()->to('/siswa');
            }
        }
}

