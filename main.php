<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        p {
            color: #333;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .logout-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }

    </style>
    <title>Games of Drones</title>
</head>
<body>

    <form action="login.html" method="post">
        <?php
        session_destroy();
        ?>
        <input type="submit" value="Déconnexion" class="logout-btn">
    </form>

    <div class="container">
        <p>Données de la flotte de drones :</p>

        <table>
            <tr>
                <th>Drone ID</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Altitude</th>
                <th>Timestamp</th>
                <th>Battery</th>
            </tr>

            <?php
                $servername = "10.170.10.19:33061";
                $username = "clement";
                $password = "goatesque";
                $dbname = "bdd_drones";

                session_start();
                $login=$_POST["login"];
                $password_session=$_POST["password"];

                if($login=="toto" && $password_session=="michel"){
                    $_SESSION["login"]=$login;
                    echo "Bienvenue $login ";
                

                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $conn->prepare("SELECT * FROM Drones");
                    $stmt->execute();
                    $result = $stmt->fetchAll();

                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['drone_id'] . "</td>";
                        echo "<td>" . $row['latitude'] . "</td>";
                        echo "<td>" . $row['longitude'] . "</td>";
                        echo "<td>" . $row['altitude'] . "</td>";
                        echo "<td>" . $row['timestamp'] . "</td>";
                        echo "<td>" . $row['battery'] . "</td>";
                        echo "</tr>";
                    }

                } catch(PDOException $e) {
                    echo "Erreur de connexion : " . $e->getMessage();
                }
            }else{
                echo "Erreur de connexion, mauvais identifiant ou mot de passe. Veuillez réessayer.";
            }

                // Ferme la connexion
                $conn = null;
            ?>
        </table>
    </div>

</body>
</html>






















<!-- <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        p {
            color: #333;
            font-size: 18px;
            margin-bottom: 10px;
        }
    </style>
    <title>Games of Drones</title>
</head>
<body>

    <form action="login.html" method="post">
        <?php
        session_destroy();
        ?>
        <input type="submit" value="Déconnexion">
    </form>

    <div class="container">
        <p>Données de la flotte de drones :</p>

        <table>
            <tr>
                <th>Drone ID</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Altitude</th>
                <th>Timestamp</th>
                <th>Battery</th>
            </tr>

            <?php
                $servername = "10.170.10.19:33061";
                $username = "clement";
                $password = "goatesque";
                $dbname = "bdd_drones";

                session_start();
                $login=$_POST["login"];
                $password_session=$_POST["password"];

                if($login=="toto" && $password_session=="michel"){
                    $_SESSION["login"]=$login;
                    echo "Bienvenue $login ";
                

                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $conn->prepare("SELECT * FROM Drones");
                    $stmt->execute();
                    $result = $stmt->fetchAll();

                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['drone_id'] . "</td>";
                        echo "<td>" . $row['latitude'] . "</td>";
                        echo "<td>" . $row['longitude'] . "</td>";
                        echo "<td>" . $row['altitude'] . "</td>";
                        echo "<td>" . $row['timestamp'] . "</td>";
                        echo "<td>" . $row['battery'] . "</td>";
                        echo "</tr>";
                    }

                } catch(PDOException $e) {
                    echo "Erreur de connexion : " . $e->getMessage();
                }
            }else{
                echo "Erreur de connexion, mauvais identifiant ou mot de passe. Veuillez réessayer.";
            }

                // Ferme la connexion
                $conn = null;
            ?>
        </table>
    </div>

</body>
</html>

-->