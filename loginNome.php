<?php
    if(!isset($_SESSION)){
        session_start();
    }

    //se è stato schiacciato il tasto per continuare
    if(isset($_GET["submit"])){

        //controllo se esistono le variabili
        if(!isset($_GET["nome"]) || !isset($_GET["cognome"]) || !isset($_GET["numTelefono"])){
            echo "uno o più campi sono mancanti";
        }
        else{
            //modifico i campi in modo che l'utente non possa aggiungere spazi o lettere maiuscole
            $nome = $_GET["nome"];
            $nome = trim($nome);
            $nome = strtolower($nome);


            $cognome = $_GET["cognome"];
            $cognome = trim($cognome);
            $cognome = strtolower($cognome);

            
            $numTelefono = $_GET["numTelefono"];

            //controllo che l'utente non metta il ; nei campi
            if(str_contains($nome, ";") || str_contains($cognome, ";") || str_contains($numTelefono, ";")){
                echo "non puoi inserire il ; nei campi";
            }

            //se tutto corretto, creo le variabili di sessione richieste e vado alla loginData (data e numPersone)
            else{
                $_SESSION["nome"] = $nome;
                $_SESSION["cognome"] = $cognome;
                $_SESSION["numTelefono"] = $numTelefono;

                header("Location: loginData.php");
                exit;
            }
        }
    }
?>

<html>
    <body>
        <h2>Prenotazione</h2>
        <form method="get">
            nome: <input type="text" name="nome"><br>
            cognome: <input type="text" name="cognome"><br>
            numero di telefono: <input type="text" name="numTelefono"><br>

            <input type="submit" name="submit" value="continua">
        </form>
    </body>
</html>