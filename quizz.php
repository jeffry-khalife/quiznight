<?php
include 'bdd.php';
include 'Quiz.php';
include 'question.php';
include 'Reponse.php';

$id_quiz = $_GET['id_quiz'];

$query = "SELECT * FROM quiz WHERE id = :id_quiz";
$stmt = $db->prepare($query);
$stmt->bindParam(':id_quiz', $id_quiz);
$stmt->execute();
$quizData = $stmt->fetch(PDO::FETCH_ASSOC);

$quiz = new Quiz($quizData['id'], $quizData['titre']);

echo "<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Quiz - " . $quiz->getTitle() . "</title>
    <link rel='stylesheet' href='style.css'>
</head>
<body>

<div class='app'>
    <h1>" . $quiz->getTitle() . "</h1>";

$questions = $quiz->getQuestions($db);
echo "<form method='POST' action='traiter_reponses.php'>";
foreach ($questions as $question) {
    echo "<div class='quiz'>";
    echo "<h2>" . $question->getQuestionText() . "</h2>";

    $reponses = $question->getReponses($db);
    foreach ($reponses as $reponse) {
        echo "<div class='btn1'>";
        echo "<input type='radio' id='reponse_" . $question->getId() . "_" . $reponse->getId() . "' name='reponse_" . $question->getId() . "' value='" . $reponse->getId() . "'>";
        echo "<label for='reponse_" . $question->getId() . "_" . $reponse->getId() . "'>" . $reponse->getReponseText() . "</label>";
        echo "</div>";
    }

    echo "</div>";
}

echo "<input type='hidden' name='id_quiz' value='" . $id_quiz . "'>";
echo "<button type='submit' id='next-btn'>Valider</button>
</form>
</div>

</body>
</html>";
?>
