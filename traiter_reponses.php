<?php
include 'bdd.php';
include 'Quiz.php';
include 'Question.php';
include 'Reponse.php';

$id_quiz = $_POST['id_quiz'] ?? null; 

if (!$id_quiz) {
    echo "ID du quiz manquant.";
    exit;
}

$query = "SELECT * FROM quiz WHERE id = :id_quiz";
$stmt = $db->prepare($query);
$stmt->bindParam(':id_quiz', $id_quiz);
$stmt->execute();
$quizData = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$quizData) {
    echo "Aucun quiz trouvé avec cet ID.";
    exit;
}

$quiz = new Quiz($quizData['id'], $quizData['titre']);

$score = 0;

echo "<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Résultats du Quiz - " . $quiz->getTitle() . "</title>
    <link rel='stylesheet' href='style1.css'>
    <link rel='stylesheet' href='style2.css'>
        <link href='https://fonts.googleapis.com/css2?family=Audiowide&family=Tektur:wght@400..900&display=swap' rel='stylesheet'>

</head>

<header>
        <nav>
            <ul class='hautdepage'>
                <p class='titrejeu'></p>
                <li><a class='lien' href='index.php'>Quiznight</a></li>
                <li><a class='lien' href='login.php'>Connexion</a></li>
            </ul>
        </nav>
    </header>
<body>

<div class='app'>
    <h1>" . $quiz->getTitle() . "</h1>";

$questions = $quiz->getQuestions($db);
foreach ($questions as $question) {
    echo "<div class='quiz'>";
    echo "<h2>" . $question->getQuestionText() . "</h2>";

    $reponses = $question->getReponses($db);
    $user_reponse_id = $_POST['reponse_' . $question->getId()] ?? null;

    if (!$user_reponse_id) {
        echo "<p>Erreur : aucune réponse sélectionnée pour cette question.</p>";
        continue; 
    }

    $correct_answer = null;
    $user_answer = null;

    foreach ($reponses as $reponse) {
        if ($reponse->getEstCorrecte() == 1) {
            $correct_answer = $reponse;  
        }

        if ($reponse->getId() == $user_reponse_id) {
            $user_answer = $reponse;
        }
    }

    if (!$correct_answer) {
        echo "<p>Erreur : pas de bonne réponse trouvée pour cette question.</p>";
        continue;
    }

    foreach ($reponses as $reponse) {
        $class = '';
        if ($reponse->getId() == $user_answer->getId()) {
            if ($reponse->getEstCorrecte() == 1) {
                $class = 'correct-answer'; 
                $score++;  
            } else {
                $class = 'wrong-answer'; 
            }
        }

        echo "<div class='btn1 $class'>";
        echo "<input type='radio' disabled " . ($user_reponse_id == $reponse->getId() ? "checked" : "") . ">";
        echo "<label>" . $reponse->getReponseText() . "</label>";
        echo "</div>";
    }

    if ($user_reponse_id != $correct_answer->getId()) {
        echo "<p><strong>Bonne réponse :</strong> " . $correct_answer->getReponseText() . "</p>";
    }

    echo "</div>";
}

echo "<div class='score'>";
echo "<h2>Vous avez obtenu " . $score . " bonnes réponses sur " . count($questions) . " !</h2>";
echo "</div>";

echo "<a href='quizz.php?id_quiz=" . $id_quiz . "' id='next-btn'>Rejouer</a>";
echo "<a href='index.php"  . "' id='next-btn'>Autres Quiz</a>";
echo "</div></body></html>";
?>
