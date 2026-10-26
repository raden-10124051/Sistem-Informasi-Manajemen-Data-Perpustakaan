<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require "config/koneksi.php";

//Mengambil ID buku
$id = filter_input(
    INPUT_GET,
    "id",
    FILTER_VALIDATE_INT
);

//Jika ID tidak valid
if ($id === false || $id === null || $id <= 0) {
    header("Location: index.php");
    exit;
}

try {

    //Mengecek apakah data buku tersedia
    $cek = $pdo->prepare(
        "SELECT id FROM buku WHERE id = :id"
    );

    $cek->execute([
        ":id" => $id
    ]);

    $buku = $cek->fetch(PDO::FETCH_ASSOC);

    //Jika data tidak ditemukan
    if (!$buku) {
        header("Location: index.php");
        exit;
    }

    //Menghapus data buku
    $stmt = $pdo->prepare(
        "DELETE FROM buku WHERE id = :id"
    );

    $stmt->execute([
        ":id" => $id
    ]);

    //Kembali ke halaman data buku
    header("Location: index.php");
    exit;

} catch (PDOException $e) {

    //Jika terjadi kesalahan database
    header("Location: index.php");
    exit;

}

?>