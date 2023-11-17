<?php
    include 'koneksi.php';

    if(isset($_POST['aksi'])){
        if($_POST['aksi'] == "add"){

            $nim = $_POST['nim'];
            $nama_mahasiswa = $_POST['nama_mahasiswa'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $foto = $_FILES['foto']['name'];
            $alamat = $_POST['alamat'];

            $dir = "img/";
            $tmpFile = $_FILES['foto']['tmp_name'];

            move_uploaded_file($tmpFile, $dir.$foto);

            //die();

            $query = "INSERT INTO tb_mahasiswa VALUES(null, '$nim', '$nama_mahasiswa', '$jenis_kelamin', '$foto', '$alamat')";
            $sql = mysqli_query($conn, $query);

            if($sql){
                header("location: index.php");
                   // echo "Data Berhasil Ditambahakan <a href='index.php'>[Home]</a>";
            } else {
                echo $query;
            }

            //echo $nim." | ".$nama_mahasiswa." | ".$jenis_kelamin. " | ".$foto." | ".$alamat;

            //echo "<br>Tambah Data <a href='index.php'>[Home]</a>";
        }else if ($_POST['aksi'] == "edit"){
            //echo "Edit Data <a href='index.php'>[Home]</a>";
            //var_dump($_POST);

            $id_mahasiswa = $_POST['id_mahasiswa'];
            $nim = $_POST['nim'];
            $nama_mahasiswa = $_POST['nama_mahasiswa'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $alamat = $_POST['alamat'];

            $queryShow = "SELECT * FROM tb_mahasiswa WHERE id_mahasiswa = '$id_mahasiswa';";
            $sqlShow = mysqli_query($conn, $queryShow);
            $result = mysqli_fetch_assoc($sqlShow);

            if($_FILES['foto']['name'] == ""){
                $foto = $result['foto_mahasiswa'];
            } else {
                $foto = $_FILES['foto']['name'];
                unlink("img/".$result['foto_mahasiswa']);
                move_uploaded_file($_FILES['foto']['tmp_name'], 'img/'.$_FILES['foto']['name']);
            }


            $query = "UPDATE tb_mahasiswa SET nim='$nim', nama_mahasiswa='$nama_mahasiswa', jenis_kelamin='$jenis_kelamin', alamat = '$alamat', foto_mahasiswa = '$foto' WHERE id_mahasiswa='$id_mahasiswa';";
            $sql = mysqli_query($conn, $query);
            header("location: index.php");

        }
    }
        if(isset($_GET['hapus'])){
            $id_mahasiswa = $_GET['hapus'];

            $queryShow = "SELECT * FROM tb_mahasiswa WHERE id_mahasiswa = '$id_mahasiswa';";
            $sqlShow = mysqli_query($conn, $queryShow);
            $result = mysqli_fetch_assoc($sqlShow);

            //var_dump($result);
            
            unlink("img/".$result['foto_mahasiswa']);

            $query = "DELETE FROM tb_mahasiswa WHERE id_mahasiswa = '$id_mahasiswa'";
            $sql = mysqli_query($conn, $query);

            if($sql){
                header("location: index.php");
                   // echo "Data Berhasil Ditambahakan <a href='index.php'>[Home]</a>";
            } else {
                echo $query;
            }

            //echo "Hapus Data <a href='index.php'>[Home]</a>";
        }
        
?>