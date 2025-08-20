<!-- filepath: c:\xampp\htdocs\unimarket\home.php -->
<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$nome = $isLoggedIn ? $_SESSION['nome'] : ''; // Nome utente dalla sessione
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniMarket - Home</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="script.js" defer></script> <!-- File JavaScript separato -->
</head>
<body>

<!-- Header -->
<div class="header-container">
    <div class="logo">
        <img src="immagini/logo.png" alt="Logo">
    </div>
    <div class="search-bar-area">
        <form class="search-bar" action="#" method="get">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Cerca articoli" name="search">
        </form>
    </div>
    <div class="header-actions">
        <?php if ($isLoggedIn): ?>
            <div class="user-menu">
                <div class="user-avatar" onclick="toggleMenu()">
                    <i class="fa-solid fa-user"></i> <!-- Icona del profilo -->
                </div>
                <span class="nome" onclick="toggleMenu()"><?php echo htmlspecialchars($nome); ?></span>
                <div class="dropdown-menu" id="userDropdown">
                    <ul>
                        <li><a href="profilo.php">Profilo</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        <?php else: ?>
            <div class="auth-links">
                <a href="register.php">Iscriviti</a>
                <a href="login.php">Accedi</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Navigazione -->
<nav class="main-nav">
    <ul class="nav-categories">
        <li class="nav-item first-item">
            <a href="#"><img src="immagini/libri.jpg" class="nav-icon"> Libri</a>
            <div class="dropdown">
                <p>Libri di testo universitari</p>
                <p>Romanzi</p>
                <p>Manuali tecnici</p>
                <p>Guide pratiche</p>
            </div>
        </li>
        <li class="nav-item">
            <a href="#"><img src="immagini/appunti.jpg" class="nav-icon"> Appunti e materiale di studio</a>
            <div class="dropdown">
                <p>Appunti esami</p>
                <p>Riassunti</p>
                <p>Esercizi svolti</p>
                <p>Schermi - PowerPoint</p>
            </div>
        </li>
        <li class="nav-item">
            <a href="#"><img src="immagini/abbigliamento.jpg" class="nav-icon"> Abbigliamento</a>
            <div class="dropdown">
                <p>Magliette universitarie</p>
                <p>Felpe</p>
                <p>Giacche</p>
                <p>Scarpe</p>
                <p>Accessori</p>
            </div>
        </li>
        <li class="nav-item">
            <a href="#"><img src="immagini/musica.jpg" class="nav-icon"> Musica</a>
            <div class="dropdown">
                <p>Strumenti musicali</p>
                <p>Spartiti</p>
                <p>Vinili/CD</p>
                <p>Accessori musicali</p>
            </div>
        </li>
        <li class="nav-item">
            <a href="#"><img src="immagini/elettronica.jpg" class="nav-icon"> Elettronica</a>
            <div class="dropdown">
                <p>Laptop</p>
                <p>Tablet</p>
                <p>Cuffie</p>
                <p>Macchine fotografiche</p>
                <p>Calcolatrici scientifiche</p>
                <p>Caricatori</p>
                <p>Accessori</p>
            </div>
        </li>
        <li class="nav-item">
            <a href="#"><img src="immagini/altro.jpg" class="nav-icon"> Altro</a>
            <div class="dropdown">
                <p>Borracce</p>
                <p>Oggetti da scrivania</p>
                <p>Articoli per casa</p>
                <p>Gadget universitari</p>
            </div>
        </li>
    </ul>
</nav>

<!-- Footer -->
<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-column">
            <h4>UniMarket</h4>
            <ul>
                <li><a href="chi-siamo.html">Chi siamo</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Cosa fare</h4>
            <ul>
                <li><a href="come-vendere.html">Come vendere</a></li>
                <li><a href="come-acquistare.html">Come acquistare</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Supporto</h4>
            <ul>
                <li><a href="#">Contattaci</a></li>
                <li><a href="#">FAQ</a></li>
            </ul>
        </div>
    </div>
</footer>

</body>
</html>