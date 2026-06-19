<?php

    require "fungsi.php";

    if(isset($_POST["Submit"]))
    {
        if(tambahdata($_POST, $_FILES) > 0)
        {
            echo "<script>
                    alert('Data Berhasil Ditambahkan!!!');
                    window.location.href='mahasiswa.php';
                  </script>";
        }
        else
        {
            echo "<script>
                    alert('Data Gagal Ditambahkan!!!');
                  </script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
</head>
<body>
    <h2>Tambah Data Mahasiswa</h2>

    <form action="" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="nama">Nama</label></td>
                <td>:</td>
                <td><input type="text" id="nama" name="nama" required /></td>
            </tr>
            <tr>
                <td><label for="nim">NIM</label></td>
                <td>:</td>
                <td><input type="number" id="nim" name="nim" required /></td>
            </tr>
            <tr>
                <td><label for="jurusan">Jurusan</label></td>
                <td>:</td>
                <td><input type="text" id="jurusan" name="jurusan" required /></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td>:</td>
                <td><input type="email" id="email" name="email" /></td>
            </tr>
            <tr>
                <td><label for="no_hp">No HP</label></td>
                <td>:</td>
                <td><input type="number" id="no_hp" name="no_hp" /></td>
            </tr>
            <tr>
                <td><label for="foto">Foto</label></td>
                <td>:</td>
                <td><input type="file" id="foto" name="foto" accept="image/*" /></td>
            </tr>
        </table>
        <br>
        <input type="submit" name="Submit" value="Submit">
        <a href="mahasiswa.php"><button type="button">Batal</button></a>
    </form>
</body>
</html>
