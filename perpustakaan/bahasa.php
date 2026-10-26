<?php

session_start();

$bahasa = $_GET["bahasa"] ?? "id";

if ($bahasa != "id" && $bahasa != "en") {
    $bahasa = "id";
}

$_SESSION["bahasa"] = $bahasa;

//Kembali ke halaman data buku
header("Location: index.php");
exit;

?>