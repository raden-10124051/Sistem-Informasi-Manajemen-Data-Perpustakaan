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
        "nama_aplikasi" => "Perpustakaan",
        "judul" => "Data Buku",
        "subjudul" => "Sistem Manajemen Data Buku",
        "data_buku" => "Data Buku",
        "tambah" => "Tambah Buku",
        "selamat" => "Selamat datang",
        "menu" => "Menu",
        "bahasa" => "Bahasa",
        "logout" => "Logout",
        "id" => "ID",
        "isbn" => "ISBN",
        "judul_buku" => "Judul",
        "penulis" => "Penulis",
        "penerbit" => "Penerbit",
        "tahun" => "Tahun Terbit",
        "kategori" => "Kategori",
        "bahasa_buku" => "Bahasa Buku",
        "sinopsis" => "Sinopsis",
        "format" => "Format",
        "lokasi" => "Lokasi Rak",
        "stok" => "Stok",
        "kondisi" => "Kondisi",
        "aksi" => "Aksi",
        "edit" => "Edit",
        "hapus" => "Hapus",
        "belum_ada" => "Belum ada data buku."
    ],

    "en" => [
        "nama_aplikasi" => "Library",
        "judul" => "Book Data",
        "subjudul" => "Book Data Management System",
        "data_buku" => "Book Data",
        "tambah" => "Add Book",
        "selamat" => "Welcome",
        "menu" => "Menu",
        "bahasa" => "Language",
        "logout" => "Logout",
        "id" => "ID",
        "isbn" => "ISBN",
        "judul_buku" => "Title",
        "penulis" => "Author",
        "penerbit" => "Publisher",
        "tahun" => "Publication Year",
        "kategori" => "Category",
        "bahasa_buku" => "Book Language",
        "sinopsis" => "Synopsis",
        "format" => "Format",
        "lokasi" => "Rack Location",
        "stok" => "Stock",
        "kondisi" => "Condition",
        "aksi" => "Action",
        "edit" => "Edit",
        "hapus" => "Delete",
        "belum_ada" => "No book data available."
    ]
];

//Mengambil data buku
$stmt = $pdo->query("SELECT * FROM buku ORDER BY id ASC");

$data_buku = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars($bahasa) ?>">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <link rel="stylesheet" href="style.css">

    <title>
        <?= htmlspecialchars($teks[$bahasa]["judul"]) ?>
    </title>

</head>

