<?php 
namespace APP\controllers;

use CodeIgniter\Controller;
use App\Models\PesananModel;

class LaporanController extends Controller {
    function __construct()
    {
        $this->Laporan = new PesananModel();
    }
    public function tampil()
    {
        $data['data']= $this->Laporan->findAll();
        return view ('Laporan', $data);
    }
}