<?php 
namespace APP\controllers;

use CodeIgniter\Controller;
use App\Models\MenuModel;

class MenuController extends Controller {
    /**
     * instance of the main Request object.
     * 
     * @var HTTP\
     */
    protected $request;


    function __construct()
    {
        $this->menu = new MenuModel();  
     }
    public function tampil()
    {
        $data['data'] = $this->menu->findAll();
        return view('menulist',$data);
    }
    public function simpan()
    {
        $data = array(       
             'nama'=>$this->request->getPost('nama'),
            'harga'=>$this->request->getPost('harga'),
            'jenis'=>$this->request->getPost('jenis'),
            'stok'=>$this->request->getPost('stok'),
            'gambar'=>$this->request->getPost('gambar'),
        );
        $this->menu->insert($data);
        return redirect('menu')->with('success','data berhasil disimpan');
    }
    public function delete($id)
    {
        #code...
        $this->menu->delete($id);
        return redirect('menu')->with('success','Data berhasil dihapus');
    }
    public function edit($id)
    {
        #code...
        $data = array(       
            'nama'=>$this->request->getPost('nama'),
           'harga'=>$this->request->getPost('harga'),
           'jenis'=>$this->request->getPost('jenis'),
           'stok'=>$this->request->getPost('stok'),
           'gambar'=>$this->request->getPost('gambar'), 
         );
         $this->menu->update($id,$data);
         return redirect('menu')->With('success','data berhasil di edit');
 
        }
       
    public function hapus()
    {
        #code...
    }
} 