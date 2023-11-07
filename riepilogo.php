<?php

    include("CPrenotazione.php");
    if(!isset($_SESSION)){
        session_start();
    }

    //se non sono state settate queste variabili, ritorna alla login principale
    if(!isset($_SESSION["nome"]) || !isset($_SESSION["cognome"]) || !isset($_SESSION["numTelefono"])){
        if(!isset($_SESSION["data"]) || !isset($_SESSION["numPersone"])){
            header("Location: loginNome.php");
        }
    }

    //sistemo le variabili dei bambini e dei cani
    if(!isset($_SESSION["bambini"])){
        $_SESSION["bambini"] = "no";
    }
    else{
        $_SESSION["bambini"] = "si";
    }

    if(!isset($_SESSION["cani"])){
        $_SESSION["cani"] = "no";
    }
    else{
        $_SESSION["cani"] = "si";
    }

    //creo l'oggetto prenotazione e visualizzo il riepilogo
    $prenotazione = new CPrenotazione($_SESSION["nome"], $_SESSION["cognome"], $_SESSION["numTelefono"], $_SESSION["data"], $_SESSION["numPersone"], $_SESSION["bambini"], $_SESSION["cani"], $_SESSION["altro"]);
    $prenotazione->visualizzaRiepilogo();

    //visualizzo il numero di prenotazioni fatte più il contrassegno
    echo "<br>" . $prenotazione->controllaAutenticato("credenziali.txt");

    //quando schiaccia su conferma, cancella la sessione e ritorna alla login principale
    if(isset($_GET["submit"])){
        session_destroy();
        header("Location: loginNome.php");
        exit;
    }

?>


<html>
    <head></head>
    <body>
        <form method="get">
            <input type="submit" name="submit" value="conferma">
        </form>
    </body>
</html>