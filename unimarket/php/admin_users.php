<?php
require_once 'config.php';

// Approva o rifiuta utente
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($_GET['action'] == 'approva') {
        $conn->query("UPDATE studente SET approvato = 1 WHERE id = $id");
    } elseif ($_GET['action'] == 'rifiuta') {
        $conn->query("DELETE FROM studente WHERE id = $id");
    }
}

// Mostra utenti non approvati
$result = $conn->query("SELECT id, nome, cognome, email, nome_universita FROM studente WHERE approvato = 0");
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Utenti Registrati</title>
</head>
<body>
    <h1>Utenti in attesa di approvazione</h1>
    <table border="1">
        <tr>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Email</th>
            <th>Università</th>
            <th>Azioni</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['nome']); ?></td>
            <td><?php echo htmlspecialchars($row['cognome']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['nome_universita']); ?></td>
            <td>
                <a href="?action=approva&id=<?php echo $row['id']; ?>">Approva</a> |
                <a href="?action=rifiuta&id=<?php echo $row['id']; ?>" onclick="return confirm('Sei sicuro di voler rifiutare questo utente?');">Rifiuta</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>