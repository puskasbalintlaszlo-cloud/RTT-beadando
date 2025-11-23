<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Jegyek</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="index.php">Tanulók</a>
        <a href="subjects.php">Tárgyak</a>
        <a href="grades.php" class="active">Jegyek</a>
        <div class="user-info">
        Puskás Bálint László | AOENS2
        </div>
    </nav>
    <div class="container">
        <div class="topbar">
            <h1>Jegyek</h1>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Tanuló neve</th>
                    <th>Tantárgy</th>
                    <th>Jegy</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT CONCAT(s.last_name, ' ', s.first_name) AS student_name, 
                               t.name AS subject_name, 
                               g.grade
                        FROM grades g
                        JOIN students s ON g.student_id = s.id
                        JOIN subjects t ON g.subject_id = t.id
                        ORDER BY s.last_name, s.first_name, t.name";
                $result = $mysqli->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $student = htmlspecialchars($row['student_name']);
                    $subject = htmlspecialchars($row['subject_name']);
                    $grade = (int)$row['grade'];
                    echo "<tr>
                        <td>{$student}</td>
                        <td>{$subject}</td>
                        <td>{$grade}</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
