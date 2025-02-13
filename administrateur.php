<?php
    class QuizNight {
        private $pdo;

        public function __construct($host, $dbname, $user, $password){
            try {
                $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } 
            catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }

        public function getPdo(){
            return $this->pdo;
        }
    }

    class Quiz {
        private $pdo;

        public function __construct(QuizNight $database){
            $this->pdo = $database->getPdo();
        }

        public function ajouterQuiz($titre, $description, $date_creation){
            $requete = "INSERT INTO quiz (titre, description, date_creation) VALUES (:titre, :description, :date_creation)";
            $sql = $this->pdo->prepare($requete);
            $sql->execute([
                ':titre' => $titre,
                ':description' => $description,
                ':date_creation' => $date_creation
            ]);
            return $this->pdo->lastInsertId();
        }

        public function ajouterQuestion($id_quiz, $texte_question){
            $requete = "INSERT INTO question (id_quiz, texte_question) VALUES (:id_quiz, :texte_question)";
            $sql = $this->pdo->prepare($requete);
            $sql->execute([
                ':id_quiz' => $id_quiz,
                ':texte_question' => $texte_question
            ]);
        }
    }

    $database = new QuizNight("localhost", "quiznight", "root", "");
    $quizManager = new Quiz($database);

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page administrateur</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Tektur:wght@400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="administrateur.css">
</head>
<body>

<!--HAUT DE PAGE-->
    <header>
        <nav>
            <ul class="hautdepage">
                <p class="titrejeu">Quiznight</p>
                <li><a class="lien" href="index.php">Accueil</a></li>
                <li><a class="lien" href="">Connexion</a></li>
            </ul>
        </nav>
    </header>

<!--PAGE-->
    <h1 class="quizadmin">Gestion du Quiz</h1>

    <h5 class="quizadmin">Ajouter un Quiz</h5>
    <form method="post">
        <label for="titre">Titre:</label>
        <input type="text" id="titre" name="titre" required><br><br>
        
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required><br><br>
        
        <label for="date_creation">Date de création:</label>
        <input type="date" id="date_creation" name="date_creation" required><br><br>
        
        <h4>Ajouter une Question</h5>
        <label for="texte_question">Question:</label>
        <input type="text" id="texte_question" name="texte_question" required><br><br>
        
        <label for="texte_question">Question:</label>
        <input type="text" id="texte_question" name="texte_question" required><br><br>

        <label for="texte_question">Question:</label>
        <input type="text" id="texte_question" name="texte_question" required><br><br>
        
        <button type="submit" name="ajouterQuizEtQuestion">Ajouter</button><br><br>
        
        <?php
        //traitement du formulaire
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ajouterQuizEtQuestion"])){
                $titre = $_POST["titre"];
                $description = $_POST["description"];
                $date_creation = $_POST["date_creation"];
                $texte_question = $_POST["texte_question"];

                if (!empty($titre) && !empty($description) && !empty($date_creation) && !empty($texte_question)){
                    $id_quiz = $quizManager->ajouterQuiz($titre, $description, $date_creation);
                    $quizManager->ajouterQuestion($id_quiz, $texte_question);
                    echo "<p id='messageerreur'>Quiz et question ajoutés avec succès !</p>";
                } else {
                    echo "<p id='messageerreur'>Veuillez remplir tous les champs.</p>";
                }
            }
        ?>
    </form>



</body>
</html>

