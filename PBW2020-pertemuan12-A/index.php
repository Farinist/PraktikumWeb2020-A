<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Praktikum Pemrograman Web Pertemuan 12</title>
</head>

<body>
    <div class="container ml-20">
        <div class="row border-box">
				<div class="col-md-12 p-5">
					<div class="shadow-lg p-2 bg-white rounded">
						<div class="card">
							<div class="text-center">
								<br>
								<h1><b>LOGIN</b></h1><br>
							</div>
                            <br />
                            <?php
                                //untuk mencegah inputan karakter yang tidak sesuai
                                function input($data) {
                                    $data = trim($data);
                                    $data = stripslashes($data);
                                    $data = htmlspecialchars($data);
                                    return $data;
                                }
                                //untuk mengecek apakah ada kiriman form dari method post
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                                    session_start();
                                    include "koneksi.php";
                                    $username = input($_POST["username"]);
                                    $p = input(md5($_POST["password"]));

                                    $sql = "select * from users where username='".$username."' and password='".$p."' limit 1";
                                    $hasil = mysqli_query ($kon, $sql);
                                    $jumlah = mysqli_num_rows($hasil);

                                    if ($jumlah>0) {
                                        $row = mysqli_fetch_assoc($hasil);
                                        $_SESSION["id_user"]=$row["id_user"];
                                        $_SESSION["username"]=$row["username"];
                                        $_SESSION["nama"]=$row["nama"];
                                        $_SESSION["email"]=$row["email"];
                                        $_SESSION["level"]=$row["level"];
                                
                                
                                        if ($_SESSION["level"]=$row["level"]==1)
                                        {
                                            header("Location:admin/admin.php");
                                        } else if ($_SESSION["level"]=$row["level"]==2)
                                        {
                                            header("Location:pegawai/pegawai.php");
                                        }else if ($_SESSION["level"]=$row["level"]==3){
                                            header("Location:pegawai/pegawai.php");
                                        }
                                
                                        
                                    }else {
                                        echo "<div class='alert alert-danger'>
                                        <strong>Error!</strong> Username dan password salah. 
                                    </div>";
                                    }

                                }
                            
                            ?>
							<div class="card-body p-3 pb-3">
                                <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control form" name="username" placeholder="Masukan Username">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control form" name="password" placeholder="Masukan Password">
                                    </div>
                                    <br /><br />
                                    <div class="form-group">
                                        <input type="submit"  class="btn btn-primary btn-lg btn-block login"  value="LOGIN">
                                    </div>
                                </form>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
    </body>
</html>