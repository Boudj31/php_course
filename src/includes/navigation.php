<header class="text-center bg-dark text-light">
    <h1>Cours PHP</h1>
</header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="https://www.php.net/">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/PHP-logo.svg/2560px-PHP-logo.svg.png" alt="logo php" width="60">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
        aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo pageActive("index.php"); ?>"
                    aria-current="page" href="./index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo pageActive("classe.php"); ?>"
                       aria-current="page" href="./classe.php">POO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo pageActive("collection.php"); ?>"
                       aria-current="page" href="./collection.php">Collections</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo pageActive("classeetendue"); ?>"
                       aria-current="page" href="./classeetendu.php">Classes étendues</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo pageActive("exception"); ?>"
                       aria-current="page" href="./exception.php">Exceptions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo pageActive("factory"); ?>"
                       aria-current="page" href="./factory.php">Les Factory</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo pageActive("pdo"); ?>"
                       aria-current="page" href="./pdo.php">PDO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo pageActive("prepaTosa"); ?>"
                       aria-current="page" href="./prepaTosa.php">Prépa Tosa</a>
                </li>


            </ul>
            <!--
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            -->
        </div>
    </div>
</nav>