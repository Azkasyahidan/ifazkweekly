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
    
    // --- 1. VALIDASI: Cek apakah NIM sudah terdaftar ---
    $cek_nim = mysqli_query($koneksi, "SELECT nim FROM Mahasiswa WHERE nim = '$nim'");
    if (mysqli_num_rows($cek_nim) > 0) {
        echo "<script>
                alert('Gagal: NIM $nim sudah terdaftar di database!');
              </script>";
        return 0; // Hentikan fungsi dan kembalikan nilai 0 (gagal)
    }
    // ----------------------------------------------------

    $namafoto = $files["foto"]["name"];
    $tmpfoto = $files["foto"]["tmp_name"];
    
    $date = date('dmY_His');
    $newnamefoto = $date . "_" . $namafoto;

    $path = "image/asets/" . $newnamefoto;

    if(move_uploaded_file($tmpfoto, $path))
    {
        $query = "INSERT INTO Mahasiswa
                (nama, nim, jurusan, email, no_hp, foto)
                VALUES
                ('$nama', '$nim', '$jurusan', '$email', '$nohp', '$newnamefoto')";

        $eksekusi = mysqli_query($koneksi, $query);

        // JIKA QUERY DATABASE GAGAL:
        if(!$eksekusi) {
            die("Error Database: " . mysqli_error($koneksi));
        }

        return mysqli_affected_rows($koneksi);
    } else {
        // JIKA GAGAL KARENA FOLDER/FILE UPLOAD:
        die("Gagal mengupload gambar. Periksa apakah folder 'image/asets/' sudah ada dan bisa ditulis.");
    }
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