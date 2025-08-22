<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";  // Host del database
$username = "root";          // Username di phpMyAdmin
$password_db = "";           // Password di phpMyAdmin (vuota su XAMPP di default)
$dbname = "uni_market";      // Nome del database che hai creato

// Crea la connessione
$conn = new mysqli($servername, $username, $password_db, $dbname);

// ATTIVA errori dettagliati
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Controlla la connessione
if ($conn->connect_error) {
    die("Errore di connessione: " . $conn->connect_error);
}
?>