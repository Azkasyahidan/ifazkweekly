<?php

    require "fungsi.php";

    $id = $_GET["id"];

    $query = "SELECT * FROM Mahasiswa WHERE id=$id";

    $mhs = tampildata($query)[0];

    if(isset($_POST["Submit"]))
    {
        $nama = $_POST["nama"];
        $nim = $_POST["nim"];
        $jurusan = $_POST["jurusan"];
        $email = $_POST["email"];
        $nohp = $_POST["no_hp"];
        $foto = $_POST["foto"];

        if(ubahdata($_POST, $id) > 0)
        {
            echo "<script>
                    alert('Data Berhasil Diubah!!!');
                    window.location.href='mahasiswa.php';
                  </script>";
        }
        else
        {
            echo "<script>
                    alert('Data Gagal Diubah!!!');
                    window.location.href='mahasiswa.php';
                  </script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Mahasiswa</title>
</head>
<body>
    <h2>Ubah Data Mahasiswa</h2>
    
    <form action="" method="post" enctype="multipart/form-data">        <table>
            <tr>
                <td><label for="nama">Nama :</label></td>
                <td>:</td>
                <td><input type="text" id="nama" name="nama" required
                value="<?= $mhs["nama"]?>" /></td>
            </tr>
            <tr>
                <td><label for="nim">NIM :</label></td>
                <td>:</td>
                <td><input type="number" id="nim" name="nim" required 
                value="<?= $mhs["nim"]?>"/></td>
            </tr>
            <tr>
                <td><label for="jurusan">Jurusan :</label></td>
                <td>:</td>
                <td><input type="text" id="jurusan" name="jurusan" required
                value="<?= $mhs["jurusan"]?>" /></td>
            </tr>
            <tr>
                <td><label for="email">Email :</label></td>
                <td>:</td>
                <td><input type="email" id="email" name="email" required
                value="<?= $mhs["email"]?>" /></td>
            </tr>
            <tr>
                <td><label for="no_hp">No HP :</label></td>
                <td>:</td>
                <td><input type="number" id="no_hp" name="no_hp" required
                value="<?= $mhs["no_hp"]?>" /></td>
            </tr>
            <tr>
                <td><label for="foto">Foto :</label></td>
                <td>:</td>
                <td><input type="file" id="foto" name="foto" required
                value="<?= $mhs["foto"]?>" /></td>
            </tr>
        </table>
        <br>
        <input type="submit" name="Submit" value="Submit">
    </form>
</body>
</html>