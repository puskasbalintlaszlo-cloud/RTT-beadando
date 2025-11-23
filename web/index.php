<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Tanulók</title>
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
        <h1>Tanulók</h1>
    <a>
        <form action="student_add.php" method="get" style="display:inline;">
            <button type="submit" class="btn">Tanuló Felvétele</button>
        </form>
    </a>
    </div>
        <table>
            <thead>
                <tr>
                    <th>Név</th>
                    <th>Évfolyam</th>
                    <th>Született</th>
                    <th>Aktív?</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $mysqli->query("SELECT * FROM students");
                while ($row = $result->fetch_assoc()) {
                    $name = htmlspecialchars($row['last_name'] . ' ' . $row['first_name']);
                    $year = (int)$row['year'];
                    $birth = $row['birth_date'] !== '0000-00-00'
                        ? date('Y.m.d', strtotime($row['birth_date']))
                        : '0000.00.00';
                    $active = $row['active'] ? 'Igen' : 'Nem';
                    echo "<tr>
                        <td>{$name}</td>
                        <td>{$year}</td>
                        <td>{$birth}</td>
                        <td>{$active}</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
