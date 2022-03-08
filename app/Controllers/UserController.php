<?php 
namespace APP\controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class UserController extends Controller {
    /**
     * instance of the main Request object.
     * 
     * @var HTTP\
     */
    protected $request;


    function __construct()
    {
        $this->user = new UserModel();  
     }
    public function tampil()
    {
        $data['data'] = $this->user->findAll();
        return view('userlist',$data);
    }
    public function simpan()
    {
        $data = array(       
             'nama'=>$this->request->getPost('nama'),
            'ussername'=>$this->request->getPost('ussername'),
            'password'=>password_hash($this->request->getPost('password'),PASSWORD_DEFAULT),
            'role'=>$this->request->getPost('role'),
        );
        $this->user->insert($data);
        return redirect('user')->with('success','data berhasil disimpan');
    }
    public function delete($id)
    {
        #code...
        $this->user->delete($id);
        return redirect('user')->with('success','Data berhasil dihapus');
    }
    public function edit($id)
    {
        #code...
        $pass = $this->request->getPost('password');
        if(empty($pass)){
            $data = array(
                'nama'=>$this->request->getPost('nama'),
                'ussername'=>$this->request->getPost('ussername'),
                'role'=>$this->request->getPost('role'),
            );
        }else{
            $data = array(
                'nama'=>$this->request->getPost('nama'),
                'ussername'=>$this->request->getPost('ussername'),
                'password'=>password_hash($this->request->getPost('password'),PASSWORD_DEFAULT),
                'role'=>$this->request->getPost('role'),       
            );
            $this->user->update($id,$data);
            return redirect('user')->With('success','data berhasil di edit');
        }
        $this->user->update($id,$data);
            return redirect('user')->With('success','data berhasil di edit');
    }
    public function tlogin()
    {
        return view('login');
    }
    public function login()
    {
        $session = session();
        $ussername = $this->request->getPost('ussername');
        $password = $this->request->getPost('password');
        $data = $this->user->where('ussername',$ussername)->first();
        if($data) {
            $pass =$data['password'];
            $cek_pass = password_verify($password, $pass);
            if ($cek_pass) {
                $ses_data = [
                    'id'=>$data['id'],
                    'usssername'=>$data['ussername'],
                    'role'=>$data['role']
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboard');
            }else {
                $session->setFlashdata('msg','password kliru ditemukan');
                return redirect('login');
            }
        }else {
            $session->setFlashdata('msg','password tidak ditemukan');
            return redirect('login');
        }
    }
    public function logout()
    {
        #code...
        $session = session();
        $session->destroy();
        return redirect('login');
    }
    public function show($id)
    {
        #code...
    }
 
}