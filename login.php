<?php
session_start();

// Vos informations de connexion à la base de données
$servername = "10.170.10.19:33061";
$username = "clement";
$password = "goatesque";
$dbname = "bdd_drones";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $login = $_POST["login"];
    $password = $_POST["password"];

    try {
        // Connexion à la base de données
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérification des identifiants dans la table 'users'
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $stmt->execute(["username" => $login, "password" => $password]);
        $user = $stmt->fetch();

        if ($user) {
            $_SESSION["login"] = $login; // Authentification réussie, création de la session
            header("Location: main.php"); // Redirection vers la page principale après la connexion
            exit();
        } else {
            // Identifiants invalides
            echo "Identifiant ou mot de passe incorrect. Veuillez réessayer.";
        }
    } catch(PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }

    // Fermeture de la connexion
    $conn = null;
}
?>