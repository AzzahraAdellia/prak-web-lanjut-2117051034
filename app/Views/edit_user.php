<?= $this->extend('layouts/app') ?>
    
    <?= $this->section('content') ?>
    
    <center>
    <?php $validation = \Config\Services::validation();?>

    <form action="<?= base_url('/user/' . $user['id']) ?>" method="POST" enctype="multipart/form-data">

        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">
        <label for="">Foto</label>
        
        <br>

        <label for="">Nama : </label>
        <input class="form-control <?= (empty(validation_show_error('nama'))) ? '' : 'is-invalid' ?>" type="text" placeholder="Default input" aria-label="default input example" type="text" name="nama" id="" style="width: 20%" value="<?= $user['nama'] ?>" id="nama" old('nama') ?>
        <?= validation_show_error('nama'); ?>
        <br>
        <br>
        
        <label for="">NPM  : </label>
        <input class="form-control <?= (empty(validation_show_error('npm'))) ? '' : 'is-invalid' ?>" type="text" placeholder="Default input" aria-label="default input example" type="text" name="npm" id="" style="width: 20%" value="<?= $user['npm'] ?>" id="npm" old('nama') ?>
        <?= validation_show_error('npm'); ?>
        <br>
        <br>
        
        <label for="">Kelas : </label>
        <select name="kelas" id="kelas">
            <?php
            foreach ($kelas as $item){
            ?>
                <option value="<?= $item['id'] ?>" <?= $user['id_kelas'] == $item['id'] ? 'selected' : '' ?>>
                    <?= $item['nama_kelas'] ?>
                </option>

            <?php
            }
            ?>
        </select>
        <br>

        <img src="<?= $user['foto'] ?? '<default-foto>' ?>">
        <input type="file", name="foto" id="foto">
        
        <button type="submit" class="btn btn-secondary" >Submit</button>
    </form>
    </center>
      <?= $this->endSection() ?>