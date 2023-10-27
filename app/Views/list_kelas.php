<style>
    div {
        width: 200px;
        height: 50px;
    }

    table, th, td {
        border: 1px solid black;
    }
</style>
<?= $this->extend('layouts/app')?>

<?= $this->section('content')?>
    Ini halaman user
    <a href="<?= base_url('/user/create')?>">Tambah Data</a>
    <div class='table-responsive'>
    <table class='table'>
        <thead> 
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
             $counter = 1; 
            foreach ($user as $u){
            ?>
                <tr>
                <td><?= $counter++?></td>
                <td><?= $u['nama']?></td>
                <td><?= $u['nama_kelas']?></td>
                <td>
                    <a href="<?= base_url('user/' . $u['id'])?>">Detail</a>
                    <a href="<?= base_url('user/' . $u['id'] . '/edit')?>">Edit</a>
                    <td>
                        <form action="<?= base_url('user/delete/' . $u['id']) ?>" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <?= csrf_field() ?>
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </td>
                </tr>
            <?php
            }   
            ?>
        </tbody>
    </table>
    </div>
<?= $this->endSection()?>
