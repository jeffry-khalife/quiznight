<?php
    class QuizNight {
        private $pdo;

        public function __construct($host, $dbname, $username, $password){
            try {
                $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
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

        public function getAllQuiz(){
            $sql = $this->pdo->query("SELECT * FROM quiz");
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getQuestionsByQuiz($id_quiz){
            $sql = $this->pdo->prepare("SELECT * FROM question WHERE id_quiz = :id_quiz");
            $sql->execute([':id_quiz' => $id_quiz]);
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getReponsesByQuiz($id_quiz){
            $sql = $this->pdo->prepare("SELECT r.* FROM reponse r 
                                        INNER JOIN question q ON r.id_question = q.id 
                                        WHERE q.id_quiz = :id_quiz");
            $sql->execute([':id_quiz' => $id_quiz]);
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function updateReponse($id_reponse, $texte_reponse){
            $sql = $this->pdo->prepare("UPDATE reponse SET texte_reponse = :texte_reponse WHERE id = :id");
            $sql->execute([
                ':id' => $id_reponse,
                ':texte_reponse' => $texte_reponse
            ]);
        }

        public function deleteReponse($id_reponse){
            $sql = $this->pdo->prepare("DELETE FROM reponse WHERE id = :id");
            $sql->execute([':id' => $id_reponse]);
        }
    }

    $database = new QuizNight("localhost", "quiznight", "root", "");
    $quizManager = new Quiz($database);

    // Traitement des actions
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["modifierReponse"])){
            $id_reponse = $_POST["id_reponse"];
            $texte_reponse = $_POST["texte_reponse"];
            if (!empty($texte_reponse)){
                $quizManager->updateReponse($id_reponse, $texte_reponse);
            }
        }

        if (isset($_POST["deleteReponse"])){
            $id_reponse = $_POST["id_reponse"];
            if (!empty($id_reponse)){
                $quizManager->deleteReponse($id_reponse);
            }
        }
    }

    // Récupération des quiz
    $quizzes = $quizManager->getAllQuiz();
    $selectedQuiz = null;
    $questions = [];
    $reponses = [];

    if (isset($_POST['selectQuiz']) && !empty($_POST['quiz_id'])) {
        $selectedQuiz = $_POST['quiz_id'];
        $questions = $quizManager->getQuestionsByQuiz($selectedQuiz);
        $reponses = $quizManager->getReponsesByQuiz($selectedQuiz);
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page administrateur</title>
    <link rel="stylesheet" href="administrateur.css">
</head>
<body>

<header>
    <nav>
        <ul class="hautdepage">
            <p class="titrejeu">Quiznight</p>
            <li><a class="lien" href="index.php">Accueil</a></li>
            <li><a class="lien" href="">Connexion</a></li>
        </ul>
    </nav>
</header>

<div class="app">
    <div class="quiz">
        <h1 class="quizadmin">Gestion du Quiz</h1>

        <form method="post">
            <label for="quiz_id">Sélectionner un Quiz:</label>
            <select name="quiz_id" id="quiz_id">
                <?php foreach ($quizzes as $quiz) : ?>
                    <option value="<?= htmlspecialchars($quiz['id']); ?>"><?= htmlspecialchars($quiz['titre']); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" name="selectQuiz">Afficher</button>
        </form>
    </div>

    <?php if ($selectedQuiz) : ?>
        <h3>Questions</h3>
        <table>
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($questions as $question) : ?>
                    <tr>
                        <td><?= htmlspecialchars($question['texte_question']); ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id_question" value="<?= htmlspecialchars($question['id']); ?>">
                                <button type="submit" name="deleteQuestion">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Réponses</h3>
        <table>
            <thead>
                <tr>
                    <th>Réponse</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($reponses)) : ?>
                    <?php foreach ($reponses as $reponse) : ?>
                        <tr>
                            <td><?= htmlspecialchars($reponse['texte_reponse']); ?></td>
                            <td>
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="id_reponse" value="<?= htmlspecialchars($reponse['id']); ?>">
                                    <button type="submit" name="deleteReponse" onclick="return confirm('Supprimer cette réponse ?');">Supprimer</button>
                                </form>
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="id_reponse" value="<?= htmlspecialchars($reponse['id']); ?>">
                                    <button type="submit" name="selectReponse">Modifier</button>
                                </form>
                            </td>
                        </tr>

                        <?php if (isset($_POST['selectReponse']) && $_POST['id_reponse'] == $reponse['id']) : ?>
                            <tr>
                                <td colspan="2">
                                    <form method="post">
                                        <input type="hidden" name="id_reponse" value="<?= htmlspecialchars($reponse['id']); ?>">
                                        <label for="texte_reponse">Réponse:</label>
                                        <input type="text" id="texte_reponse" name="texte_reponse" value="<?= htmlspecialchars($reponse['texte_reponse']); ?>" required><br><br>
                                        <button type="submit" name="modifierReponse">Modifier</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endif; ?>

                    <?php endforeach; ?>
                <?php else : ?>
                    <tr><td colspan="2"><em>Aucune réponse trouvée.</em></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
