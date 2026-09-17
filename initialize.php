<?php

include_once "conn.php";

function impostaPosizioneIniziale(&$matriceCampo, $conn){
    $matriceCampo[0][0] = 1;

    mysqli_query($conn, "DELETE FROM PosizioniOccupate");
    mysqli_query($conn, "INSERT INTO PosizioniOccupate (x, y) VALUES (0, 0)");
}

/* Controllo se il database contiene una posizione */
$result = mysqli_query($conn, "SELECT COUNT(*) AS totale FROM PosizioniOccupate");
$row = mysqli_fetch_assoc($result);
$databaseVuoto = ($row['totale'] == 0);

/*
 * Inizializzo una nuova partita se:
 * - non esiste la scacchiera in sessione
 * - oppure il database non contiene più posizioni
 */
if (!isset($_SESSION['campo']) || $databaseVuoto) {

    $matriceCampo = array(
        array(0,0,0,0,0,0,0,0),
        array(0,0,0,0,0,0,0,0),
        array(0,0,0,0,0,0,0,0),
        array(0,0,0,0,0,0,0,0),
        array(0,0,0,0,0,0,0,0),
        array(0,0,0,0,0,0,0,0),
        array(0,0,0,0,0,0,0,0),
        array(0,0,0,0,0,0,0,0)
    );

    impostaPosizioneIniziale($matriceCampo, $conn);

    $_SESSION['campo'] = $matriceCampo;
}