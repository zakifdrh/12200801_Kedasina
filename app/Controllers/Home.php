<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Beranda'
        ];
        $data2 = [
            'ucapan' => 'Selamat Datang Di Kelola Data Sederhana'
        ];

        echo view('templates/v_header', );
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('home/index', $data,$data2);
        echo view('templates/v_footer');
    }
}
