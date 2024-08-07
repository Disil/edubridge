<?php
if (isset($_GET['logged_out'])) {
    echo '<div id="message" class="message success floating-message">Kamu telah keluar dari akun</div>';
    echo '<script>
    setTimeout(function() {
        document.getElementById("message").style.display = "none";
    }, 3000) </script>';
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/classless.css">
    <link rel="stylesheet" href="css/tabbox.css">
    <link rel="stylesheet" href="css/themes.css">
    <title>EduBridge - landing page</title>
</head>
<body>
<header>
    <?php include 'structure/navbar_no_account.php'; ?>
</header>
<main>
    <h1>EduBridge - Situs Pemilihan Jurusan Perguruan Tinggi</h1>
    <div class="row">
        <div class="col">
            <p>EduBridge adalah situs yang dirancang untuk membantu kamu dalam menentukan pilihan jurusan di perguruan tinggi. Caranya adalah dengan memasukkan nilai rapot serta melakukan tes minat bakat yang berbentuk tes RIASEC.</p>
            <p>Setelah itu, kamu akan mendapatkan rekomendasi jurusan yang sesuai dengan nilai rapot dan tes minat bakat yang kamu kerjakan.</p>
            <p>Jika kamu belum pernah memakai EduBridge sebelumnya, silahkan buat akun terlebih dahulu.</p>
            <button onclick="window.location.href='register.php';">Buat Akun Baru</button><br>
            <button onclick="window.location.href='login.php';">Login Akun</button>
        </div>
        <div class="col">
            <figure><img alt = "illustration pc" src="img/orange-web-design-on-laptop-with-color-wheel.png"></figure>
        </div>
    </div>
</main>
<footer><?php include 'structure/footer.php'; ?></footer>
</body>
</html>