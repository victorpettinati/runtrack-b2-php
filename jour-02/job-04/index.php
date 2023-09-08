<?php
function find_all_students_grades(): array {
    $host = 'localhost';
    $dbname = 'Ip_official';
    $username = 'root';
    $password = 'Laplateforme.06!';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        $stmt = $pdo->prepare("SELECT student.email, student.fullname, grade.name AS grade_name
                               FROM student
                               INNER JOIN grade ON student.grade_id = grade.id");

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;

        return $results;
    } catch (PDOException $e) {
        return [
            'error' => true,
            'message' => 'Une erreur s\'est produite lors de la récupération des données : ' . $e->getMessage(),
        ];
    }
}

$students = find_all_students_grades();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants avec leurs promotions</title>
</head>
<body>
    <h1>Liste des étudiants avec leurs promotions</h1>
    <?php if (isset($students['error'])): ?>
        <p>Erreur : <?= $students['message']; ?></p>
    <?php else: ?>
        <table border="1">
            <tr>
                <th>Email</th>
                <th>Nom complet</th>
                <th>Promotion</th>
            </tr>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= $student['email']; ?></td>
                    <td><?= $student['fullname']; ?></td>
                    <td><?= $student['grade_name']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
