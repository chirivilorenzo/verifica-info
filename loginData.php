<?php
    if(!isset($_SESSION)){
        session_start();
    }

    //se non sono state settate queste variabili, ritorna alla login principale
    if(!isset($_SESSION["nome"]) || !isset($_SESSION["cognome"]) || !isset($_SESSION["numTelefono"])){
        header("Location: loginNome.php");
        exit;
    }

    //se tutto corretto, creo le variabili di sessione richieste e vado alla loginAggiuntive (bambini, cani, altro)
    if(isset($_GET["submit"])){
        $_SESSION["data"] = $_GET["data"];
        $_SESSION["numPersone"] = $_GET["numPersone"];

        header("Location: loginAggiuntive.php");
        exit;
    }
?>

<html>
    <head></head>
    <body>
        <h2>Prenotazione</h2>
        <form method="get">
            data: <input type="date" name="data"><br>
            numero di persone: <input type="text" name="numPersone"><br>
            <input type="submit" name="submit" value="continua">
        </form>
    </body>
</html>