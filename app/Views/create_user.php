<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php echo base_url('./css/style.css'); ?>">

    <title>user</title>
</head>
<body>
    <form action="<?php echo base_url('/user/store') ?>" method="POST">
        <!-- Input untuk nama -->
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required><br><br>

        <!-- Input untuk npm -->
        <label for="npm">NPM:</label>
        <input type="text" id="npm" name="npm" required><br><br>

        <!-- Input untuk kelas -->
        <label for="kelas">Kelas:</label>
        <input type="text" id="kelas" name="kelas" required><br><br>

        <!-- Tombol submit -->
        <input type="submit" value="Submit">
    </form>
</body>
</html>