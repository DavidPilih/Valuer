<nav>
<a href="/">Valuer</a>

<ul>
    <li>Domov</li>
    <?php if(isset($_SESSION['uporabnik'])) :?>
    <a href="/cenitve">Cenitve</a>
    <p><?php echo $_SESSION['uporabnik']['ime'];?></p>
    <a href="/auth/odjava">odjava</a>
    <?php else: ?>
        <a href="/auth/prijava">Prijava</a>
        <a href="/auth/registracija">Registracija</a>
    <?php endif; ?>
</ul>
</nav>