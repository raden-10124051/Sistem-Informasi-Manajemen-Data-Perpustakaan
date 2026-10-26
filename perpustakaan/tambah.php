<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require "config/koneksi.php";

//Menentukan bahasa
$bahasa = $_SESSION["bahasa"] ?? "id";

//Data teks
$teks = [
    "id" => [
        "judul" => "Tambah Data Buku",
        "subjudul" => "Masukkan informasi buku ke dalam sistem.",
        "isbn" => "ISBN",
        "judul_buku" => "Judul Buku",
        "penulis" => "Penulis",
        "penerbit" => "Penerbit",
        "tahun" => "Tahun Terbit",
        "kategori" => "Kategori",
        "bahasa_buku" => "Bahasa Buku",
        "sinopsis" => "Sinopsis",
        "format" => "Format Buku",
        "lokasi" => "Lokasi Rak",
        "stok" => "Stok",
        "kondisi" => "Kondisi Buku",
        "simpan" => "Simpan Data",
        "kembali" => "Kembali",
        "pilih" => "Pilih",
        "indonesia" => "Indonesia",
        "english" => "English",
        "cetak" => "Cetak",
        "digital" => "Digital",
        "audiobook" => "Audiobook",
        "isbn_error" => "ISBN harus diisi.",
        "isbn_unik" => "ISBN sudah digunakan.",
        "judul_error" => "Judul buku harus diisi.",
        "penulis_error" => "Penulis harus diisi.",
        "penerbit_error" => "Penerbit harus diisi.",
        "tahun_error" => "Tahun terbit harus diisi.",
        "tahun_invalid" => "Tahun terbit harus berupa angka 4 digit.",
        "kategori_error" => "Kategori harus dipilih.",
        "bahasa_error" => "Minimal satu bahasa buku harus dipilih.",
        "sinopsis_error" => "Sinopsis harus diisi.",
        "format_error" => "Format buku harus dipilih.",
        "lokasi_error" => "Lokasi rak harus dipilih.",
        "stok_error" => "Stok harus diisi.",
        "stok_invalid" => "Stok harus berupa angka dan tidak boleh kurang dari 0.",
        "kondisi_error" => "Kondisi buku harus dipilih.",
        "database_error" => "Data gagal disimpan ke database."
    ],

    "en" => [
        "judul" => "Add Book Data",
        "subjudul" => "Enter book information into the system.",
        "isbn" => "ISBN",
        "judul_buku" => "Book Title",
        "penulis" => "Author",
        "penerbit" => "Publisher",
        "tahun" => "Publication Year",
        "kategori" => "Category",
        "bahasa_buku" => "Book Language",
        "sinopsis" => "Synopsis",
        "format" => "Book Format",
        "lokasi" => "Rack Location",
        "stok" => "Stock",
        "kondisi" => "Book Condition",
        "simpan" => "Save Data",
        "kembali" => "Back",
        "pilih" => "Select",
        "indonesia" => "Indonesia",
        "english" => "English",
        "cetak" => "Print",
        "digital" => "Digital",
        "audiobook" => "Audiobook",
        "isbn_error" => "ISBN is required.",
        "isbn_unik" => "ISBN is already registered.",
        "judul_error" => "Book title is required.",
        "penulis_error" => "Author is required.",
        "penerbit_error" => "Publisher is required.",
        "tahun_error" => "Publication year is required.",
        "tahun_invalid" => "Publication year must be a 4-digit number.",
        "kategori_error" => "Category must be selected.",
        "bahasa_error" => "At least one book language must be selected.",
        "sinopsis_error" => "Synopsis is required.",
        "format_error" => "Book format must be selected.",
        "lokasi_error" => "Rack location is required.",
        "stok_error" => "Stock is required.",
        "stok_invalid" => "Stock must be a number and cannot be negative.",
        "kondisi_error" => "Book condition must be selected.",
        "database_error" => "Failed to save data to the database."
    ]
];

//Variabel untuk menampung pesan
$pesan = "";
$error = [];

