<?= $this->extend('layouts/app')?>

<?= $this->section('content')?>
    Ini halaman user
    <a href="<?= base_url('/user/create')?>">Tambah Data</a>
    <table>
        <thead>
        <style>
            div {
            width:200px;
            height: 50px;
            }
            table, th, td {
            border: 1px solid black;
}

</style>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>NPM</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($users as $user){
            ?>
            
                <tr>
                <td><?= $user['id']?></td>
                <td><?= $user['nama']?></td>
                <td><?= $user['npm']?></td>
                <td><?= $user['nama_kelas']?></td>
                <td>
                    <a href="<?= base_url('user/' . $user['id'])?>">Detail</a>
                    <button type="button">Edit</button>
                    <button type="button">Delete</button>
                </td>
                </tr>
            <?php
            }   
            ?>
        </tbody>
    </table>
<?= $this->endSection()?>