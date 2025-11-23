<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Tárgyak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <style>
    </style>
</head>
<body>
    <nav>
        <a href="index.php">Tanulók</a>
        <a href="subjects.php" class="active">Tárgyak</a>
        <a href="grades.php">Jegyek</a>
        <div class="user-info">
            Puskás Bálint László | AOENS2
        </div>
    </nav>
    <div class="container">
        <h1>Tárgyak</h1>
        
        <div class="filter-bar">
            <div class="filter-form-wrapper">
                <form method="get" action="subjects.php">
                    <label for="year_filter">Évfolyam:</label>
                    <input type="number" min="1" max="4" id="year_filter" name="year" value="<?php echo isset($_GET['year']) ? htmlspecialchars($_GET['year']) : '' ?>">
                    <button type="submit" class="btn">Szűrés</button>
                </form>
            </div>
        </div>

        <?php
        $error = "";
        $year_filter = null;
        if (isset($_GET['year']) && $_GET['year'] !== "") {
            if (!is_numeric($_GET['year']) || $_GET['year'] < 1 || $_GET['year'] > 14) {
                $error = "Nincs ilyen osztály!";
            } else {
                $year_filter = (int)$_GET['year'];
            }
        }
        if ($error) {
            echo "<div class='error-msg'>$error</div>";
        }
        ?>
        <table>
            <thead>
                <tr>
                    <th>Tárgy neve</th>
                    <th>Évfolyam</th>
                    <th>Tanulók száma</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Csak az adott évfolyamot listázzuk, ha szűrnek
                if ($year_filter) {
                    $stmt = $mysqli->prepare("SELECT s.*, 
                        (SELECT COUNT(*) FROM grades g 
                            JOIN students st ON g.student_id = st.id 
                            WHERE g.subject_id = s.id AND st.active=1 AND st.year = s.year
                        ) AS student_count 
                        FROM subjects s WHERE s.year = ?");
                    $stmt->bind_param("i", $year_filter);
                    $stmt->execute();
                    $result = $stmt->get_result();
                } else {
                    $result = $mysqli->query("SELECT s.*, 
                        (SELECT COUNT(*) FROM grades g 
                            JOIN students st ON g.student_id = st.id 
                            WHERE g.subject_id = s.id AND st.active=1 AND st.year = s.year
                        ) AS student_count 
                        FROM subjects s");
                }

                while ($row = $result->fetch_assoc()) {
                    $name = htmlspecialchars($row['name']);
                    $year = (int)$row['year'];
                    $count = (int)$row['student_count'];
                    echo "<tr>
                            <td>$name</td>
                            <td>$year</td>
                            <td>$count</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