//Data pilihan yang diperbolehkan
$kategori_valid = [
    "Novel",
    "Komik/Manga",
    "Pendidikan",
    "Teknologi",
    "Sejarah",
    "Sains",
    "Biografi",
    "Referensi",
    "Agama",
    "Umum"
];

$bahasa_valid = [
    "Indonesia",
    "English"
];

$format_valid = [
    "Cetak",
    "Digital",
    "Audiobook"
];

$lokasi_valid = [
    "A-01",
    "A-02",
    "A-03",
    "A-04",
    "A-05",
    "B-01",
    "B-02",
    "B-03",
    "B-04",
    "B-05",
    "C-01",
    "C-02",
    "C-03",
    "C-04",
    "C-05"
];

$kondisi_valid = [
    "Baru",
    "Sangat Baik",
    "Baik",
    "Cukup Baik",
    "Rusak Ringan",
    "Rusak"
];

//Jika form dikirim
if (isset($_POST["simpan"])) {

    //Mengambil data dari form
    $isbn = trim($_POST["isbn"] ?? "");
    $judul = trim($_POST["judul"] ?? "");
    $penulis = trim($_POST["penulis"] ?? "");
    $penerbit = trim($_POST["penerbit"] ?? "");
    $tahun_terbit = trim($_POST["tahun_terbit"] ?? "");
    $kategori = trim($_POST["kategori"] ?? "");
    $bahasa_pilihan = $_POST["bahasa_buku"] ?? [];
    $sinopsis = trim($_POST["sinopsis"] ?? "");
    $format_buku = $_POST["format_buku"] ?? "";
    $lokasi_rak = trim($_POST["lokasi_rak"] ?? "");
    $stok = trim($_POST["stok"] ?? "");
    $kondisi = trim($_POST["kondisi"] ?? "");

    //Validasi ISBN
    if (empty($isbn)) {
        $error[] = $teks[$bahasa]["isbn_error"];
    }

    //Validasi judul
    if (empty($judul)) {
        $error[] = $teks[$bahasa]["judul_error"];
    }

    //Validasi penulis
    if (empty($penulis)) {
        $error[] = $teks[$bahasa]["penulis_error"];
    }

    //Validasi penerbit
    if (empty($penerbit)) {
        $error[] = $teks[$bahasa]["penerbit_error"];
    }

    //Validasi tahun terbit
    if (empty($tahun_terbit)) {
        $error[] = $teks[$bahasa]["tahun_error"];
    } else {

        $tahun_valid = filter_var(
            $tahun_terbit,
            FILTER_VALIDATE_INT
        );

        if (
            $tahun_valid === false ||
            strlen($tahun_terbit) != 4
        ) {
            $error[] = $teks[$bahasa]["tahun_invalid"];
        }
    }

    //Validasi kategori
    if (
        empty($kategori) ||
        !in_array($kategori, $kategori_valid)
    ) {
        $error[] = $teks[$bahasa]["kategori_error"];
    }

    //Validasi bahasa buku
    if (!is_array($bahasa_pilihan)) {
        $bahasa_pilihan = [];
    }

    $bahasa_pilihan = array_intersect(
        $bahasa_pilihan,
        $bahasa_valid
    );

    if (empty($bahasa_pilihan)) {
        $error[] = $teks[$bahasa]["bahasa_error"];
    }

    //Validasi sinopsis
    if (empty($sinopsis)) {
        $error[] = $teks[$bahasa]["sinopsis_error"];
    }

    //Validasi format buku
    if (
        empty($format_buku) ||
        !in_array($format_buku, $format_valid)
    ) {
        $error[] = $teks[$bahasa]["format_error"];
    }

    //Validasi lokasi rak
    if (
        empty($lokasi_rak) ||
        !in_array($lokasi_rak, $lokasi_valid)
    ) {
        $error[] = $teks[$bahasa]["lokasi_error"];
    }

    //Validasi stok
    if (empty($stok) && $stok !== "0") {
        $error[] = $teks[$bahasa]["stok_error"];
    } else {

        $stok_valid = filter_var(
            $stok,
            FILTER_VALIDATE_INT
        );

        if (
            $stok_valid === false ||
            $stok_valid < 0
        ) {
            $error[] = $teks[$bahasa]["stok_invalid"];
        }
    }

    //Validasi kondisi
    if (
        empty($kondisi) ||
        !in_array($kondisi, $kondisi_valid)
    ) {
        $error[] = $teks[$bahasa]["kondisi_error"];
    }

    //Jika tidak ada error
    if (empty($error)) {

        //Menggabungkan pilihan bahasa
        $bahasa_buku = implode(", ", $bahasa_pilihan);

        try {

            //Mengecek ISBN yang sudah digunakan
            $cek_isbn = $pdo->prepare(
                "SELECT id FROM buku WHERE isbn = :isbn"
            );

            $cek_isbn->execute([
                ":isbn" => $isbn
            ]);

            if ($cek_isbn->fetch()) {

                $error[] = $teks[$bahasa]["isbn_unik"];

            } else {

                //Menyimpan data ke database
                $stmt = $pdo->prepare(
                    "INSERT INTO buku
                    (
                        isbn,
                        judul,
                        penulis,
                        penerbit,
                        tahun_terbit,
                        kategori,
                        bahasa_buku,
                        sinopsis,
                        format_buku,
                        lokasi_rak,
                        stok,
                        kondisi
                    )
                    VALUES
                    (
                        :isbn,
                        :judul,
                        :penulis,
                        :penerbit,
                        :tahun_terbit,
                        :kategori,
                        :bahasa_buku,
                        :sinopsis,
                        :format_buku,
                        :lokasi_rak,
                        :stok,
                        :kondisi
                    )"
                );

                $stmt->execute([
                    ":isbn" => $isbn,
                    ":judul" => $judul,
                    ":penulis" => $penulis,
                    ":penerbit" => $penerbit,
                    ":tahun_terbit" => $tahun_valid,
                    ":kategori" => $kategori,
                    ":bahasa_buku" => $bahasa_buku,
                    ":sinopsis" => $sinopsis,
                    ":format_buku" => $format_buku,
                    ":lokasi_rak" => $lokasi_rak,
                    ":stok" => $stok_valid,
                    ":kondisi" => $kondisi
                ]);

                //Setelah berhasil disimpan
                header("Location: index.php");
                exit;
            }

        } catch (PDOException $e) {

            //Menampilkan pesan error umum
            $error[] = $teks[$bahasa]["database_error"];

        }
    }
}

