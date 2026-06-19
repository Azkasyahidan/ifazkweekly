<?php

$koneksi = mysqli_connect("localhost", "root", "root", "IFAZKWEEKLY");

function tampildata($query)
{
    global $koneksi;

    $result = mysqli_query($koneksi, $query);

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function tambahdata($data, $files)
{
    global $koneksi;

    $nama = htmlspecialchars($data["nama"]);
    $nim = htmlspecialchars($data["nim"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $email = htmlspecialchars($data["email"]);
    $nohp = htmlspecialchars($data["no_hp"]);
    $foto = htmlspecialchars($data["foto"]);

    $namafoto = $files["name"];
    $tmpfoto = $files["tmp_name"];
    $date = date('dmY_His');
    $newnamefoto = $date.$namafoto;

    $path = "assets/images/";

    if(move_upload_file($tmpfoto, $path))

    $query = "INSERT INTO Mahasiswa
              (nama, nim, jurusan, email, no_hp, foto)
              VALUES
              ('$nama', '$nim', '$jurusan', '$email', '$nohp', '$foto')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function hapusdata($id)
{
    global $koneksi;

    $query = "DELETE FROM Mahasiswa WHERE id = $id";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function ubahdata($data, $id)
{
    global $koneksi;

    $nama = htmlspecialchars($data["nama"]);
    $nim = htmlspecialchars($data["nim"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $email = htmlspecialchars($data["email"]);
    $nohp = htmlspecialchars($data["no_hp"]);
    $foto = htmlspecialchars($data["foto"]);

    $query = "UPDATE Mahasiswa SET
                nama = '$nama',
                nim = '$nim',
                jurusan = '$jurusan',
                email = '$email',
                no_hp = '$nohp',
                foto = '$foto'
              WHERE id = $id";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

?>