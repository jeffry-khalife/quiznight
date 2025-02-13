<?php 

class administrateur {
    private $id;
    private $nom_utilisateur;
    private $mot_de_passe;
    private $email;
    private $date_creation;


    public function __construct($id, $nom_utilisateur, $mot_de_passe, $email) {
        $this->id = $id;
        $this->nom_utilisateur = $nom_utilisateur;
        $this->mot_de_passe = $mot_de_passe;
        $this->email = $email;
        $this->date_creation = $date_creation;

    }

    public static function authenticate($nom_utilisateur, $mot_de_passe) {
    }

    public static function getAllUsers() {
    }

    public static function getUserById($id) {
    }
}

?>