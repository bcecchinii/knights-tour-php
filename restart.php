<?php

include_once "conn.php";

session_start();

/* Elimino lo storico della partita */
mysqli_query($conn, "DELETE FROM PosizioniOccupate");

/* Elimino la sessione */
session_unset();
session_destroy();

/* Torno alla pagina principale */
header("Location: index.php");
exit;