<?php
if (isset($_GET['album_id'])) {

  require "./koneksi.php";
  $album_id = $_GET['album_id'];
  $queryAlbum = "SELECT * FROM albums WHERE album_id = $album_id";
  $dataAlbum = mysqli_fetch_assoc(mysqli_query($conn, $queryAlbum));
  $sql = "SELECT * FROM photos WHERE album_id = $album_id AND visibility = 'public'";
  $sqlFoto = "SELECT file_foto FROM photos WHERE album_id = $album_id";
  $photos = mysqli_query($conn, $sql);
  $gambar_lama = mysqli_fetch_assoc(mysqli_query($conn, $sqlFoto));
} else {
  echo "<script> alert('Album tidak ditemukan'); </script>";
  header("Location: ./index");
}

?>

<?php require "./components/header.php" ?>
<div class="items-center justify-start w-full p-3">
  <a href="./home.php"><i class="fa fa-chevron-left" aria-hidden="true"></i> Kembali</a>
</div>
<main class="flex-col min-h-screen py-5 md:flex-row">
  <h1 class="text-2xl font-bold text-center text-sky-600">Isi dari Album <?= $dataAlbum['nama_album'] ?> </h1>
  <div class="flex flex-wrap justify-center mt-10 mb-20 md:px-20">
    <?php foreach ($photos as $photo) : ?>
      <div class="p-4 max-w-sm">
        <div class="w-full shadow-md bg-clip-border rounded-xl">
          <div class="relative h-56 mx-4 -mt-6 overflow-hidden text-white shadow-lg bg-clip-border rounded-xl bg-blue-gray-500 shadow-blue-gray-500/40">
            <img class="object-cover object-center w-full" src="uploads/<?= $photo['file_foto'] ?>" alt="foto">
          </div>
          <hr>
          <div class="p-5">
            <h3 class="text-2xl font-semibold text-sky-600"><?= $photo['judul'] ?></h3>
            <p class="mb-3 text-slate-500"><?= $photo['deskripsi'] ?></p>

          </div>
        </div>
      </div>
    <?php endforeach ?>

  </div>
</main>
<?php require "./components/footer.php" ?>