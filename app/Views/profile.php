    <?= $this->extend('layouts/app') ?>
    
    <?= $this->section('content') ?>
    
    <center>
      <div class="container">
      <img src ="<?= $user['foto']??'<default-foto'?>" width="100%" height="100%" alt="">
      <div class="item" ><?= $user['nama']?></div>
      <div class="item" ><?= $user['npm']?></div>
      <div class="item" ><?= $user['nama_kelas']?></div>
</div>
</center>
    <?= $this->endSection() ?>