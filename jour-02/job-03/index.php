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

function insert_student($email, $fullname, $gender, $birthdate, $grade_id) : bool {
    $pdo = connect_to_database();
    $query = "INSERT INTO student (email, fullname, gender, birthdate, grade_id) VALUES (:email, :fullname, :gender, :birthdate, :grade_id)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindValue(':birthdate', $birthdate->format('Y-m-d'), PDO::PARAM_STR);
    $stmt->bindParam(':grade_id', $grade_id, PDO::PARAM_INT);
    return $stmt->execute();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['input-email'];
    $fullname = $_POST['input-fullname'];
    $gender = $_POST['input-gender'];
    $birthdate = new DateTime($_POST['input-birthdate']);
    $gradeId = (int)$_POST['input-grade_id'];

    $inserted = insert_student($email, $fullname, $gender, $birthdate, $gradeId);

    if ($inserted) {
        echo "Étudiant inséré avec succès !";
    } else {
        echo "Erreur lors de l'insertion de l'étudiant.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insertion d'un nouvel étudiant</title>
</head>
<body>
    <h1>Insertion d'un nouvel étudiant</h1>
    <form method="post" action="">
        <label for="input-email">E-mail :</label>
        <input type="email" name="input-email" required><br>

        <label for="input-fullname">Full Name :</label>
        <input type="text" name="input-fullname" required><br>

        <label for="input-gender">Gender :</label>
        <select name="input-gender" required>
            <option value="male">Homme</option>
            <option value="female">Femme</option>
            <option value="female">Autres</option>
        </select><br>

        <label for="input-birthdate">Birth Date :</label>
        <input type="date" name="input-birthdate" required><br>

        <label for="input-grade_id">Grade ID</label>
        <input type="number" name="input-grade_id" required><br>

        <input type="submit" value="Ajouter l'étudiant">
    </form>
</body>
</html>
