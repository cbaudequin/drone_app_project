<?php
$servername = "10.170.10.19:33061";
$username = "clement";
$password = "goatesque";
$dbname = "bdd_drones";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];
    $altitude = $_POST["altitude"];
    $timestamp = date("Y-m-d H:i:s");
    $battery = $_POST["battery"];

    $stmt = $conn->prepare("INSERT INTO bdd_drones.Drones (latitude, longitude, altitude, timestamp, battery) VALUES (:latitude, :longitude, :altitude, :timestamp, :battery)");
    $stmt->execute(["latitude" => $latitude, "longitude" => $longitude, "altitude" => $altitude, "timestamp" => $timestamp, "battery" => $battery]);

} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

// Ferme la connexion
$conn = null;
?>
