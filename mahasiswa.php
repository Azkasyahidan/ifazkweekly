<?php

    require "fungsi.php";

    $query = "SELECT * FROM MAHASISWA";
    $mahasiswas = tampildata($query);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa Informatika</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h1>INFORMATIKA 2026</h1>
        <table border="1" cellspacing="0" cellpadding="10px">
            <tr>
                <td><a href="index.php">Home</a></td>
                <td><a href="profile.php">Profile</a></td>
                <td><a href="contact.php">Contact</a></td>
                <td><a href="mahasiswa.php">Data Mahasiswa</a></td>
            </tr>
        </table>
        <br>
        <hr/>
        <h2>Data Mahasiswa</h2>
        <a href="tambahdata.php">
            <button>Tambah Data</button>
        </a>
        <table border="1" cellpadding="10px">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Jurusan</th>
                <th>Email</th>
                <th>No Hp</th>
                <th>Foto</th>
                <th>Aksi</th> </tr>
            <?php
                $no = 1; // Perbaikan: Nama variabel diganti huruf ($no), bukan angka ($1)
                foreach($mahasiswas as $mhs) 
                    {
            ?>
            <tr>
                <td align="center"><?= $no; ?></td>
                <td><?php echo $mhs["nama"]; ?></td>
                <td><?php echo $mhs["nim"]; ?></td>
                <td><?php echo $mhs["jurusan"]; ?></td>
                <td><?php echo $mhs["email"]; ?></td>
                <td><?php echo $mhs["no_hp"]; ?></td>
                <td>
                    <img src="image/asets/<?php echo $mhs["foto"]; ?>" alt="foto" width="60px">
                </td>
                <td>
                    <a href="ubahdata.php?id=<?php echo $mhs["id"]; ?>"><button>Edit</button></a> | 
                    <a href="hapusdata.php?id=<?php echo $mhs["id"]; ?>" onclick="return confirm('Anda Yakin')" ><button>Hapus</button></a>
                </td> 
            </tr>
            <?php
                $no++; // Angka naik otomatis 1, 2, 3...
                } 
            ?>
        </table>
        <br>
        <hr>
        <h3>Table Mahasiswa</h3>
        <table border="1" cellpadding="10px">
            <tr>
                <td>1,1</td>
                <td>1,2</td>
                <td>1,3</td>
                <td>1,4</td>
            </tr>
            <tr>
                <td>2,1</td>
                <td align="center" rowspan="2" colspan="2">?</td>
                <td>2,4</td>
            </tr>
            <tr>
                <td>3,1</td>
                <td>3,4</td>
            </tr>
            <tr>
                <td>4,1</td>
                <td>4,2</td>
                <td>4,3</td>
                <td>4,4</td>
            </tr>
        </table>
        <br>
        <hr/>
</body>
</html>