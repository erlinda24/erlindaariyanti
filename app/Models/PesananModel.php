<?php 
namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model{
    protected $table      = 'tb_pesanan';
    // Uncomment below if you want add primary key
     protected $primaryKey = 'id';
     protected $allowedFields = ['tanggal','total_harga','no_meja','nama_pemesan','user_id'];
}