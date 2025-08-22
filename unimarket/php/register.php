<?php
require_once 'config.php';

// Inizializza le variabili per evitare errori
$nome = $cognome = $email = $password = $nome_universita = "";
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
            echo "Registrazione avvenuta con successo!";
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
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registrazione</title>
    <link rel="stylesheet" href="../registerstyle.css">
</head>
<body>
    <div class="form-wrapper">
        <div class="form-container">
            <div class="logo">
                <img src="../immagini/Logo.png" alt="Logo">
            </div>
            <form id="registerForm" action="register.php" method="POST">
                <div>
                    <input 
                        type="text" 
                        name="nome" 
                        placeholder="Nome" 
                        value="<?php echo htmlspecialchars($nome); ?>" 
                        required 
                        oninvalid="this.setCustomValidity('Il nome deve contenere solo lettere e non deve avere spazi o numeri.')"
                        oninput="this.setCustomValidity('')">
                    <?php if (!empty($errors['nome'])): ?>
                        <p class="error"><?php echo $errors['nome']; ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <input 
                        type="text" 
                        name="cognome" 
                        placeholder="Cognome" 
                        value="<?php echo htmlspecialchars($cognome); ?>" 
                        required 
                        oninvalid="this.setCustomValidity('Il cognome deve contenere solo lettere e non deve avere spazi o numeri.')"
                        oninput="this.setCustomValidity('')">
                    <?php if (!empty($errors['cognome'])): ?>
                        <p class="error"><?php echo $errors['cognome']; ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Email" 
                        value="<?php echo htmlspecialchars($email); ?>" 
                        required 
                        oninvalid="this.setCustomValidity('Inserisci un indirizzo email valido nel formato esempio@dominio.com.')"
                        oninput="this.setCustomValidity('')">
                    <?php if (!empty($errors['email'])): ?>
                        <p class="error"><?php echo $errors['email']; ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="Password" 
                        required 
                        oninvalid="this.setCustomValidity('La password deve contenere massimo 8 caratteri, almeno una lettera maiuscola e un carattere speciale.')"
                        oninput="this.setCustomValidity('')">
                    <?php if (!empty($errors['password'])): ?>
                        <p class="error"><?php echo $errors['password']; ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <select name="nome_universita" required oninvalid="this.setCustomValidity('Seleziona un\'università.')" oninput="this.setCustomValidity('')">
                        <option value="" disabled <?php echo empty($nome_universita) ? 'selected' : ''; ?>>Seleziona l'università</option>
                        <option value="Università di Milano" <?php echo ($nome_universita == 'Università di Milano') ? 'selected' : ''; ?>>Università di Milano</option>
                        <option value="Università di Napoli" <?php echo ($nome_universita == 'Università di Napoli') ? 'selected' : ''; ?>>Università di Napoli</option>
                        <option value="Università di Bolzano" <?php echo ($nome_universita == 'Università di Bolzano') ? 'selected' : ''; ?>>Università di Bolzano</option>
                    </select>
                </div>
                <button type="submit" class="btn">Registrati</button>
            </form>
        </div>
    </div>
</body>
</html>