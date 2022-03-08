<?= $this->extend('layouts/admin') ?>
<?= $this->section('content')?>
<?php 
if(session()->getFlashdata('succes')) {
?>
<div class="alert-success alert-dismissible fade-show" role="alert">
    <?= session()->getFlashdata('success')?>
    <button type="buton" class="close" data-dissmis="alert" aria-label="close"></button>
</div>
<?php
    }
?>
<table class="table table-striped">
    <h3>Data User</h3>
    <button type="buton" class="btn btn-success mb-2" data-toggle="modal"data-target="#addUser">Tambah Data</button>

    <table class="table table-border">
         <thead>
            <th>No</th>
            <th>Nama</th>
            <th>Ussername</th>
            <th>Role</th>
            <th>Option</th>
         </thead>
         <tbody>
             <?php
             $no=1;
             foreach ($data as $row):
                ?>
                    <tr>
                        <td><?=$no?></td>
                        <td><?=$row['nama']?></td>
                        <td><?=$row['ussername']?></td>
                        <td><?=$row['role']?></td>
                        <td><a href="#" class="btn btn-info btn-sm btn-edit" data-toggle="modal" data-target="#editUser-<?=$row['id']?>">Edit</a>
                        <a href="<?=base_url('UserController/delete/'.$row['id'])?>" onclick="return onfirm('yakin ingin dihapus')" class="btn btn-danger btn-sm btn-hapus">Hapus</a>
                        </td>
                    </tr>
     <form action="<?=base_url('user/edit/'.$row['id'])?>" method="post">
          <div class="modal fade" id="editUser-<?=$row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                   <div class="modal-content">
                      <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                                <button type="button" class="close" data-dissmis="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                                    <form action="<?=base_url('users')?>" method="post">                                             
                                    <div class="modal-body">

                                   <div class="form-group">
                                       <label>Nama</label>
                                           <input type="text" class="form-control" name="nama" id="nama" value="<?=$row['nama']?>">
                                           </div>
                                            <div class="form-group">
                                               <label>Ussername</label>
                                                    <input type="text" class="form-control" name="ussername" id="ussername" value="<?=$row['ussername']?>">
                                         </div>                              
                                                <div class="form-group">
                                                  <label>Role</label>
                                                     <input type="role" class="form-control" name="role" placeholder="role">
                                               <div class="form-check">
                                                     <input class="form-check-input" type="radio" name="role"id="flexRadioDefault1" value="kasir" <?=$row['role']=="kasir"?"checked":""?>>
                                                     <label class="form-check-label"for="flexRadioDefault1">Kasir</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="role"id="flexRadioDefault2" value="manager" <?=$row['role']=="manager"?"checked":""?>>
                                                    <label class="form-check-label"for="flexRadioDefault1">Manager</label>
                                                </div>
                                                <div class="form-check">
                                                     <input class="form-check-input" type="radio" name="role"id="flexRadioDefault3" value="admin" <?=$row['role']=="admin"?"checked":""?>>
                                                     <label class="form-check-label"for="flexRadioDefault1">Admin</label>
                                                 </div>
                                            </div>     
                                                 <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                 </div>
                                     </div>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </form>
                                <?php
                                $no++;
                                endforeach?>
                         </tbody>
                     </table>
                 </div>

             <form action="/UserController/simpan" method="post">
                        <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                                            <button type="button" class="close" data-dissmis="modal" aria-label="close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                            <form action="<?=base_url('users')?>" method="post">
                                                 <div class="modal-body">
                                            -<div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="text" class="form-control" name="nama" id="nama">
                                                 </div>
                                                <div class="form-group">
                                                    <label>Ussername</label>
                                                     <input type="text" class="form-control" name="ussername" id="ussername">
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="text" class="form-control" name="password" id="password" >
                                                </div>                             
                                                <div class="form-group">
                                                     <label>Role</label>
                                                     
                                               <div class="form-check">
                                                     <input class="form-check-input" type="radio" name="role"id="flexRadioDefault1" value="kasir">
                                                     <label class="form-check-label"for="flexRadioDefault1">Kasir</label>
                                                </div>
                                                <div class="form-check">
                                
                                                <input class="form-check-input" type="radio" name="role"id="flexRadioDefault2" value="manager" >
                                                    <label class="form-check-label"for="flexRadioDefault1">Manager</label>
                                                </div>
                                                <div class="form-check">
                                                     <input class="form-check-input" type="radio" name="role"id="flexRadioDefault3" value="admin">
                                                     <label class="form-check-label"for="flexRadioDefault1">Admin</label>
                                                 </div>
                                            </div>     
                                                 <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                        </div>
                                        </form>
                                 </div>
                             </div>
                         </div>
                     </form>
<?=$this->endSection()?>
