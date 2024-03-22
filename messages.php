<?php
session_start();

// Vérification de l'authentification
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Destruction de la session si logout est demandé
if(isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

// Connexion à la base de données
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "isned";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupération de tous les messages depuis la base de données
$sql = "SELECT * FROM messages";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Messages</title>
    <style>
        /* Styles pour le tableau */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Styles pour le bouton logout */
        .logout-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>All Messages</h2>
        <a href="?logout=1" class="logout-btn">Logout</a>
        <?php
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Name</th><th>Email</th><th>Subject</th><th>Message</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["subject"] . "</td>";
                echo "<td>" . $row["message"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No Messages</p>";
        }
        ?>
    </div>
</b
