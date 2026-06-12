<?php

    require "fungsi.php";

    if(isset($_POST["Submit"]))
    {
        $nama = $_POST["nama"];
        $nim = $_POST["nim"];
        $jurusan = $_POST["jurusan"];
        $email = $_POST["email"];
        $nohp = $_POST["no_hp"];
        $foto = $_POST["foto"];

        $query ="INSERT INTO Mahasiswa
        (nama,nim,jurusan,email,no_hp,foto) VALUES
        ('$nama', '$nim', '$jurusan', '$email', '$nohp', '$foto')";

        mysqli_query($koneksi, $query);

        if(mysqli_affected_rows($koneksi) > 0)
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
    <title>Tambah Data Mahasiswa</title>
</head>
<body>
    <h2>Tambah Data Mahasiswa</h2>
    
    <form action="" method="post">
        <table>
            <tr>
                <td><label for="nama">Nama :</label></td>
                <td>:</td>
                <td><input type="text" id="nama" name="nama" required /></td>
            </tr>
            <tr>
                <td><label for="nim">NIM :</label></td>
                <td>:</td>
                <td><input type="number" id="nim" name="nim" required /></td>
            </tr>
            <tr>
                <td><label for="jurusan">Jurusan :</label></td>
                <td>:</td>
                <td><input type="text" id="jurusan" name="jurusan" required /></td>
            </tr>
            <tr>
                <td><label for="email">Email :</label></td>
                <td>:</td>
                <td><input type="email" id="email" name="email" /></td>
            </tr>
            <tr>
                <td><label for="no_hp">No HP :</label></td>
                <td>:</td>
                <td><input type="number" id="no_hp" name="no_hp" /></td>
            </tr>
            <tr>
                <td><label for="foto">Foto :</label></td>
                <td>:</td>
                <td><input type="text" id="foto" name="foto" /></td>
            </tr>
        </table>
        <br>
        <input type="submit" name="Submit" value="Submit">
    </form>
</body>
</html>