<?php

    require "fungsi.php";

    $id = $_GET["id"];

    $query = "DELETE FROM Mahasiswa WHERE id=$id";

    mysqli_query($koneksi,$query);

    if(mysqli_affected_rows($koneksi) > 0)
    {
        echo "<script>
                    alert('Data Berhasil Dihapus!!!');
                    window.location.href='mahasiswa.php';
                  </script>";
    }
    else
    {
        echo "<script>
                    alert('Data Gagal Dihapus!!!');
                    window.location.href='mahasiswa.php';
                  </script>";
    }
?>