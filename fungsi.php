<?php

$koneksi = mysqli_connect("localhost", "root", "root", "IFAZKWEEKLY");

if (!$koneksi) {
    die("Koneksi Database Gagal: " . mysqli_connect_error());
}

function tampildata($query)
{
    global $koneksi;

    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Error Database: " . mysqli_error($koneksi));
    }

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function tambahdata($data, $files)
{
    global $koneksi;

    $nama    = htmlspecialchars($data["nama"]);
    $nim     = htmlspecialchars($data["nim"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $email   = htmlspecialchars($data["email"]);
    $nohp    = htmlspecialchars($data["no_hp"]);

    // --- 1. VALIDASI: Cek apakah NIM sudah terdaftar ---
    $stmt = mysqli_prepare($koneksi, "SELECT nim FROM Mahasiswa WHERE nim = ?");
    mysqli_stmt_bind_param($stmt, "s", $nim);
    mysqli_stmt_execute($stmt);
    $cek_nim = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($cek_nim) > 0) {
        echo "<script>
                alert('Gagal: NIM $nim sudah terdaftar di database!');
              </script>";
        return 0; // Hentikan fungsi dan kembalikan nilai 0 (gagal)
    }
    // ----------------------------------------------------

    // --- 2. VALIDASI: Cek apakah foto benar-benar diupload ---
    $newnamefoto = "";

    if (isset($files["foto"]) && $files["foto"]["error"] === UPLOAD_ERR_OK) {
        $namafoto = basename($files["foto"]["name"]);
        $tmpfoto  = $files["foto"]["tmp_name"];

        $date = date('dmY_His');
        $newnamefoto = $date . "_" . $namafoto;

        $path = "image/asets/" . $newnamefoto;

        if (!move_uploaded_file($tmpfoto, $path)) {
            // JIKA GAGAL KARENA FOLDER/FILE UPLOAD:
            echo "<script>
                    alert('Gagal mengupload gambar. Periksa apakah folder image/asets/ sudah ada dan bisa ditulis.');
                  </script>";
            return 0;
        }
    } elseif (isset($files["foto"]) && $files["foto"]["error"] !== UPLOAD_ERR_NO_FILE) {
        // Ada error upload selain "tidak ada file dipilih"
        echo "<script>
                alert('Gagal mengupload gambar. Silakan coba lagi.');
              </script>";
        return 0;
    }
    // Jika tidak ada foto yang dipilih, $newnamefoto tetap string kosong (foto bersifat opsional)

    $stmt = mysqli_prepare(
        $koneksi,
        "INSERT INTO Mahasiswa (nama, nim, jurusan, email, no_hp, foto)
         VALUES (?, ?, ?, ?, ?, ?)"
    );
    mysqli_stmt_bind_param($stmt, "ssssss", $nama, $nim, $jurusan, $email, $nohp, $newnamefoto);

    $eksekusi = mysqli_stmt_execute($stmt);

    // JIKA QUERY DATABASE GAGAL:
    if (!$eksekusi) {
        die("Error Database: " . mysqli_error($koneksi));
    }

    return mysqli_stmt_affected_rows($stmt);
}

function hapusdata($id)
{
    global $koneksi;

    $stmt = mysqli_prepare($koneksi, "DELETE FROM Mahasiswa WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    return mysqli_stmt_affected_rows($stmt);
}

function ubahdata($data, $id, $files = null)
{
    global $koneksi;

    $nama    = htmlspecialchars($data["nama"]);
    $nim     = htmlspecialchars($data["nim"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $email   = htmlspecialchars($data["email"]);
    $nohp    = htmlspecialchars($data["no_hp"]);

    // Ambil nama foto lama dari database sebagai default
    $stmt = mysqli_prepare($koneksi, "SELECT foto FROM Mahasiswa WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $foto = $row ? $row["foto"] : "";

    // Jika user mengupload foto baru, pakai foto baru. Jika tidak, foto lama tetap dipakai.
    if ($files !== null && isset($files["foto"]) && $files["foto"]["error"] === UPLOAD_ERR_OK) {
        $namafoto = basename($files["foto"]["name"]);
        $tmpfoto  = $files["foto"]["tmp_name"];

        $date = date('dmY_His');
        $newnamefoto = $date . "_" . $namafoto;
        $path = "image/asets/" . $newnamefoto;

        if (move_uploaded_file($tmpfoto, $path)) {
            $foto = $newnamefoto;
        } else {
            echo "<script>
                    alert('Gagal mengupload gambar baru. Foto lama tetap digunakan.');
                  </script>";
        }
    }

    $stmt = mysqli_prepare(
        $koneksi,
        "UPDATE Mahasiswa SET
            nama = ?, nim = ?, jurusan = ?, email = ?, no_hp = ?, foto = ?
         WHERE id = ?"
    );
    mysqli_stmt_bind_param($stmt, "ssssssi", $nama, $nim, $jurusan, $email, $nohp, $foto, $id);
    mysqli_stmt_execute($stmt);

    return mysqli_stmt_affected_rows($stmt);
}

?>
