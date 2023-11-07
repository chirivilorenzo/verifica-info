<?php
    class CPrenotazione{
        public $nome;
        public $cognome;
        public $numTelefono;
        public $data;
        public $numPersone;
        public $bambini;
        public $cani;
        public $altro;

        function __construct($nome, $cognome, $numTelefono, $data, $numPersone, $bambini, $cani, $altro){
            $this->nome = $nome;
            $this->cognome = $cognome;
            $this->numTelefono = $numTelefono;
            $this->data = $data;
            $this->numPersone = $numPersone;
            $this->bambini = $bambini;
            $this->cani = $cani;
            $this->altro = $altro;
        }

        function visualizzaRiepilogo(){
            $stringa = "nome: " . $this->nome . "<br>";
            $stringa .= "cognome: " . $this->cognome ."<br>";
            $stringa .= "numero telefono: ". $this->numTelefono . "<br>";
            $stringa .= "data: ". $this->data ."<br>";
            $stringa .= "numero persone: ". $this->numPersone . "<br>";
            $stringa .= "bambini?: ". $this->bambini . "<br>";
            $stringa .= "cani?: ". $this->cani . "<br>";
            $stringa .= "altro: ". $this->altro;

            echo $stringa;
        }

        function aggiornaFile($contenutoFileNuovo, $nomeFileVecchio){
            //contenutoFileNuovo contiene una stringa con tutto il file
            //nomeFileVecchio è il nome del file da sostituire

            file_put_contents($nomeFileVecchio, $contenutoFileNuovo);
        }

        //linea -> nome;cognome;numTelefono;numPrenotazioni
        function controllaAutenticato($nomeFile){
            $contenuto = file_get_contents($nomeFile);  //contenuto del file credenziali
            $tmp = explode("\n", $contenuto);   //vettore contenente tutte le linee del file separate dal \n
            $nuovoFile = "";    //variabile che salva al suo interno il nuovo file con le modifiche al numero di prenotazione
            $flag = false;  //se entra nel primo if, allora il file dev'essere modificato e quindi chiamo al funzione per modificarlo

            for($i = 0; $i < count($tmp); $i++){

                //metto le informazioni che si trovano su una linea dentro ad un'array
                $linea = explode(";", $tmp[$i]);

                //se l'untente è stato trovato nel file, incrementa il num di prenotazioni
                if($linea[0] == $this->nome && $linea[1] == $this->cognome && $linea[2] == $this->numTelefono){

                    //flag che serve per capire se il file dovrà essere modificato
                    //(ovvero incrementare il suo numero di prenotazioni fatte)
                    $flag = true;

                    //prendo il numero di prenotazioni dal file, lo incremento di uno e lo rimetto nell'array $linea
                    $numPrenotazioni = intval($linea[3]);
                    $numPrenotazioni++;
                    $linea[3] = $numPrenotazioni;

                    //aggiungo la nuova linea nella variabile che contiene il contenuto del nuovo file
                    $nuovoFile .= $linea[0] . ";" . $linea[1] . ";" . $linea[2] . ";" . $linea[3] . "\n";
                }
                else{
                    $nuovoFile .= $linea[0] . ";" . $linea[1] . ";" . $linea[2] . ";" . $linea[3] . "\n";
                }
            }

            //se entrati nel primo if (utente trovato), modifica il file con il nuovo numero di prenotazione
            if($flag){
                $this->aggiornaFile($contenuto, $nomeFile);
            }

            //se l'utente non è stato trovato, lo aggiungo nel file
            else{
                $contenuto .= $this->nome . ";" . $this->cognome . ";". $this->numTelefono . ";". "0" . "\n";
                $this->aggiornaFile($contenuto, $nomeFile);
            }

            //controllare quale contrassegno dare
            //contrassegno STANDARD
            if($numPrenotazioni >= 0 && $numPrenotazioni <= 3){
                return "numero prenotazioni: ". $numPrenotazioni . "<br>" . "contrassegno: STANDARD";
            }

            //contrassegno BRONZE
            else if($numPrenotazioni >= 4 && $numPrenotazioni <= 7){
                return "numero prenotazioni: ". $numPrenotazioni . "<br>" . "contrassegno: BRONZE";
            }

            //contrassegno SILVER
            else if($numPrenotazioni >= 8 && $numPrenotazioni <= 12){
                return "numero prenotazioni: ". $numPrenotazioni . "<br>" . "contrassegno: SILVER";
            }

            //contrassegno GOLD
            else if($numPrenotazioni >= 13 && $numPrenotazioni <= 17){
                return "numero prenotazioni: ". $numPrenotazioni . "<br>" . "contrassegno: GOLD";
            }

            //contrassegno SUPER DIAMOND DELUX PREMIUM  
            else if($numPrenotazioni >= 18){
                return "numero prenotazioni: ". $numPrenotazioni . "<br>" . "contrassegno: SUPER DIAMOND DELUXE PPREMIUM";
            }

            else{
                return "errore nel calcolare il contrassegno";
            }
        }

    }


?>