?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars($bahasa) ?>">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">

    <title><?= htmlspecialchars($teks[$bahasa]["judul"]) ?></title>

</head>

<body class="form-page">

    <div class="form-wrapper">

        <div class="form-card">

            <!--Header-->
            <div class="form-card-header">

                <h1>
                    <?= htmlspecialchars($teks[$bahasa]["judul"]) ?>
                </h1>

                <p>
                    <?= htmlspecialchars($teks[$bahasa]["subjudul"]) ?>
                </p>

            </div>

            <!--Form-->
            <div class="form-card-body">

                <form method="POST">

                    <div class="form-grid">

                        <!--ISBN-->
                        <div class="form-field">

                            <label for="isbn">
                                <?= htmlspecialchars($teks[$bahasa]["isbn"]) ?>
                            </label>

                            <input
                                type="text"
                                id="isbn"
                                name="isbn"
                                value="<?= htmlspecialchars($_POST["isbn"] ?? "") ?>"
                            >

                        </div>

                        <!--Judul-->
                        <div class="form-field">

                            <label for="judul">
                                <?= htmlspecialchars($teks[$bahasa]["judul_buku"]) ?>
                            </label>

                            <input
                                type="text"
                                id="judul"
                                name="judul"
                                value="<?= htmlspecialchars($_POST["judul"] ?? "") ?>"
                            >

                        </div>

                        <!--Penulis-->
                        <div class="form-field">

                            <label for="penulis">
                                <?= htmlspecialchars($teks[$bahasa]["penulis"]) ?>
                            </label>

                            <input
                                type="text"
                                id="penulis"
                                name="penulis"
                                value="<?= htmlspecialchars($_POST["penulis"] ?? "") ?>"
                            >

                        </div>

                        <!--Penerbit-->
                        <div class="form-field">

                            <label for="penerbit">
                                <?= htmlspecialchars($teks[$bahasa]["penerbit"]) ?>
                            </label>

                            <input
                                type="text"
                                id="penerbit"
                                name="penerbit"
                                value="<?= htmlspecialchars($_POST["penerbit"] ?? "") ?>"
                            >

                        </div>

                        <!--Tahun Terbit-->
                        <div class="form-field">

                            <label for="tahun_terbit">
                                <?= htmlspecialchars($teks[$bahasa]["tahun"]) ?>
                            </label>

                            <input
                                type="number"
                                id="tahun_terbit"
                                name="tahun_terbit"
                                value="<?= htmlspecialchars($_POST["tahun_terbit"] ?? "") ?>"
                            >

                        </div>

                        <!--Kategori-->
                        <div class="form-field">

                            <label for="kategori">
                                <?= htmlspecialchars($teks[$bahasa]["kategori"]) ?>
                            </label>

                            <select
                                id="kategori"
                                name="kategori"
                            >

                                <option value="">
                                    <?= htmlspecialchars($teks[$bahasa]["pilih"]) ?>
                                </option>

                                <?php foreach ($kategori_valid as $pilihan_kategori): ?>

                                    <option
                                        value="<?= htmlspecialchars($pilihan_kategori) ?>"
                                        <?= (($_POST["kategori"] ?? "") == $pilihan_kategori) ? "selected" : "" ?>
                                    >
                                        <?= htmlspecialchars($pilihan_kategori) ?>
                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <!--Bahasa Buku-->
                        <div class="form-field form-grid-full">

                            <label>
                                <?= htmlspecialchars($teks[$bahasa]["bahasa_buku"]) ?>
                            </label>

                            <div class="option-group">

                                <label class="option-item">

                                    <input
                                        type="checkbox"
                                        name="bahasa_buku[]"
                                        value="Indonesia"
                                        <?= (
                                            isset($_POST["bahasa_buku"]) &&
                                            is_array($_POST["bahasa_buku"]) &&
                                            in_array("Indonesia", $_POST["bahasa_buku"])
                                        ) ? "checked" : "" ?>
                                    >

                                    <?= htmlspecialchars($teks[$bahasa]["indonesia"]) ?>

                                </label>

                                <label class="option-item">

                                    <input
                                        type="checkbox"
                                        name="bahasa_buku[]"
                                        value="English"
                                        <?= (
                                            isset($_POST["bahasa_buku"]) &&
                                            is_array($_POST["bahasa_buku"]) &&
                                            in_array("English", $_POST["bahasa_buku"])
                                        ) ? "checked" : "" ?>
                                    >

                                    <?= htmlspecialchars($teks[$bahasa]["english"]) ?>

                                </label>

                            </div>

                        </div>

                        <!--Sinopsis-->
                        <div class="form-field form-grid-full">

                            <label for="sinopsis">
                                <?= htmlspecialchars($teks[$bahasa]["sinopsis"]) ?>
                            </label>

                            <textarea
                                id="sinopsis"
                                name="sinopsis"
                            ><?= htmlspecialchars($_POST["sinopsis"] ?? "") ?></textarea>

                        </div>

                        <!--Format Buku-->
                        <div class="form-field">

                            <label>
                                <?= htmlspecialchars($teks[$bahasa]["format"]) ?>
                            </label>

                            <div class="option-group">

                                <label class="option-item">

                                    <input
                                        type="radio"
                                        name="format_buku"
                                        value="Cetak"
                                        <?= (($_POST["format_buku"] ?? "") == "Cetak") ? "checked" : "" ?>
                                    >

                                    <?= htmlspecialchars($teks[$bahasa]["cetak"]) ?>

                                </label>

                                <label class="option-item">

                                    <input
                                        type="radio"
                                        name="format_buku"
                                        value="Digital"
                                        <?= (($_POST["format_buku"] ?? "") == "Digital") ? "checked" : "" ?>
                                    >

                                    <?= htmlspecialchars($teks[$bahasa]["digital"]) ?>

                                </label>

                                <label class="option-item">

                                    <input
                                        type="radio"
                                        name="format_buku"
                                        value="Audiobook"
                                        <?= (($_POST["format_buku"] ?? "") == "Audiobook") ? "checked" : "" ?>
                                    >

                                    <?= htmlspecialchars($teks[$bahasa]["audiobook"]) ?>

                                </label>

                            </div>

                        </div>

                        <!--Lokasi Rak-->
                        <div class="form-field">

                            <label for="lokasi_rak">
                                <?= htmlspecialchars($teks[$bahasa]["lokasi"]) ?>
                            </label>

                            <select
                                id="lokasi_rak"
                                name="lokasi_rak"
                            >

                                <option value="">
                                    <?= htmlspecialchars($teks[$bahasa]["pilih"]) ?>
                                </option>

                                <?php foreach ($lokasi_valid as $pilihan_lokasi): ?>

                                    <option
                                        value="<?= htmlspecialchars($pilihan_lokasi) ?>"
                                        <?= (($_POST["lokasi_rak"] ?? "") == $pilihan_lokasi) ? "selected" : "" ?>
                                    >
                                        <?= htmlspecialchars($pilihan_lokasi) ?>
                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <!--Stok-->
                        <div class="form-field">

                            <label for="stok">
                                <?= htmlspecialchars($teks[$bahasa]["stok"]) ?>
                            </label>

                            <input
                                type="number"
                                id="stok"
                                name="stok"
                                min="0"
                                value="<?= htmlspecialchars($_POST["stok"] ?? "") ?>"
                            >

                        </div>

                        <!--Kondisi-->
                        <div class="form-field">

                            <label for="kondisi">
                                <?= htmlspecialchars($teks[$bahasa]["kondisi"]) ?>
                            </label>

                            <select
                                id="kondisi"
                                name="kondisi"
                            >

                                <option value="">
                                    <?= htmlspecialchars($teks[$bahasa]["pilih"]) ?>
                                </option>

                                <?php foreach ($kondisi_valid as $pilihan_kondisi): ?>

                                    <option
                                        value="<?= htmlspecialchars($pilihan_kondisi) ?>"
                                        <?= (($_POST["kondisi"] ?? "") == $pilihan_kondisi) ? "selected" : "" ?>
                                    >
                                        <?= htmlspecialchars($pilihan_kondisi) ?>
                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                    </div>

                    <!--Tombol-->
                    <div class="form-actions">

                        <a
                            href="index.php"
                            class="button-back"
                        >
                            <?= htmlspecialchars($teks[$bahasa]["kembali"]) ?>
                        </a>

                        <button
                            type="submit"
                            name="simpan"
                            class="button-save"
                        >
                            <?= htmlspecialchars($teks[$bahasa]["simpan"]) ?>
                        </button>

                    </div>

                    <!--Pesan error-->
                    <?php if (!empty($error)): ?>

                        <div class="error-box">

                            <div class="error-title">
                                <?= $bahasa == "id"
                                    ? "Periksa kembali data berikut:"
                                    : "Please check the following:"
                                ?>
                            </div>

                            <ul>

                                <?php foreach ($error as $pesan_error): ?>

                                    <li>
                                        <?= htmlspecialchars($pesan_error) ?>
                                    </li>

                                <?php endforeach; ?>

                            </ul>

                        </div>

                    <?php endif; ?>

                </form>

            </div>

        </div>

    </div>

</body>

</html>