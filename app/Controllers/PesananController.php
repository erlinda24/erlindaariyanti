<?php 
namespace APP\controllers;

use CodeIgniter\Controller;
use App\Models\MenuModel;
use App\Models\PesananModel;
use App\Models\DetailModel;
use CodeIgniter\HTTP\Request;

class PesananController extends Controller {
    /**
     * Instance of the main Request object. 
     * 
     * @var HTTP\incomingRequest
     */
    protected $request;

    function __construct()
    {
        $this->menu = new MenuModel();
        $this->session = session();
        $this->pesanan = new PesananModel();
        $this->detail = new DetailModel();
    }
    public function index()
    {
        $data['data']= $this->menu->select('id, nama')->findAll();
        if(session('cart')!=null)
        {
            $data['menu']= array_values(session('cart'));
        }else{
            $data['menu']= null;
        }
        return view ('PesananList', $data);
    }
    public function addCart()
    {
        $id = $this->request->getPost('menu_id');
        $jumlah = $this->request->getPost('jumlah');
        $menu = $this->menu->find($id);
        if($menu){
        }
        $isi= array(
            'menu_id'=>$id,
            'nama'=>$menu['nama'],
            'harga'=>$menu['harga'],
            'jumlah'=>$jumlah
        );

        if($this->session->has('cart')){
            $index=$this->cek($id);
            $cart=array_values(session('cart'));
            if($index == -1) {
                array_push($cart, $isi);
            }else{
                $cart[$index]['jumlah']+=$jumlah;
            }
            $this->session->set('cart', $cart);
        }else{
            $this->session->set('cart', array($isi));
        }
        return redirect('pesanan' )->with('success', 'Data berhasil disimpan'. $menu['nama']);
    }

    public function cek($id)
    {
        $cart = array_values(session('cart'));
        for($i=0; $i < count($cart); $i++){
            if($cart[$i]['menu_id'] == $id){
                
                return $i;
            }
        }


        return -1;
    }
    public function hapusCart($id)
    {
        $index = $this->cek($id);
        $cart = array_values(session('cart'));
        unset($cart[$index]);
        $this->session->set('cart', $cart);
        return redirect('pesanan')->with('success','Data Berhasil Dihapus');
    }
    public function simpan()
    {
        if(session('cart') !=null){
            $data = array(
                'tanggal'=>date('Y/m/d H:i:s'),
                'user_id'=>1,
                'no_meja'=>$this->request->getPost('no_meja'),
                'nama_pemesan'=>$this->request->getPost('nama_pemesan'),
                'total_harga'=>'0'
            );
            $id = $this->pesanan->insert($data);
            $cart = array_values(session('cart'));
            $tHarga=0;
            foreach($cart as $val){
                $datadetail = array(
                    'pesanan_id'=>$id,
                    'menu_id'=>$val['menu_id'],
                    'jumlah' =>$val['jumlah'],
                );
                $tHarga +=$val['jumlah']*$val['harga'];
                $this->detail->insert($datadetail);
            }
            $dtHarga= array(
                'total_harga' =>$tHarga
            );
                $this->pesanan->update($id,$dtHarga);
                $this->session->remove('cart');
            return redirect('pesanan')->with('success','Data');
        }
    }
}