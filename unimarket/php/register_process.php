<?php
require_once 'config.php';

$errors = []; // Array per raccogliere gli errori

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dati dal form
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nome_universita = $_POST['nome_universita'];

    // Verifica del nome (senza spazi e numeri)
    if (!preg_match("/^[a-zA-Z]+$/", $nome)) {
        $errors['nome'] = "Il nome deve contenere solo lettere e non deve avere spazi o numeri.";
    }

    // Verifica del cognome (senza spazi e numeri)
    if (!preg_match("/^[a-zA-Z]+$/", $cognome)) {
        $errors['cognome'] = "Il cognome deve contenere solo lettere e non deve avere spazi o numeri.";
    }

    // Verifica dell'email (formato valido)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'email non è valida. Deve essere nel formato esempio@dominio.com.";
    }

    // Verifica della password (8 caratteri massimo, una lettera maiuscola, un carattere speciale)
    if (!preg_match("/^(?=.*[A-Z])(?=.*\W).{1,8}$/", $password)) {
        $errors['password'] = "La password deve contenere massimo 8 caratteri, almeno una lettera maiuscola e un carattere speciale.";
    }

    // Se non ci sono errori, procedi con l'inserimento nel database
    if (empty($errors)) {
        $plain_password = $password; // Salva la password in formato originale

        // Prepara la query corretta
        $sql = "INSERT INTO studente (nome, cognome, email, password, nome_universita) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Errore nella preparazione della query: " . $conn->error);
        }

        $stmt->bind_param("sssss", $nome, $cognome, $email, $plain_password, $nome_universita);

        if ($stmt->execute()) {
            header("Location: login.php"); // Reindirizza alla pagina di login
            exit();
        } else {
            $errors['database'] = "Errore durante la registrazione: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>