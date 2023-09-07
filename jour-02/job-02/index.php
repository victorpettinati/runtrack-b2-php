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

function find_one_student($email) : array {
    $pdo = connect_to_database();
    $query = "SELECT * FROM student WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    return $student;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['input-email-student'])) {
        $email = $_GET['input-email-student'];
        $student = find_one_student($email);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recherche d'étudiant par e-mail</title>
</head>
<body>
    <h1>Recherche d'étudiant par e-mail</h1>
    <form method="get" action="">
        <label for="input-email-student">Entrez l'e-mail de l'étudiant :</label>
        <input type="text" name="input-email-student" id="input-email-student">
        <input type="submit" value="Rechercher">
    </form>

    <?php if (isset($student)) : ?>
        <?php if ($student) : ?>
            <h2>Informations de l'étudiant :</h2>
            <ul>
                <li>grade_id : <?php echo $student['grade_id']; ?></li>
                <li>FullName : <?php echo $student['fullname']; ?></li>
                <li>E-mail : <?php echo $student['email']; ?></li>
                <li>Birthdate : <?php echo $student['birthdate']; ?></li>
                <li>Gender : <?php echo $student['gender']; ?></li>
            </ul>
        <?php else : ?>
            <p>Aucun étudiant trouvé avec cet e-mail.</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
