<?php 

class Reponse {
    private $id;
    private $reponseText;
    private $estCorrecte;
    private $questionId;  

    public function __construct($id, $reponseText, $estCorrecte, $questionId) {
        $this->id = $id;
        $this->reponseText = $reponseText;
        $this->estCorrecte = $estCorrecte;
        $this->questionId = $questionId;  
    }

    public function getId() {
        return $this->id;
    }

    public function getReponseText() {
        return $this->reponseText;
    }

    public function getEstCorrecte() {
        return $this->estCorrecte;
    }

    public function getQuestionId() {
        return $this->questionId;
    }
}



?>