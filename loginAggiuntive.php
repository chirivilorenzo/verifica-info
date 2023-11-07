<?php
    if(!isset($_SESSION)){
        session_start();
    }
    
    //se non sono state settate queste variabili, ritorna alla login principale
    if(!isset($_SESSION["nome"]) || !isset($_SESSION["cognome"]) || !isset($_SESSION["numTelefono"])){
        if(!isset($_SESSION["data"]) || !isset($_SESSION["numPersone"])){
            header("Location: loginNome.php");
        }
    }


    //se tutto corretto, creo le variabili di sessione richieste e vado al riepilogo
    if(isset($_GET["submit"])){
        $_SESSION["bambini"] = $_GET["bambini"];
        $_SESSION["cani"] = $_GET["cani"];
        $_SESSION["altro"] = $_GET["altro"];

        header("Location: riepilogo.php");
        exit;
    }


?>

<html>
    <head></head>
    <body>
        <h2>Prenotazione</h2>
        <form method="get">
            ci sono bambini? <input type="checkbox" name="bambini"><br>
            ci sono cani? <input type="checkbox" name="cani"><br>
            altro: <input type="text" name="altro"><br>

            <input type="submit" name="submit" value="continua">
        </form>
    </body>
</html>