<?php 

class Question {
    private $id;
    private $questionText;
    private $quiz_id;

    public function __construct($id, $questionText, $quiz_id) {
        $this->id = $id;
        $this->questionText = $questionText;
        $this->quiz_id = $quiz_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getQuestionText() {
        return $this->questionText;
    }

    public function getReponses($db) {
        $query = "SELECT * FROM reponse WHERE id_question = :id_question";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_question', $this->id);
        $stmt->execute();
    
        $reponses = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $reponses[] = new Reponse($row['id'], $row['texte_reponse'], $row['est_correcte'], $this->id);
        }
    
        return $reponses;
    }
    
}


?>