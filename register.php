<?php
    require 'fungsi.php';

    if(isset($_POST["register"]))
    {
        if(register($_POST) > 0)
        {
            echo "<script>
                    alert('User Berhasil Dibuat');
                    window.location.href='index.php';
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
    <meta name="viewport" content="width=<, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>

<style>
        form label {
            display: block;     /* Memaksa label menjadi satu baris penuh */
            margin-top: 12px;   /* Memberi jarak antar kolom */
            font-weight: bold;
        }
        form input {
            display: block;     /* Memaksa input turun ke bawah label */
            margin-top: 4px;    /* Jarak antara label dan kotakan input */
            padding: 4px;
            width: 250px;       /* Mengatur lebar kotak input agar seragam */
        }
        form button {
            margin-top: 15px;   /* Jarak tombol dari kolom di atasnya */
            padding: 5px 15px;
            cursor: pointer;
        }
</style>

<body>
    <h1>Register User</h1>
    <hr>
    <form action= "" method="post">
        <label>Username : </label>
        <input type="text" name="username" required><br>
        <label>Password : </label>
        <input type="password" name="password1" required><br>
        <label>Konfirmasi Password</label>
        <input type="password" name="password2" required><br>
        <button type="submit" name="register">Register</button>
    </form>
</body>
</html>