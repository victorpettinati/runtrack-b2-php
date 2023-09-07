<?php

function connect_to_database() {
    $host = 'localhost'; 
    $dbname = 'Ip_official'; 
    $username = 'root'; 
    $password = 'Laplateforme.06!'; 

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}

function find_all_students() : array {
    $pdo = connect_to_database();
    $query = "SELECT * FROM student";
    $stmt = $pdo->query($query);
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $students;
}

$students = find_all_students();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
</head>
<body>
    <h1>Liste des étudiants</h1>
    <table border="1">
        <tr>
            <th>grade_ID</th>
            <th>Email</th>
            <th>FullName</th>
            <th>Birthdate</th>
            <th>gender</th>
        </tr>
        <?php foreach ($students as $student) : ?>
            <tr>
                <td><?php echo $student['grade_id']; ?></td>
                <td><?php echo $student['email']; ?></td>
                <td><?php echo $student['fullname']; ?></td>
                <td><?php echo $student['birthdate']; ?></td>
                <td><?php echo $student['gender']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
