<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat de l'Inscription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .result-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 20px; /* Ajout de la marge entre le texte et le bouton */
        }
        .result-message {
            color: #333;
            font-size: 18px;
            margin-bottom: 20px;
        }
        .login-btn {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .login-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="result-container">
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
            echo "<div class='result-message'>Inscription réussie !</div>";
        }
    } catch(PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }

    // Fermeture de la connexion
    $conn = null;
    ?>
    <a href="login.html" class="login-btn">Se connecter</a> <!-- Bouton déplacé sous le message -->
</div>

</body>
</html>