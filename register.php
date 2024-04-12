<?php
session_start();

// Vos informations de connexion à la base de données
$servername = "10.170.10.19:33061";
$username = "clement";
$password = "goatesque";
$dbname = "bdd_drones";

try {
    // Connexion à la base de données
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération des données du formulaire
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Vérification si l'utilisateur existe déjà dans la base de données
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(["username" => $username]);
    $user = $stmt->fetch();

    if ($user) {
        echo "Cet utilisateur existe déjà. Veuillez choisir un autre nom d'utilisateur.";
    } else {
        // Insertion de l'utilisateur dans la base de données
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->execute(["username" => $username, "password" => $password]);
        // Affichage du message d'inscription réussie
        echo "<script>alert('Inscription réussie !');</script>";
        // Redirection vers la page de connexion
        header("Location: login.html");
        exit(); // Assure que le script s'arrête ici pour éviter toute exécution supplémentaire
    }
} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

// Fermeture de la connexion
$conn = null;
?>