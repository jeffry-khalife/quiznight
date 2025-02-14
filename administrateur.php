<?php
    class QuizNight {
        private $pdo;

        public function __construct($host, $quiznight, $root){
            try {
                $this->pdo = new PDO("mysql:host=$host;dbname=$quiznight;charset=utf8", $root, '');
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

        public function ajouterQuiz($titre, $description, $date_creation) {
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

        public function getAllQuiz(){
            $sql = $this->pdo->query("SELECT * FROM quiz");
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getQuizById($id_quiz){
            $sql = $this->pdo->prepare("SELECT * FROM quiz WHERE id = :id");
            $sql->execute([':id' => $id_quiz]);
            return $sql->fetch(PDO::FETCH_ASSOC);
        }

        public function getQuestionsByQuiz($id_quiz){
            $sql = $this->pdo->prepare("SELECT * FROM question WHERE id_quiz = :id_quiz");
            $sql->execute([':id_quiz' => $id_quiz]);
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getreponseByQuestion($id_question){
            $sql = $this->pdo->prepare("SELECT * FROM reponse WHERE id_question = :id_question");
            $sql->execute([':id_question' => $id_question]);
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function deleteQuiz($id_quiz){
            $sql = $this->pdo->prepare("DELETE FROM quiz WHERE id = :id");
            $sql->execute([':id' => $id_quiz]);
        }

        public function deleteQuestion($id_question){
            $sql = $this->pdo->prepare("DELETE FROM question WHERE id = :id");
            $sql->execute([':id' => $id_question]);
        }

        public function deleteReponse($id_reponse){
            $sql = $this->pdo->prepare("DELETE FROM reponse WHERE id = :id");
            $sql->execute([':id' => $id_reponse]);
        }

        public function updateQuiz($id_quiz, $titre, $description, $date_creation){
            $sql = $this->pdo->prepare("UPDATE quiz SET titre = :titre, description = :description, date_creation = :date_creation WHERE id = :id");
            $sql->execute([
                ':id' => $id_quiz,
                ':titre' => $titre,
                ':description' => $description,
                ':date_creation' => $date_creation
            ]);
        }

        public function updateQuestion($id_question, $texte_question){
            $sql = $this->pdo->prepare("UPDATE question SET texte_question = :texte_question WHERE id = :id");
            $sql->execute([
                ':id' => $id_question,
                ':texte_question' => $texte_question
            ]);
        }

        public function updateReponse($id_reponse, $texte_reponse){
            $sql = $this->pdo->prepare("UPDATE reponse SET texte_reponse = :texte_reponse WHERE id = :id");
            $sql->execute([
                ':id' => $id_reponse,
                ':texte_reponse' => $texte_reponse
            ]);
        }
    }

    $database = new QuizNight("localhost", "quiznight", "root", "");
    $quizManager = new Quiz($database);

    //traitement du formulaire
    $message = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["ajouterQuizEtQuestion"])){
            $titre = $_POST["titre"];
            $description = $_POST["description"];
            $date_creation = $_POST["date_creation"];
            $texte_question = $_POST["texte_question"];

            if (!empty($titre) && !empty($description) && !empty($date_creation) && !empty($texte_question)){
                $id_quiz = $quizManager->ajouterQuiz($titre, $description, $date_creation);
                $quizManager->ajouterQuestion($id_quiz, $texte_question);
                $message = "Quiz et question ajoutés avec succès !";
            } else {
                $message = "Veuillez remplir tous les champs.";
            }
        } elseif (isset($_POST["modifierQuiz"])){
            $id_quiz = $_POST["id_quiz"];
            $titre = $_POST["titre"];
            $description = $_POST["description"];
            $date_creation = $_POST["date_creation"];

            if (!empty($titre) && !empty($description) && !empty($date_creation)){
                $quizManager->updateQuiz($id_quiz, $titre, $description, $date_creation);
                $message = "Quiz modifié avec succès !";
            } else {
                $message = "Veuillez remplir tous les champs.";
            }
        } elseif (isset($_POST["modifierQuestion"])){
            $id_question = $_POST["id_question"];
            $texte_question = $_POST["texte_question"];

            if (!empty($texte_question)){
                $quizManager->updateQuestion($id_question, $texte_question);
                $message = "Question modifiée avec succès !";
            } else {
                $message = "Veuillez remplir tous les champs.";
            }
        } elseif (isset($_POST["modifierReponse"])){
            $id_reponse = $_POST["id_reponse"];
            $texte_reponse = $_POST["texte_reponse"];

            if (!empty($texte_reponse)){
                $quizManager->updateReponse($id_reponse, $texte_reponse);
                $message = "Réponse modifiée avec succès !";
            } else {
                $message = "Veuillez remplir tous les champs.";
            }
        } elseif (isset($_POST['deleteQuiz']) && !empty($_POST['id_quiz'])) {
            $quizManager->deleteQuiz($_POST['id_quiz']);
            $message = "Quiz supprimé avec succès !";
        } elseif (isset($_POST['deleteQuestion']) && !empty($_POST['id_question'])) {
            $quizManager->deleteQuestion($_POST['id_question']);
            $message = "Question supprimée avec succès !";
        } elseif (isset($_POST['deleteReponse']) && !empty($_POST['id_reponse'])) {
            $quizManager->deleteReponse($_POST['id_reponse']);
            $message = "Réponse supprimée avec succès !";
        }
    }

    $quizzes = $quizManager->getAllQuiz();
    $selectedQuiz = null;
    $questions = [];
    $reponses = [];

    if (isset($_POST['selectQuiz']) && !empty($_POST['quiz_id'])) {
        $selectedQuiz = $quizManager->getQuizById($_POST['quiz_id']);
        $questions = $quizManager->getQuestionsByQuiz($_POST['quiz_id']);
    }
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
<div class="app">
    <div class="quiz">
        <h1 class="quizadmin">Gestion du Quiz</h1>
        <?php if (!empty($message)): ?>
            <p id="messageerreur"><?php echo $message; ?></p>
        <?php endif; ?>

        <h2>Ajouter un nouveau Quiz et une Question</h2>
        <form class="ajoutquiz" method="post">
            <label class="titrequiz" for="titre">Titre du Quiz:</label>
            <input class="titrequiz2" type="text" id="titre" name="titre" required><br><br>
            
            <label class="desques" for="description">Description:</label>
            <input type="text" id="description" name="description" class="description-input" required><br><br>
            
            <label class="desques" for="texte_question">Question:</label>
            <input type="text" id="texte_question" name="texte_question" class="question-input" required><br><br>

            <label class="desques" for="date_creation">Date de création:</label>
            <input class="datecréation" type="date" id="date_creation" name="date_creation" required><br>
            
            <button class="ajouter" type="submit" name="ajouterQuizEtQuestion">Ajouter Quiz et Question</button>
        </form>
    </div>

    <div class="quiz-liste">
        <h2 class="listequiz">Liste des Quiz</h2>
        <form class="ajoutquiz" method="post">
            <label class="selectionnerunquiz" for="quiz_id">Sélectionner un Quiz:</label>
            <select class="nomquiz" name="quiz_id" id="quiz_id">
                <?php foreach ($quizzes as $quiz) : ?>
                    <option value="<?= htmlspecialchars($quiz['id']); ?>"><?= htmlspecialchars($quiz['titre']); ?></option>
                <?php endforeach; ?>
            </select>
            <button class="afficher" type="submit" name="selectQuiz">Afficher</button>
        </form>

        <?php if ($selectedQuiz) : ?>
            <h3 class="infoquiz">Informations du Quiz</h3>
            <form class="ajoutquiz" method="post">
                <input type="hidden" name="id_quiz" value="<?= htmlspecialchars($selectedQuiz['id']); ?>">

                <label class="titrequiz" for="titre">Titre:</label>
                <input class="titrequiz2"type="text" id="titre" name="titre" value="<?= htmlspecialchars($selectedQuiz['titre']); ?>" required><br><br>
                
                <label class="desques" for="description">Description:</label>
                <input type="text" id="description" name="description"  class="description-input" value="<?= htmlspecialchars($selectedQuiz['description']); ?>" required><br><br>
                
                <label class="desques" for="date_creation">Date de création:</label>
                <input class="datecréation" type="date" id="date_creation" name="date_creation" value="<?= htmlspecialchars($selectedQuiz['date_creation']); ?>" required><br><br>
                
                <button class="modifier" type="submit" name="modifierQuiz">Modifier</button>
            </form>

            <h3 class="questions-réponses">Questions/Réponses</h3>
            <table>
                <thead class="q-a">
                    <tr>
                        <th class="q-a">Questions/Réponses</th>
                        <th class="q-a">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($questions as $question) : ?>
                        <tr>
                            <td class="q-a-quiz"><?= htmlspecialchars($question['texte_question']); ?></td>
                            <td class="fsfwd"><br>
                                <form method="post">
                                    <input type="hidden" name="id_question" value="<?= htmlspecialchars($question['id']); ?>">
                                    <button class="s-m" type="submit" name="deleteQuestion" onclick="return confirm('Supprimer cette question ?');">Supprimer</button>
                                    <button class="s-m" type="submit" name="selectQuestion" value="<?= htmlspecialchars($question['id']); ?>">Modifier</button>
                                </form>
                            </td>
                        </tr>
                        <?php if (isset($_POST['selectQuestion']) && $_POST['selectQuestion'] == $question['id']) : ?>
                            <tr>
                                <td colspan="2">
                                    <form class="ajoutquiz" method="post">
                                        <input type="hidden" name="id_question" value="<?= htmlspecialchars($question['id']); ?>">
                                        <label for="texte_question">Question:</label>
                                        <input type="text" id="texte_question" name="texte_question" value="<?= htmlspecialchars($question['texte_question']); ?>" required><br><br>
                                        <button class="s-m" type="submit" name="modifierQuestion">Modifier</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php 
                        $reponses = $quizManager->getreponseByQuestion($question['id']);
                        foreach ($reponses as $reponse) : ?>
                            <tr>
                                <td><?= htmlspecialchars($reponse['texte_reponse']); ?></td>
                                <td>
                                    <form method="post">
                                        <input type="hidden" name="id_reponse" value="<?= htmlspecialchars($reponse['id']); ?>">
                                        <button class="s-m" class="" type="submit" name="deleteReponse" onclick="return confirm('Supprimer cette réponse ?');">Supprimer</button>
                                        <button class="s-m" type="submit" name="selectReponse" value="<?= htmlspecialchars($reponse['id']); ?>">Modifier</button>
                                    </form>
                                </td>
                            </tr>
                            <?php if (isset($_POST['selectReponse']) && $_POST['selectReponse'] == $reponse['id']) : ?>
                                <tr>
                                    <td colspan="2">
                                        <form method="post">
                                            <input type="hidden" name="id_reponse" value="<?= htmlspecialchars($reponse['id']); ?>">
                                            <label for="texte_reponse">Réponse:</label>
                                            <input type="text" id="texte_reponse" name="texte_reponse" value="<?= htmlspecialchars($reponse['texte_reponse']); ?>" required><br><br>
                                            <button class="s-m" type="submit" name="modifierReponse">Modifier</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
</body>
</html>