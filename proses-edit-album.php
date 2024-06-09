<?php
if (isset($_POST['submit'])) {
    require "./koneksi.php";

    $album_id = $_POST['album_id'];
    $nama_album_baru = htmlspecialchars($_POST['nama_album']);
    $pertemuan_ke = htmlspecialchars($_POST['pertemuan_ke']);

    $sql = "UPDATE albums SET nama_album = '$nama_album_baru', pertemuan_ke = '$pertemuan_ke' WHERE album_id = $album_id";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "<script>alert('Album berhasil diubah');window.location.href='index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Data gagal diubah');window.location.href='index.php';</script>";
        return false;
    }
}
