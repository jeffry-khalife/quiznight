<?php
session_start();
include('bdd.php'); // base de donnée
include('admin.php'); // classe administrateur


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $requete = "SELECT * FROM administrateur WHERE nom_utilisateur = :nom_utilisateur";
    $sql = $db->prepare($requete);
    $sql->bindParam(':nom_utilisateur', $nom_utilisateur, PDO::PARAM_STR);
    $sql->execute();
    $admin = $sql->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        if (password_verify($mot_de_passe, $admin['mot_de_passe'])) {
            $_SESSION['user_id'] = $admin['id'];
            $_SESSION['username'] = $admin['nom_utilisateur'];

            header('Location: administrateur.php');
            exit();  
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Aucun utilisateur trouvé avec cet nom_utilisateur.";
    }
}
?>
<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Connexion</title>
    <link rel='stylesheet' href='style1.css'>
    <link rel='stylesheet' href='style2.css'>
</head>

<header>
        <nav>
            <ul class="hautdepage">
                <p class="titrejeu"></p>
                <li><a class="lien" href="index.php">QuizNight</a></li>
                <li><a class="lien" href="login.php">Connexion</a></li>
            </ul>
        </nav>
    </header>

<body>

</body>
    <div class="app">
        <div class="quiz">
            <h3>Connexion</h3>
            <form method="POST" action="login.php">
                <label for="nom_utilisateur"><p>Nom D'utilisateur :</p></label>
                <input type="nom_utilisateur" id="nom_utilisateur" name="nom_utilisateur" ><br><br>
    
                <label for="password"><p>Mot de passe : <p></label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" ><br><br>
    
                <button type="submit" id="valider">Connexion</button>
            </form>
        </div>
    </div>

    <footer>
        <div class="réseauxsociaux">
            <img class="réseaux" src="img/instagram.png" alt="photo logo instagram">
            <img class="réseaux" src="img/twitter.png" alt="photo logo twitter">
            <img class="réseaux" src="img/tik-tok.png" alt="photo logo tiktok">
        </div>
    </footer>
</html>