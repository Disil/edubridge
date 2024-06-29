<?php
include('structure/check_conn.php');
include('database.php');
/** @var int $id_siswa */
/** @var mysqli $conn */
echo $id_siswa;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subjects = [
        'matematika', 'fisika', 'kimia', 'biologi', 'ekonomi', 'geografi', 'sosiologi',
        'bahasa_indonesia', 'bahasa_inggris', 'pjok', 'prakarya', 'sejarah', 'ppkn', 'seni_budaya'
    ];

    $values = [];
    foreach ($subjects as $subject) {
        $values[] = floatval($_POST[$subject]);
    }

    $sql = "INSERT INTO nilai_mentah (id_siswa, " . implode(", ", $subjects) . ") 
            VALUES (?, " . str_repeat("?,", count($subjects) - 1) . "?)
            ON DUPLICATE KEY UPDATE " .
        implode(" = ?, ", $subjects) . " = ?";

    $stmt = $conn->prepare($sql);
    $types = str_repeat("d", 2 * count($subjects) + 1);
    $params = array_merge([$types, $id_siswa], $values, $values);
    call_user_func_array([$stmt, 'bind_param'], $params);

    if ($stmt->execute()) {
        $message = "Grades submitted successfully!";
        header("Location: nilai_rapot.php");
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/classless.css">
    <link rel="stylesheet" href="css/tabbox.css">
    <link rel="stylesheet" href="css/themes.css">
    <title>Input Nilai Rapot</title>
</head>
<body>
<header><?php include "structure/header.php"?></header>
<h1>Input Nilai rapor pelajaran</h1>
<?php if (isset($message)): ?>
    <div class="message"><?php echo $message; ?></div>
<?php endif; ?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <fieldset>
        <?php
        $subjects = [
            'matematika', 'fisika', 'kimia', 'biologi', 'ekonomi', 'geografi', 'sosiologi',
            'bahasa_indonesia', 'bahasa_inggris', 'pjok', 'prakarya', 'sejarah', 'ppkn', 'seni_budaya'
        ];

        foreach ($subjects as $subject) {
            $display_subject = str_replace('_', ' ', $subject);
            echo "<label for='$subject'>$display_subject:</label>";
            echo "<input type='number' id='$subject' name='$subject' min='0' max='100' step='0.01' required><br>";
        }
        ?>
    </fieldset>
    <input type="submit" value="Submit Nilai">

</form>
</body>