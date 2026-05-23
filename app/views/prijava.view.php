<div>
<img src="/assets/images/user_icon.png" alt="prijavna ikona">
<h2>Dobrodošli nazaj</h2>
<p>za nadaljevanje se prosim prijavite</p>
<form action="/auth/prijava" method="POST">
<label for="email">E-poštni naslov</label>
        <input type="email" id="email" name="email" placeholder="E-poštni naslov" required>

        <label for="geslo">Geslo</label>
        <input type="password" id="geslo" name="geslo" placeholder="Geslo" required>

        <label>
            <input type="checkbox" name="zapomni"> Zapomni si me
        </label>

        <a href="/pozabljeno-geslo">Pozabljeno geslo?</a>

        <button type="submit">Prijava</button>

    </form>

    <p>Nimate računa? <a href="/auth/registracija">Registracija</a></p>
</div>
<?php if(isset($napaka)): ?>
    <p><?= $napaka ?></p>
<?php endif; ?>

