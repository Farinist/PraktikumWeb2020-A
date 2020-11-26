<?php
ini_set("error_reporting", 0); 
session_start();

//Untuk mengecek apakah form sudah diinput
if(isset($_POST['submit'])){

  $data = array();
  $data['nim'] = $_POST['nim'];                 //untuk menampung nilai nim
  $data['nama'] = $_POST['nama'];               //untuk menampung nilai nama
  $data['nilai_tugas'] = $_POST['nilai_tugas']; //untuk menampung nilai tugas
  $data['nilai_uts'] = $_POST['nilai_uts'];     //untuk menampung nilai uts
  $data['nilai_uas'] = $_POST['nilai_uas'];     //untuk menampung nilai uas

  $data['jml_nilai'] = $data['nilai_tugas'] + $data['nilai_uts'] + $data['nilai_uas']; //untuk menampung nilai dari jumlah nilai
  $data['rata_rata'] = $data['jml_nilai'] / 2; //untuk menampung nilai rata-rata

  if($_SESSION['nilai_mhs']){ //untuk menyimpan data sementara yang berupa array (Pengecekan SESSION)

    $nilai_mhs = $_SESSION['nilai_mhs'];
    array_push($nilai_mhs, $data); //untuk memasukkan data array ke data session
    $_SESSION['nilai_mhs'] = $nilai_mhs;

  }else{

    $_SESSION['nilai_mhs'][] = $data;

  }

  header("location: ./index.php");

}

//untuk pemilihan menambah atau menghapus data
switch($_GET['act']){

  //untuk menghapus data
  case "delete":
  $id = $_GET['id'];
  unset($_SESSION['nilai_mhs'][$id]);
  header("location: ./index.php");
  break;

  case "default":
  break;
}
?>

<style media="screen">
  .form {
    width: 50%;
    margin: 100px auto;
  }
  .form--wrapper {
    margin-top: 100px;
    text-align: center;
  }
  .form__group {
    display: flex;
    flex-wrap: wrap;
    padding-bottom: 10px;
  }
  .form__group label {
    min-width: 100px;
    width: 30%;
    font-weight: 600;
    position: relative;
    text-align: left;
  }
  .form__group:not(:last-child) label:after {
    content: ':';
    position: absolute;
    right: 5px;
    top: 50%;
    transform: translateY(-60%);
  }
  .form__group input {
    padding: 5px;
    background-color: #dee2e6;
    border: 2px solid #212529;
    border-radius: 2px;
    width: 50%;
  }
  .form__group .submit {
    background-color: #242423;
    border-radius: 10px;
    border: 1px solid #000;
    cursor: pointer;
    padding: 16px 32px;
    color: #fff;
  }
  .form__group .submit a {
    color: #fff;
    text-decoration: none;
  }

  .table--list-wrapper {
      max-width: 80%;
      margin: auto;
  }

</style>

<div class="form--wrapper">
  <h1> Input Data Nilai Mahasiswa  </h1>
  <form class="form" action="" method="post">
    <!-- Input NIM -->
    <div class="form__group">
      <label for="nim"> NIM </label>
      <input type="text" name="nim">
    </div>

    <!-- Input Nama -->
    <div class="form__group">
      <label for="nama"> Nama </label>
      <input type="text" name="nama">
    </div>

    <!-- Input Nilai Tugas -->
    <div class="form__group">
      <label for="nilai_tugas"> Nilai Tugas </label>
      <input type="number" name="nilai_tugas">
    </div>

    <!-- Input Nilai UTS -->
    <div class="form__group">
      <label for="nilai_uts"> Nilai UTS </label>
      <input type="number" name="nilai_uts">
    </div>

    <!-- Input Nilai UAS -->
    <div class="form__group">
      <label for="nilai_uas"> Nilai UAS </label>
      <input type="number" name="nilai_uas">
    </div>

    <div class="form__group">
      <label></label>
      <input class="submit" type='submit' name='submit' value='SUBMIT'>
    </div>

  </form>
</div>


<?php
if($_SESSION['nilai_mhs']){ //Untuk menampilkan data yang telah di input
  ?>
  <div class="table--list-wrapper">
    <div style="text-align:center"> <h2> <strong> Data Nilai Mahasiswa </strong> </h2> </div>
    <table border="1"  style="width:100%; text-align:center; border-collapse: collapse;">
      <tr style="height:50px; background-color: #adb5bd">
        <th>No.</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Nilai Tugas</th>
        <th>Nilai UTS</th>
        <th>Nilai UAS</th>
        <th>Jumlah Nilai</th>
        <th>Rata-Rata</th>
        <th>Hapus Data</th>
      </tr>
      <?php $no=0; foreach ($_SESSION['nilai_mhs'] as $key => $value) { $no++; ?>
        <tr>
          <td><?php echo $no;?></td>
          <td style="text-align:left; padding: 10px 5px;"><?php echo $value['nim'];?></td>
          <td style="text-align:left; padding:10px 5px;"><?php echo $value['nama'];?></td>
          <td><?php echo $value['nilai_tugas'];?></td>
          <td><?php echo $value['nilai_uts'];?></td>
          <td><?php echo $value['nilai_uas'];?></td>
          <td><?php echo $value['jml_nilai'];?></td>
          <td><?php echo $value['rata_rata'];?></td>
          <td><button type="button" style="padding: 10px; border-radius: 5px; background-color: #f44336; color: white; border: 2px solid #f44336; cursor: pointer;" onclick="window.location='index.php?act=delete&id=<?php echo $key;?>'">HAPUS</button></td>
        </tr>
      <?php } ?>

    </table>
  </div>

<?php } ?>
