<?= $this->extend('layouts/admin') ?>
<?= $this->section('content')?>
<?php 
if(session()->getFlashdata('success')) {
?>
<div class="alert-success alert-dismissible fade-show" role="alert">
    <?= session()->getFlashdata('success')?>
    <button type="buton" class="close" data-dissmis="alert" aria-label="close"></button>
</div>
<?php
    }
?>
<table class="table table-striped">
    <h3>Data Menu</h3>
    <button type="buton" class="btn btn-primary mb-2" data-toggle="modal"data-target="#addMenu">Tambah Data</button>

    <table class="table table-border">
         <thead>
            <th>No</th>
            <th>Nama Makanan</th>
            <th>harga</th>
            <th>stok</th>
            <th>jenis</th>
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
                <td><?=$row['harga']?></td>
                <td><?=$row['stok']?></td>
                <td><?=$row['jenis']?></td>
                <td><a href="#" class="btn btn-info btn-sm btn-edit" data-toggle="modal" data-target="#editMenu-<?=$row['id']?>">Edit</a>
                <a href="<?=base_url('MenuController/delete/'.$row['id'])?>" onclick="return onfirm('yakin ingin dihapus')" class="btn btn-danger btn-sm btn-hapus">Hapus</a>
                </td>
            </tr>

            <form action="<?=base_url('menu/edit/'.$row['id'])?>" method="post">
<div class="modal fade" id="editMenu-<?=$row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Menu</h5>
                <button type="button" class="close" data-dissmis="modal" aria-label="close">
                <span aria-hidden="true">&times;</span>
                </button>
             </div>
             <form action="<?=base_url('menu')?>" method="post">
            <div class="modal-body">

                <div class="form-group">
                    <label>Nama Makanan</label>
                    <input type="text" class="form-control" name="nama" id="nama" value="<?=$row['nama']?>">
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="text" class="form-control" name="harga" id="harga" value="<?=$row['harga']?>">
                </div>   
                <div class="form-group">
                    <label>Stok</label>
                    <input type="text" class="form-control" name="stok" id="stok" value="<?=$row['stok']?>">
                </div>                          
                <div class="form-group">
                    <label>Jenis</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis"id="flexRadioDefault1" value="makanan" <?=$row['jenis']=="makanan"?"checked":""?>>
                        <label class="form-check-label" for="flexRadioDefault1">Makanan</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis"id="flexRadioDefault2" value="minuman" <?=$row['jenis']=="minuman"?"checked":""?>>
                        <label class="form-check-label"for="flexRadioDefault1">Minuman</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis"id="flexRadioDefault3"  value="camilan" <?=$row['jenis']=="camilan"?"checked":""?>>
                        <label class="form-check-label" for="flexRadioDefault1">Camilan</label>
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

<form action="/MenuController/simpan" method="post">
<div class="modal fade" id="addMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Menu</h5>
                <button type="button" class="close" data-dissmis="modal" aria-label="close">
                <span aria-hidden="true">&times;</span>
                </button>
             </div>
            <form action="<?=base_url('menus')?>" method="post">
            <div class="modal-body">

                <div class="form-group">
                    <label>Nama Makanan</label>
                    <input type="text" class="form-control" name="nama" id="nama">
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="text" class="form-control" name="harga" id="harga">
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="text" class="form-control" name="stok" id="stok" >
                </div>                             
                <div class="form-group">
                    <label>Jenis</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis"id="flexRadioDefault1" value="makanan">
                        <label class="form-check-label"for="flexRadioDefault1">Makanan</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis"id="flexRadioDefault2" value="minuman" >
                        <label class="form-check-label"for="flexRadioDefault1">Minuman</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis"id="flexRadioDefault3" value="camilan">
                        <label class="form-check-label"for="flexRadioDefault1">Camilan</label>
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
