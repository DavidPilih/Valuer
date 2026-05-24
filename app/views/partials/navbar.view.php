<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
    <div class="container-fluid">
        <img id="logo" src="/assets/images/logo.png" alt="logo">
        <a class="navbar-brand" href="/">Valuer</a>

        <ul class="navbar-nav flex-row gap-5">
            <li class="nav-item">
                <a class="nav-link" href="/">Domov</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Cenitve">Cenitve</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Cenitve">Cenitve</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Cenitve/fill">FILL IZBRISI</a>
            </li>
        </ul>

        <ul class="navbar-nav flex-row gap-5 ms-auto">
            <?php if (isset($_SESSION['uporabnik'])): ?>

                <li class="nav-item">
                    <a class="nav-link" href="/auth/spremembaGesla"><?php echo $_SESSION['uporabnik']['ime']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/auth/odjava">Odjava</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="/auth/prijava">Prijava</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/auth/registracija">Registracija</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>