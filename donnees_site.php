<?php
// Configuration de la base de données
$servername = "localhost";
$username = "root"; // par défaut, l'utilisateur est "root" pour les serveurs locaux comme XAMPP/WAMP/MAMP
$password = ""; // par défaut, le mot de passe est vide pour les serveurs locaux
$dbname = "site_portfolio";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    // Préparer et exécuter la requête d'insertion
    $sql = "INSERT INTO contact_form (name, email, phone, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nom, $email, $telephone, $message);

    if ($stmt->execute()) {
        echo "<h1>Détails de la soumission du formulaire</h1>";
        echo "<div class='result'>";
        echo "<p><strong>Nom :</strong> " . $nom . "</p>";
        echo "<p><strong>E-mail :</strong> " . $email . "</p>";
        echo "<p><strong>Téléphone :</strong> " . $telephone . "</p>";
        echo "<p><strong>Message :</strong> " . $message . "</p>";
        echo "</div>";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }

    // Fermer la connexion
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats du formulaire</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #333;
        }
        .result {
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #fff;
        }
        .result p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
</body>
</html>