<body class="dashboard-page">

    <div class="dashboard-wrapper">

        <div class="dashboard-layout">

            <!--Sidebar-->
            <aside class="sidebar">

                <div class="sidebar-header">

                    <h2>
                        <?= htmlspecialchars($teks[$bahasa]["nama_aplikasi"]) ?>
                    </h2>

                    <p>
                        <?= htmlspecialchars($teks[$bahasa]["subjudul"]) ?>
                    </p>

                </div>

                <!--Menu-->
                <div class="sidebar-menu">

                    <div class="menu-title">
                        <?= htmlspecialchars($teks[$bahasa]["menu"]) ?>
                    </div>

                    <a
                        href="index.php"
                        class="sidebar-link active"
                    >
                        <span>
                            <?= htmlspecialchars($teks[$bahasa]["data_buku"]) ?>
                        </span>
                    </a>

                </div>

                <!--Bahasa-->
                <div class="sidebar-menu">

                    <div class="menu-title">
                        <?= htmlspecialchars($teks[$bahasa]["bahasa"]) ?>
                    </div>

                    <div class="sidebar-language">

                        <a
                            href="bahasa.php?bahasa=id"
                            class="<?= $bahasa == "id" ? "active" : "" ?>"
                        >
                            Indonesia
                        </a>

                        <a
                            href="bahasa.php?bahasa=en"
                            class="<?= $bahasa == "en" ? "active" : "" ?>"
                        >
                            English
                        </a>

                    </div>

                </div>

                <!--User dan Logout-->
                <div class="sidebar-menu sidebar-bottom">

                    <div class="menu-title">
                        <?= htmlspecialchars($_SESSION["nama"]) ?>
                    </div>

                    <a
                        href="logout.php"
                        class="sidebar-link logout-link"
                    >
                        <span>
                            <?= htmlspecialchars($teks[$bahasa]["logout"]) ?>
                        </span>
                    </a>

                </div>

            </aside>

            <!--Main Content-->
            <main class="main-content">

                <!--Welcome-->
                <div class="welcome-section">

                    <div>

                        <p class="welcome-label">
                            <?= htmlspecialchars($teks[$bahasa]["selamat"]) ?>
                        </p>

                        <h1>
                            <?= htmlspecialchars($_SESSION["nama"]) ?>
                        </h1>

                    </div>

                </div>

                <!--Data Buku-->
                <section class="data-card">

                    <div class="data-card-header">

                        <div>

                            <h2>
                                <?= htmlspecialchars($teks[$bahasa]["data_buku"]) ?>
                            </h2>

                            <p>
                                <?= htmlspecialchars($teks[$bahasa]["subjudul"]) ?>
                            </p>

                        </div>

                        <a
                            href="tambah.php"
                            class="button-add"
                        >
                            +
                            <?= htmlspecialchars($teks[$bahasa]["tambah"]) ?>
                        </a>

                    </div>

                    <!--Tabel-->
                    <div class="table-wrapper">

                        <table class="book-table">

                            <thead>

                                <tr>

                                    <th><?= htmlspecialchars($teks[$bahasa]["id"]) ?></th>
                                    <th><?= htmlspecialchars($teks[$bahasa]["isbn"]) ?></th>
                                    <th><?= htmlspecialchars($teks[$bahasa]["judul_buku"]) ?></th>
                                    <th><?= htmlspecialchars($teks[$bahasa]["penulis"]) ?></th>
                                    <th><?= htmlspecialchars($teks[$bahasa]["penerbit"]) ?></th>
                                    <th><?= htmlspecialchars($teks[$bahasa]["tahun"]) ?></th>
                                    <th><?= htmlspecialchars($teks[$bahasa]["kategori"]) ?></th>
                                    <th><?= htmlspecialchars($teks[$bahasa]["bahasa_buku"]) ?></th>
                                    <th><?= htmlspecialchars($teks[$bahasa]["sinopsis"]) ?></th>
                                    <th><?= htmlspecialchars($teks[$bahasa]["format"]) ?></th>
                                    <th><?= htmlspecialchars($teks[$bahasa]["lokasi"]) ?></th>
                                    <th><?= htmlspecialchars($teks[$bahasa]["stok"]) ?></th>
                                    <th><?= htmlspecialchars($teks[$bahasa]["kondisi"]) ?></th>
                                    <th><?= htmlspecialchars($teks[$bahasa]["aksi"]) ?></th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php if (!empty($data_buku)): ?>

                                    <?php foreach ($data_buku as $buku): ?>

                                        <tr>

                                            <td>
                                                <?= htmlspecialchars($buku["id"]) ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($buku["isbn"]) ?>
                                            </td>

                                            <td class="book-title">
                                                <?= htmlspecialchars($buku["judul"]) ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($buku["penulis"]) ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($buku["penerbit"]) ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($buku["tahun_terbit"]) ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($buku["kategori"]) ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($buku["bahasa_buku"]) ?>
                                            </td>

                                            <td class="synopsis-cell">

                                                <span
                                                    title="<?= htmlspecialchars($buku["sinopsis"]) ?>"
                                                >
                                                    <?= htmlspecialchars($buku["sinopsis"]) ?>
                                                </span>

                                            </td>

                                            <td>
                                                <?= htmlspecialchars($buku["format_buku"]) ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($buku["lokasi_rak"]) ?>
                                            </td>

                                            <td class="stock-cell">
                                                <?= htmlspecialchars($buku["stok"]) ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($buku["kondisi"]) ?>
                                            </td>

                                            <td>

                                                <div class="action-buttons">

                                                    <a
                                                        href="edit.php?id=<?= $buku["id"] ?>"
                                                        class="button-edit"
                                                    >
                                                        <?= htmlspecialchars($teks[$bahasa]["edit"]) ?>
                                                    </a>

                                                    <a
                                                        href="hapus.php?id=<?= $buku["id"] ?>"
                                                        class="button-delete"
                                                    >
                                                        <?= htmlspecialchars($teks[$bahasa]["hapus"]) ?>
                                                    </a>

                                                </div>

                                            </td>

                                        </tr>

                                    <?php endforeach; ?>

                                <?php else: ?>

                                    <tr>

                                        <td
                                            colspan="14"
                                            class="empty-data"
                                        >
                                            <?= htmlspecialchars($teks[$bahasa]["belum_ada"]) ?>
                                        </td>

                                    </tr>

                                <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                </section>

            </main>

        </div>

    </div>

</body>

</html>