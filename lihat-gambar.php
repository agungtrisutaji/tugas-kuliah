<?php
if (isset($_GET['album_id'])) {

    require "./koneksi.php";
    $album_id = $_GET['album_id'];
    $queryAlbum = "SELECT * FROM albums WHERE album_id = $album_id";
    $dataAlbum = mysqli_fetch_assoc(mysqli_query($conn, $queryAlbum));
    $sql = "SELECT * FROM photos WHERE album_id = $album_id ORDER BY photos_id DESC";
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
    <a href="./index.php"><i class="fa fa-chevron-left" aria-hidden="true"></i> Kembali</a>
</div>
<main class=" min-h-screen py-5">


    <div class="flex flex-col justify-center mt-10 mb-20 md:px-20">
        <div x-data="{ showModal: false}">
            <!-- Button to open the modal -->
            <button @click="showModal = true" class=" px-4 py-2 text-sm text-white font-medium text-white bg-blue-500 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500"> Tambah Gambar </button>
            <!-- Background overlay -->
            <div x-show="showModal" class="fixed inset-0 transition-opacity" aria-hidden="true" @click="showModal = false">
                <div class="absolute inset-0 bg-gray-500 opacity-75">
                </div>
            </div>
            <!-- Modal -->
            <div x-show="showModal" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="fixed z-10 inset-0 overflow-y-auto" x-cloak>
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <!-- Modal panel -->
                    <div class="w-full inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">

                            <div class="sm:flex sm:items-start">

                                <form action="proses-tambah-gambar.php" method="post" class="sticky flex flex-col w-full gap-5 top-10 Z-40" enctype="multipart/form-data">
                                    <input type="hidden" name="gambar_lama" value="<?= $photo['file_foto']; ?>">
                                    <h2 class="text-xl font-bold text-center text-sky-600">Tambah Gambar</h2>

                                    <!-- judul -->
                                    <label class="flex flex-col" for="judul">
                                        <span class="font-semibold text-md text-sky-600">Judul:</span>
                                        <input class="px-3 py-2 duration-200 border-2 rounded-lg outline-none text-slate-500 border-slate-400 focus:border-2 focus:border-sky-600 focus:text-sky-600 placeholder:text-slate-400" placeholder="masukan judul" type="text" name="judul" id="judul" required>
                                    </label>

                                    <!-- Deskripsi -->
                                    <label class="flex flex-col" for="deskripsi">
                                        <span class="font-semibold text-md text-sky-600">Deskripsi:</span>
                                        <textarea class="px-3 py-2 duration-200 border-2 rounded-lg outline-none text-slate-500 border-slate-400 focus:border-2 focus:border-sky-600 focus:text-sky-600 placeholder:text-slate-400" placeholder="masukan deskripsi" name="deskripsi" id="deskripsi" required></textarea>
                                    </label>

                                    <label class="flex flex-col" for="file-gambar">
                                        <span class="font-semibold text-md text-sky-600">Gambar :</span>

                                        <input class="px-3 py-2 duration-200 border-2 rounded-lg outline-none text-slate-500 border-slate-400 focus:border-2 focus:border-sky-600 focus:text-sky-600 placeholder:text-slate-400" type="file" name="file-gambar" id="file-gambar" required>
                                    </label>
                                    <div>
                                        <span class="font-semibold text-sky-600">Posting sebagai:</span>
                                        <label class="flex gap-3 cursor-pointer" for="public">
                                            <input type="radio" name="visibility" id="public" value="public" required>
                                            <span class="text-slate-500">Public</span>
                                        </label>
                                        <label class="flex gap-3 cursor-pointer" for="private">
                                            <input type="radio" name="visibility" id="private" value="private" required>
                                            <span class="text-slate-500">private</span>
                                        </label>
                                        <input type="hidden" name="album_id" value='<?= $album_id ?>'>
                                    </div>
                                    <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">

                                        <button @click="subscribeToNewsletter" name="submit" type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"> Sunmit </button>

                                        <button @click="showModal = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"> Cancel </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h1 class="text-2xl font-bold text-center text-sky-600">Isi dari Album <?= $dataAlbum['nama_album'] ?> </h1>

        <div class="flex flex-wrap justify-center mt-10 mb-20 md:px-20">
            <?php foreach ($photos as $photo) : ?>
                <div class="p-4 max-w-sm mt-5">
                    <div class="w-full shadow-md bg-clip-border rounded-xl">
                        <div class="relative h-56 mx-4 -mt-6 overflow-hidden text-white shadow-lg bg-clip-border rounded-xl bg-blue-gray-500 shadow-blue-gray-500/40">
                            <img class="object-cover object-center w-full" src="uploads/<?= $photo['file_foto'] ?>" alt="foto">
                        </div>
                        <hr>
                        <div class="p-5">
                            <h3 class="text-2xl font-semibold text-sky-600"><?= $photo['judul'] ?></h3>
                            <p class="mb-3 text-slate-500"><?= $photo['deskripsi'] ?></p>
                            <div class="flex flex-row justify-between">
                                <?php
                                if ($photo['visibility'] == 'public') {
                                ?>
                                    <div class="w-20 px-2 font-semibold py-1 text-center text-sm rounded-lg text-slate-200 bg-cyan-500"><?= $photo['visibility'] ?></div>
                                <?php } else { ?>
                                    <div class="w-20 px-2 font-semibold py-1 text-center text-sm rounded-lg text-slate-200 bg-teal-500"><?= $photo['visibility'] ?></div>
                                <?php } ?>

                                <div class="flex flex-row items-center justify-center gap-3">
                                    <a class="flex items-center justify-center px-2 py-1 text-sm text-white duration-200 bg-yellow-600 rounded-full hover:bg-yellow-800" href="edit-photo.php?photo_id=<?= $photo['photos_id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>

                                    <a onclick="return confirm('Data anda akan dihapus, Yakin ?')" class="flex items-center justify-center  py-1 text-sm px-2 text-white duration-200 bg-red-600 rounded-full hover:bg-red-800" href="hapus-photo.php?photo_id=<?= $photo['photos_id'] ?>"><i class="fa fa-trash" aria-hidden="true"></i>Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</main>
<?php require "./components/footer.php" ?>