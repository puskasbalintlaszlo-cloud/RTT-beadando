<?php
include 'db.php';
$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $mysqli->real_escape_string($_POST['first_name']);
    $last_name = $mysqli->real_escape_string($_POST['last_name']);
    $year = (int)$_POST['year'];
    $birth_date = $mysqli->real_escape_string($_POST['birth_date']);
    $active = isset($_POST['active']) ? 1 : 0;
    if ($first_name && $last_name && $year && $birth_date) {
        $mysqli->query("INSERT INTO students (first_name, last_name, year, birth_date, active) VALUES ('$first_name', '$last_name', $year, '$birth_date', $active)");
        header("Location: index.php");
        exit;
    } else {
        $error = "Minden mező kitöltése kötelező!";
    }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Tanuló felvétele</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="index.php" class="active">Tanulók</a>
        <a href="subjects.php">Tárgyak</a>
        <a href="grades.php">Jegyek</a>
        <div class="user-info">
            Puskás Bálint László | AOENS2
        </div>
    </nav>
    <div class="container">
        <div class="topbar">
            <h1>Tanuló felvétele</h1>
        </div>
        <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="post">
            <label>Vezetéknév:
                <input type="text" name="last_name" required>
            </label>
            <label>Keresztnév:
                <input type="text" name="first_name" required>
            </label>
            <label>Évfolyam:
                <input type="number" name="year" min="1" max="4" required>
            </label>
            <label>Születési dátum:
                <input type="date" name="birth_date" required>
            </label>
            <label>
                <input type="checkbox" name="active" checked>
                Aktív
            </label>
            <br>
            <input type="submit" value="Felvétel" class="btn">
        </form>
    </div>
</body>
</html>
