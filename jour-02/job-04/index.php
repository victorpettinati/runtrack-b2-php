<?php
function find_all_students_grades(): array {
    // Informations de connexion à la base de données
    $host = 'localhost';
    $dbname = 'Ip_official';
    $username = 'root';
    $password = 'Laplateforme.06!';

    try {
        // Connexion à la base de données
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        // Préparation de la requête pour récupérer les données des étudiants avec leurs promotions
        $stmt = $pdo->prepare("SELECT student.email, student.fullname, grade.name AS grade_name
                               FROM student
                               INNER JOIN grade ON student.grade_id = grade.id");

        // Exécution de la requête
        $stmt->execute();

        // Récupération des résultats sous forme de tableau associatif
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Fermeture de la connexion
        $pdo = null;

        return $results;
    } catch (PDOException $e) {
        // En cas d'erreur, retournez une tableau vide avec un message d'erreur
        return [
            'error' => true,
            'message' => 'Une erreur s\'est produite lors de la récupération des données : ' . $e->getMessage(),
        ];
    }
}

// Appel de la fonction pour récupérer les données des étudiants
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
