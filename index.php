<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Tektur:wght@400..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
</head>
<body>

<!--HAUT DE PAGE-->
    <header>
        <nav>
            <ul class="hautdepage">
                <li><a class="lien" href="index.php">Quiznight</a></li>
                <li><a class="lien" href="logout.php">Deconnexion</a></li>
            </ul>
        </nav>
    </header>

<!--PAGE-->
    <section>
        <!--quiz friends-->
        <div class="quiz2">
            <div class="quizserie">
                <p class="titrequiz">
                    QUIZ 1
                </p>
                <a href="quizz.php?id_quiz=2">
                    <img class="séries2" src="images/friends.png" alt="photo série friends">
                </a>
                <p class="titresérie">
                    Friends
                </p>    
            </div>
        </div>

        <!--quiz la casa de papel-->
        <div class="quiz2">
            <div class="quizserie">
                <p class="titrequiz">
                    QUIZ 2
                </p>
                <a href="quizz.php?id_quiz=3">
                    <img class="séries2" src="images/lacasadepapel.png" alt="photo série lacasadepapel">
                </a>
                <p class="titresérie">
                    La casa de papel
                </p> 
            </div>
        </div>

        <!--quiz arcane-->
        <div class="quiz2">
            <div class="quizserie">
                <p class="titrequiz">
                    QUIZ 3
                </p>
                <a href="quizz.php?id_quiz=1">
                    <img class="séries2" src="images/arcane.png" alt="photo série arcane">
                </a>
                <p class="titresérie">
                    Arcane
                </p> 
            </div>
        </div>

        <!--quiz prison break-->
        <div class="quiz2">
            <div class="quizserie">
                <p class="titrequiz">
                    QUIZ 4
                </p>
                <a href="quizz.php?id_quiz=4">
                    <img class="séries2" src="images/prisonbreak.png" alt="photo série prison break">
                </a>
                <p class="titresérie">
                    Prison Break
                </p> 
            </div>
        </div>
    </section>

    <section class="quizcrcc">
        <!--quiz chats-->
        <div class="quiz3">
            <div class="quizanimal">
                <p class="titrequiz">
                    QUIZ 5
                </p>
                <a href="quizz.php?id_quiz=8">
                    <img class="animal2" src="images/chat.png" alt="photo quiz chats">
                </a>
                <p class="titreanimal">
                    Chats
                </p>
            </div>
        </div>

        <!--quiz requin-->
        <div class="quiz3">
            <div class="quizanimal">
                <p class="titrequiz">
                    QUIZ 6
                </p>
                <a href="quizz.php?id_quiz=6">
                    <img class="animal2" src="images/requin.png" alt="photo quiz requins">
                </a>
                <p class="titreanimal">
                    Requins
                </p>
            </div>
        </div>

        <!--quiz calopsitte-->
        <div class="quiz3">
            <div class="quizanimal">
                <p class="titrequiz">
                    QUIZ 7
                </p>
                <a href="quizz.php?id_quiz=5">
                    <img class="animal2" src="images/calopsitte.png" alt="photo quiz calopsitte">
                </a>
                <p class="titreanimal">
                    Calopsitte
                </p>
            </div>
        </div>

        <!--quiz chien-->
        <div class="quiz3">
            <div class="quizanimal">
                <p class="titrequiz">
                    QUIZ 8
                </p>
                <a href="quizz.php?id_quiz=7">
                    <img class="animal2" src="images/chien.png" alt="photo quiz chiens">
                </a>
                <p class="titreanimal">
                    Chiens
                </p>
            </div>
        </div>
    </section>
</body>
</html>