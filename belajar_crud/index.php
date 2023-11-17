<?php
    include 'koneksi.php';

    $query = "SELECT * FROM tb_mahasiswa;";
    $sql = mysqli_query($conn, $query);
    $no = 0;


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!--bootstrap-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>

    <!--FontAwesome-->
    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">

    <title>tugas crud m.ilham alfarizi</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            CRUD
          </a>
        </div>
    </nav>

    <!--Judul-->
   <div class="container">
        <h1 class="mt-4">Data Mahasiswa</h1>
        <figure>
            <blockquote class="blockquote">
                <p>Data yang disimpan database.</p>
            </blockquote>
            <figcaption class="blockquote-footer">
                CRUD <cite title="Source Title">Create Read Update Delete</cite>
            </figcaption>
      </figure>
        <a href="kelola.php" type="button" class="btn btn-primary mb-3">
            <i class="fa fa-plus"></i>
            Tambah Data
        </a>
      <div class="table-responsive">
        <table class="table align-middle table-bordered table-hover">
            <thead>
                <tr>
                    <th><center>NO.</center></th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Jenis Kelamin</th>
                    <th>Foto Mahasiswa</th>
                    <th>Alamat</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($result = mysqli_fetch_assoc($sql)){
                ?>
                <tr>
                    <td><center>
                        <?php echo ++$no; ?>.
                    </center></td>
                    <td>
                        <?php echo $result['nim']; ?>
                    </td>
                    <td>
                        <?php echo $result['nama_mahasiswa']; ?>
                    </td>
                    <td>
                        <?php echo $result['jenis_kelamin']; ?>
                    </td>
                    <td>
                        <img src="img/<?php echo $result['foto_mahasiswa']; ?>" style="width: 150px;">
                    </td>
                    <td>
                        <?php echo $result['alamat']; ?>
                    </td>
                    <td>
                        <!--edit-->
                        <a href="kelola.php?ubah=<?php echo $result['id_mahasiswa'];?>" type="button" class="btn btn-success btn-sm">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <!--hapus-->
                        <a href="proses.php?hapus=<?php echo $result['id_mahasiswa'];?>" type="button" class="btn btn-danger btn-sm" 
                            onclick="return confirm('Apakah anda yakin ingin menghapus data tersebut?')">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
               <?php
                    }
               ?>
            </tbody>
        </table>
      </div>
   </div>

</body>
</html>