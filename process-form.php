<?php
// Assurez-vous que vous avez une connexion à votre base de données.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "isned";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    // Ajoutez des contrôles de saisie pour vérifier les champs requis.
   if (empty($name) || empty($email) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Affichez une alerte JavaScript en cas d'erreur.
    echo '<script>alert("Please fill in all fields correctly.");</script>';

    // Redirigez l'utilisateur vers index.php avec l'ancre #contact-section.
    echo '<script>window.location.href = "index.php#contact-section";</script>';
    exit; // Assurez-vous de quitter le script après la redirection.
} else {
    // Insérez les données du formulaire dans la table des messages.
    $sql = "INSERT INTO messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Affichez une alerte JavaScript en cas de succès.
        echo '<script>alert("Message sent successfully!");</script>';
    } else {
        // Affichez une alerte JavaScript en cas d'erreur.
        echo '<script>alert("Error sending message : ' . $conn->error . '");</script>';
    }

    // Redirigez l'utilisateur vers index.php avec l'ancre #contact-section en utilisant JavaScript.
    echo '<script>window.location.href = "index.php#contact-section";</script>';
    exit; // Assurez-vous de quitter le script après la redirection.
}

    
}
