<?php
session_start();
include '../koneksi.php';

if(isset($_GET['id_mhs'])){
    $id = $_GET['id_mhs'];
    $sql = "DELETE FROM mahasiswa WHERE id ='".$id."'";
    $query = mysqli_query($kon, $sql);
    
    if(mysqli_affected_rows($kon)){
        header("location:admin.php");
    }else{
        header("location:admin.php");
    }
}
?>