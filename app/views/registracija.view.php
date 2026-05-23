<div>
<img src="/assets/images/user_icon.png" alt="prijavna ikona">
<h2>Dobrodošli nazaj</h2>
<p>za nadaljevanje se prosim prijavite</p>
<form action="/auth/registracija" method="POST">

<label for="ime">Ime</label>
<input type="text" id="ime" name="ime" placeholder="Ime" required>

<label for="priimek">Priimek</label>
<input type="text" id="priimek" name="priimek" placeholder="Priimek" required>

<label for="email">E-poštni naslov</label>
<input type="text" id="email" name="email" placeholder="E-poštni naslov" required>

        <label for="geslo">Geslo</label>
        <input type="password" id="geslo" name="geslo" placeholder="Geslo" required>

        <label>
            <input type="checkbox" name="zapomni"> Zapomni si me
        </label>

        <a href="/pozabljeno-geslo">Pozabljeno geslo?</a>

        <button type="submit">Registracija</button>

    </form>

    <p>Že imate račun? <a href="/auth/prijava">Prijava</a></p>
</div>
<?php if(isset($napaka)): ?>
    <p><?= $napaka ?></p>
<?php endif; ?>