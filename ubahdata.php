<?php

    require "fungsi.php";

    $id = (int) $_GET["id"];

    $stmt = mysqli_prepare($koneksi, "SELECT * FROM Mahasiswa WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $mhs = mysqli_fetch_assoc($result);

    if (!$mhs) {
        die("Data mahasiswa tidak ditemukan.");
    }

    if(isset($_POST["Submit"]))
    {
        if(ubahdata($_POST, $id, $_FILES) > 0)
        {
            echo "<script>
                    alert('Data Berhasil Diubah!!!');
                    window.location.href='mahasiswa.php';
                  </script>";
        }
        else
        {
            echo "<script>
                    alert('Tidak Ada Perubahan Data Atau Data Gagal Diubah!!!');
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

    <form action="" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="nama">Nama</label></td>
                <td>:</td>
                <td><input type="text" id="nama" name="nama" required
                value="<?= htmlspecialchars($mhs["nama"]) ?>" /></td>
            </tr>
            <tr>
                <td><label for="nim">NIM</label></td>
                <td>:</td>
                <td><input type="number" id="nim" name="nim" required
                value="<?= htmlspecialchars($mhs["nim"]) ?>"/></td>
            </tr>
            <tr>
                <td><label for="jurusan">Jurusan</label></td>
                <td>:</td>
                <td><input type="text" id="jurusan" name="jurusan" required
                value="<?= htmlspecialchars($mhs["jurusan"]) ?>" /></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td>:</td>
                <td><input type="email" id="email" name="email"
                value="<?= htmlspecialchars($mhs["email"]) ?>" /></td>
            </tr>
            <tr>
                <td><label for="no_hp">No HP</label></td>
                <td>:</td>
                <td><input type="number" id="no_hp" name="no_hp"
                value="<?= htmlspecialchars($mhs["no_hp"]) ?>" /></td>
            </tr>
            <tr>
                <td><label for="foto">Foto Saat Ini</label></td>
                <td>:</td>
                <td>
                    <?php if (!empty($mhs["foto"])): ?>
                        <img src="image/asets/<?= htmlspecialchars($mhs["foto"]) ?>" alt="foto" width="60px"><br>
                    <?php else: ?>
                        (Belum ada foto)<br>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td><label for="foto_baru">Ganti Foto</label></td>
                <td>:</td>
                <td><input type="file" id="foto_baru" name="foto" accept="image/*" />
                    <br><small>Kosongkan jika tidak ingin mengganti foto</small></td>
            </tr>
        </table>
        <br>
        <input type="submit" name="Submit" value="Submit">
        <a href="mahasiswa.php"><button type="button">Batal</button></a>
    </form>
</body>
</html>
