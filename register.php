<?php
include "./connexion.php";

$nouveau_nom_utilisateur = $nouveau_mot_de_passe = "";
$erreur = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nouveau_nom_utilisateur = $_POST["nouveau_nom_utilisateur"];
    $nouveau_mot_de_passe = $_POST["nouveau_mot_de_passe"];

    // Vérification si le nom d'utilisateur existe déjà
    $sql_verifier_utilisateur = "SELECT * FROM Utilsateur WHERE nom = ?";
    $stmt = $con->prepare($sql_verifier_utilisateur);
    $stmt->bind_param("s", $nouveau_nom_utilisateur);
    $stmt->execute();
    $resultat_verifier = $stmt->get_result();

    if ($resultat_verifier->num_rows > 0) {
        $erreur = "Le nom d'utilisateur existe déjà.";
    } else {
        // Hashage du mot de passe
        $mot_de_passe_hache = password_hash($nouveau_mot_de_passe, PASSWORD_DEFAULT);

        // Insertion des données dans la base de données
        $sql_inserer_utilisateur = "INSERT INTO Utilsateur (nom, password) VALUES (?, ?)";
        $stmt = $con->prepare($sql_inserer_utilisateur);
        $stmt->bind_param("ss", $nouveau_nom_utilisateur, $mot_de_passe_hache);
        
        if ($stmt->execute()) {
            header("Location: ./index.php");
            exit();
        } else {
            $erreur = "Erreur lors de l'inscription : " . $con->error;
        }
    }
}

$con->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url("theos_innovation.jpg");
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

       

        .container {
            background-color: rgba(255, 255, 255, 0.3);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
            width: 380px;
            max-width: 400px;
            margin-top: 230px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
        }

        input {
            padding: 8px;
            margin-bottom: 16px;
            background-color: #000;
        }

        button {
            padding: 10px;
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #000;
        }

        .inscription-section {
            color: yellow;
            text-align: center;
            margin-top: 20px;
        }

        .inscription-section a {
            color: yellow;
            text-decoration: none;
            font-weight: bold;
        }

        .inscription-section a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Inscription</h2>
        <label for="nouveau_nom_utilisateur">Nom d'utilisateur :</label>
        <input type="text" id="nouveau_nom_utilisateur" name="nouveau_nom_utilisateur" required>

        <label for="nouveau_mot_de_passe">Mot de passe :</label>
        <input type="password" id="nouveau_mot_de_passe" name="nouveau_mot_de_passe" required>

        <button type="submit">S'inscrire</button>
    </form>

    <?php
    if ($erreur !== "") {
        echo "<p style='color: red;'>Erreur : $erreur</p>";
    }
    ?>

    <div class="inscription-section">
        <p>Vous avez déjà un compte ? <a href="./index.php">Connectez-vous ici</a>.</p>
    </div>
</div>

</body>
</html>
