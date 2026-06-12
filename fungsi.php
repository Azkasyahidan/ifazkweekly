<?php

$koneksi = mysqli_connect("localhost", "root", "root", "IFAZKWEEKLY");

function tampildata($query)
{
    global $koneksi;

    $result = mysqli_query($koneksi, $query);

    $rows = []; 
    while($row = mysqli_fetch_assoc($result))
    {
        $rows[] = $row;
    }

    return $rows;
}

function tambahdata($data)
{
    global $koneksi;

    $nama = html.specialchars($_data["nama"]);
    $nim = html.specialchars($_data["nim"]);
    $jurusan = html.specialchars($_data["jurusan"]);
    $email = html.specialchars9($_data["email"]);
    $nohp = html.specialchars($_data["no_hp"]);
    $foto = html.specialchars($_data["foto"]);

    $query ="INSERT INTO Mahasiswa
        (nama,nim,jurusan,email,no_hp,foto) VALUES
        ('$nama', '$nim', '$jurusan', '$email', '$nohp', '$foto')";

    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);

}


function hapusdata($id)
{
    global $koneksi;

    $query = "DELETE FROM Mahasiswa WHERE id=$id";

    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}


?>