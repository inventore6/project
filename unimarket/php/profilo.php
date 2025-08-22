<!-- filepath: c:\xampp\htdocs\unimarket\profilo.php -->
<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$nome = $isLoggedIn ? $_SESSION['nome'] : 'Nome Utente';


?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo Utente</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<!-- Barra di navigazione -->
<div class="navbar">
    <div class="logo">
        <a href="home.php"><img src="../immagini/logo.png" alt="Logo"></a>
    </div>
    <div class="nav-links">
        <a href="home.php">Home</a>
        <a href="profilo.php">Profilo</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<!-- Contenuto del profilo -->
<div class="profile-container">
    <div class="profile-image">
        <img src="immagini/profile.png" alt="Immagine Profilo" id="profilePic">
        <button onclick="changeProfilePic()">Modifica Immagine</button>
    </div>
    <div class="profile-info">
        <h1><?php echo htmlspecialchars($nome); ?></h1>
       
        <p><strong>Università:</strong> <?php echo htmlspecialchars($nome_univerista); ?></p>
    </div>
</div>

<script>
    function changeProfilePic() {
        alert("Funzionalità di modifica immagine non implementata.");
    }
</script>

</body>
</html>