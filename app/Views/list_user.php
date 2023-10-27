<style>
    div {
        width: 200px;
        height: 50px;
    }

    table, th, td {
        border: 1px solid black;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<?= $this->extend('layouts/app')?>

<?= $this->section('content')?>
    Ini halaman user
    <a href="<?= base_url('/user/create')?>">Tambah Data</a>
    <div class='table-responsive'>
    <table class='table'>
        <thead> 
            <tr>
                <th>No</th> <!-- Change the header to "No" -->
                <th>Nama</th>
                <th>NPM</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $counter = 1; // Add a counter to start from 1
            foreach ($users as $user) {
            ?>
                <tr>
                <td><?= $counter++ ?></td> <!-- Display the counter -->
                <td><?= $user['nama']?></td>
                <td><?= $user['npm']?></td>
                <td><?= $user['nama_kelas']?></td>
                <td>
                <a href="<?= base_url('user/' . $user['id'])?>">Detail</a>
                    <a href="<?= base_url('user/'. $user['id'].'/edit/')?>">Edit</a> <!-- Removed the user ID from the Edit link -->
                    <td>
                        <form action="<?= base_url('user/delete/' . $user['id']) ?>" method="POST">
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
