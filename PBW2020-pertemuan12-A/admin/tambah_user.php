<?php
    session_start();
    include '../koneksi.php';
    $nama = $_SESSION["nama"];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Tambah Data</title>
</head>
<body>
    <div class="main">
        <div class="navbar" style="">
            <a href="admin.php">
                Welcome admin, <?php echo $nama; ?>!
            </a>
            <a href="../logout.php">
                <i aria-hidden="true" class="fas fa-sign-out-alt"></i>
                Log Out
            </a>
        </div>
        <div class="content">
            <div class="container-fluid mt-2">
                <label>
                    <h3>TAMBAH DATA MAHASISWA</h3>
                </label>
                <form method="POST" action="">
                    <table class="tabel" style="width:50%">
                        <tr>			
                            <th>Nama</th>
                            <td>:
                                <input type="text" name="nama" style='width:90%; padding: 5px 5px; margin: 5px 0;background-color: #dee2e6; border: 2px solid #212529; border-radius: 2px;'>
                            </td>
                        </tr>
                        <tr>
                            <th>NIM</th>
                            <td>:
                                <input type="number" name="nim" style='width:90%; padding: 5px 5px; margin: 5px 0;background-color: #dee2e6; border: 2px solid #212529; border-radius: 2px;'>
                            </td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>:
                                <input type="text" name="alamat" style='width:90%; padding: 5px 5px; margin: 5px 0;background-color: #dee2e6; border: 2px solid #212529; border-radius: 2px;'>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><br><input type="submit" value="SIMPAN"  style='background-color: #242423; border-radius: 1rem; cursor: pointer; color: white; padding: 8px 20px;'></td>
                        </tr>		
                    </table>
                </form>
    <?php
        if($_POST){
            $nama = $_POST['nama'];
            $nim = $_POST['nim'];
            $alamat = $_POST['alamat'];

            $insert = mysqli_query ($kon, "INSERT INTO mahasiswa (nama, nim, alamat) VALUES('$nama','$nim','$alamat')");

            if($insert){
                header('location:admin.php');
            }else{
                echo 'EROR' .mysqli_error();
            }
        }
    ?>
</body>
</html>