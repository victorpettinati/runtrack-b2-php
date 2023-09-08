<?php
$servername = "localhost";
$username = "root";
$password = "Laplateforme.06!";
$dbname = "Ip_official";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion rÃ©ussie";
} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
function find_full_rooms($conn){
    $sql = "SELECT r.id, r.floor_id, r.name AS room_name, r.capacity, g.name AS grade_name,
                   (SELECT COUNT(*) FROM student AS s
                    WHERE s.grade_id = g.id) AS student_count
            FROM room AS r
            LEFT JOIN grade AS g ON r.id = g.room_id";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




$result = find_full_rooms($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<table border=1>
    <tr>
        <th>ID</th>
        <th>Floor</th>
        <th>Name</th>
        <th>Capacity</th>
        <th>Grade</th>
        <th>Full</th>
    </tr>
    <?php foreach ($result as $row) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['floor_id']; ?></td>
            <td><?php echo $row['room_name']; ?></td>
            <td><?php echo $row['capacity']; ?></td>
            <td><?php echo $row['grade_name']; ?></td>
            <td><?php echo ($row['student_count'] >= $row['capacity']) ? 'Oui' : 'Non'; ?></td>

        </tr>
    <?php } ?>
</table>
    </body>