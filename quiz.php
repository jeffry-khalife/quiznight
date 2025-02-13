<?php
class Quiz {
    private $id;
    private $title;
    
    public function __construct($id, $title) {
        $this->id = $id;
        $this->title = $title;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getQuestions($db) {
    $query = "SELECT * FROM question WHERE id_quiz = :id_quiz";  
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id_quiz', $this->id);
    $stmt->execute();
    
    $questions = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $questions[] = new Question($row['id'], $row['texte_question'], $this->id);
    }
    
    return $questions;
}

}
?>