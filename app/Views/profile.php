    <?= $this->extend('layouts/app') ?>
    
    <?= $this->section('content') ?>
    
    <center>
      <div class="container">
      <img src ="
    <?php
        echo base_url('./img/ijah.jpg') ;
    ?>">
      <div class="item" >
            <?= $nama?>
</div>
<div class="item">
            <?= $kelas?>
</div>
<div class="item">
            <?= $npm?>
</div>

</div>
</center>
    <?= $this->endSection() ?>