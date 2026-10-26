<?php

session_start();

require "config/koneksi.php";

//Menentukan bahasa yang digunakan
if (isset($_GET["bahasa"])) {

    if ($_GET["bahasa"] == "id" || $_GET["bahasa"] == "en") {
        $_SESSION["bahasa"] = $_GET["bahasa"];
    }
}

$bahasa = $_SESSION["bahasa"] ?? "id";

//Data teks dalam dua bahasa
$teks = [
    "id" => [
        "judul" => "Login Pustakawan",
        "subjudul" => "Sistem Manajemen Data Buku",
        "username" => "Username",
        "password" => "Password",
        "login" => "Masuk",
        "bahasa" => "Bahasa",
        "username_error" => "Username harus diisi.",
        "password_error" => "Password harus diisi.",
        "gagal" => "Username atau password salah."
    ],

    "en" => [
        "judul" => "Librarian Login",
        "subjudul" => "Book Data Management System",
        "username" => "Username",
        "password" => "Password",
        "login" => "Login",
        "bahasa" => "Language",
        "username_error" => "Username is required.",
        "password_error" => "Password is required.",
        "gagal" => "Incorrect username or password."
    ]
];

//Variabel untuk menampung pesan error
$error = [];

//Jika form dikirim
if (isset($_POST["login"])) {

    //Mengambil data dari form
    $username = trim($_POST["username"] ?? "");
    $password = trim($_POST["password"] ?? "");

    //Validasi username
    if (empty($username)) {
        $error[] = $teks[$bahasa]["username_error"];
    }

    //Validasi password
    if (empty($password)) {
        $error[] = $teks[$bahasa]["password_error"];
    }

    //Jika tidak ada error
    if (empty($error)) {

        //Mencari data user
        $stmt = $pdo->prepare(
            "SELECT * FROM users
             WHERE username = :username
             AND password = :password"
        );

        $stmt->execute([
            ":username" => $username,
            ":password" => $password
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        //Jika user ditemukan
        if ($user) {

            $_SESSION["login"] = true;
            $_SESSION["nama"] = $user["nama"];

            header("Location: index.php");
            exit;

        } else {

            $error[] = $teks[$bahasa]["gagal"];

        }
    }
}

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

<body class="login-page">

    <div class="login-wrapper">

        <!--Foto Cover-->
        <div class="cover-photo">

            <img
                src="images/header.png"
                alt="Foto Perpustakaan"
            >

        </div>


        <!--Card Login-->
        <div class="login-card">

            <div class="login-header">

                <h1>
                    <?= htmlspecialchars($teks[$bahasa]["judul"]) ?>
                </h1>

                <p>
                    <?= htmlspecialchars($teks[$bahasa]["subjudul"]) ?>
                </p>

            </div>


            <form method="POST">

                <!--Username-->
                <div class="form-group">

                    <label for="username">
                        <?= htmlspecialchars($teks[$bahasa]["username"]) ?>
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="<?= htmlspecialchars($_POST["username"] ?? "") ?>"
                        autocomplete="username"
                    >

                </div>


                <!--Password-->
                <div class="form-group">

                    <label for="password">
                        <?= htmlspecialchars($teks[$bahasa]["password"]) ?>
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        autocomplete="current-password"
                    >

                </div>


                <!--Tombol Login-->
                <button
                    type="submit"
                    name="login"
                    class="button-primary"
                >
                    <?= htmlspecialchars($teks[$bahasa]["login"]) ?>
                </button>

            </form>


            <!--Pesan Error-->
            <?php if (!empty($error)): ?>

                <div class="error-box">

                    <?php foreach ($error as $pesan): ?>

                        <div>
                            <?= htmlspecialchars($pesan) ?>
                        </div>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>


            <!--Pilihan Bahasa-->
            <div class="language-section">

                <span>
                    <?= htmlspecialchars($teks[$bahasa]["bahasa"]) ?>
                </span>

                <div class="language-buttons">

                    <a
                        href="login.php?bahasa=id"
                        class="<?= $bahasa == "id" ? "active" : "" ?>"
                    >
                        Indonesia
                    </a>

                    <a
                        href="login.php?bahasa=en"
                        class="<?= $bahasa == "en" ? "active" : "" ?>"
                    >
                        English
                    </a>

                </div>

            </div>

        </div>

    </div>

</body>

</html>