<?php


require "./koneksi.php";
if (!isset($_SESSION['user'])) {
    header('Location: ./login.php');
    exit;
}

require "./koneksi.php";
$user_id = $_SESSION['user_id'];
$album_id = $_GET['album_id'];
$sql = "SELECT * FROM albums WHERE album_id = $album_id";
$query = mysqli_fetch_assoc(mysqli_query($conn, $sql));


?>


<?php require "./components/header.php" ?>
<?php require "./components/navbar.php" ?>
<main class="flex flex-col justify-between min-h-screen p-10">
    <form action="./proses-edit-album.php" method="post" class="flex flex-col">
        <input type="hidden" name="user_id" value="<?= $query['user_id'] ?>">
        <input type="hidden" name="album_id" value="<?= $album_id ?>">
        <h1 class="my-20 text-4xl font-bold text-center text-sky-600">Edit Album</h1>
        <div class="flex flex-col  text-center">
            <label class="mb-2" for="nama-album">
                <span class="text-lg font-semibold text-sky-600">Nama Album : <?= $query['nama_album'] ?></span>
            </label>
            <input value="<?= $query["nama_album"] ?>" class="px-3 py-2 mx-auto duration-200 border-2 rounded-lg outline-none w-60 text-slate-500 border-slate-400 focus:border-2 focus:border-sky-600 focus:text-sky-600 placeholder:text-slate-400" placeholder="masukan judul" type="text" name="nama_album" id="nama_album   ">
        </div>
        <div class="flex flex-col  text-center">
            <label class="mt-6 mb-2" for="nama-album">
                <span class="text-lg font-semibold text-sky-600">Pertemuan : <?= $query["pertemuan_ke"] ?></span>
            </label>
            <select class="px-3 py-2 mx-auto duration-200 border-2 rounded-lg outline-none w-60 text-slate-500 border-slate-400 focus:border-2 focus:border-sky-600 focus:text-sky-600 placeholder:text-slate-400" name="pertemuan_ke" id="pertemuan_ke">
                <option value="<?= $query["pertemuan_ke"] ?>">Pertemuan <?= $query["pertemuan_ke"] ?></option>
                <hr>
                <option value="1">Pertemuan 1</option>
                <option value="2">Pertemuan 2</option>
                <option value="3">Pertemuan 3</option>
                <option value="4">Pertemuan 4</option>
            </select>
        </div>
        <button class="px-6 py-2 mx-auto mt-5 text-white duration-200 rounded-lg w-60 bg-sky-600 hover:bg-sky-800 active:bg-sky-800" name="submit" type="submit">Simpan</button>
    </form>
</main>
x
<?php require "./components/footer.php" ?>