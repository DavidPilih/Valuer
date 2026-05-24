<script src="/assets/js/auth.js" defer></script>
<div class="uporabnik_form">
    <h2>Dobrodošli</h2>
    <p>Za nadaljevanje se prosim registrirajte</p>
<form action="/auth/registracija" method="POST">

    <div class="mb-3">
        <label for="ime" class="form-label">Ime</label>
        <input type="text" id="ime" name="ime" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="priimek" class="form-label">Priimek</label>
        <input type="text" id="priimek" name="priimek" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">E-poštni naslov</label>
        <input type="email" id="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="novo_geslo" class="form-label">Geslo</label>
        <input type="password" id="novo_geslo" name="geslo" class="form-control" required>
        <div id="geslo_napaka" class="text-danger mt-1" style="display:none;"></div>
    </div>

    <div class="mb-3">
        <label for="ponovno_geslo" class="form-label">Ponovni vnos gesla</label>
        <input type="password" id="ponovno_geslo" name="ponovno_geslo" class="form-control">
        <div id="ponovitev_napaka" class="text-danger mt-1" style="display:none;"></div>
    </div>

    <div class="mb-3">
        <label class="form-check-label">
            <input type="checkbox" name="zapomni" class="form-check-input"> Zapomni si me
        </label>
    </div>

    <div class = "ba">
    <a href="/pozabljeno-geslo" class="d-block mb-3">Pozabljeno geslo?</a>

    <button type="submit" id="gumb_potrdi" class="btn btn-primary" disabled>Registracija</button>
    </div>
</form>

<div class = "ba">
<p class="mt-3">Že imate račun? <a href="/auth/prijava">Prijava</a></p>
</div>
<?php if(isset($napaka)): ?>
    <div class="alert alert-danger mt-3" role="alert">
        <?= $napaka ?>
    </div>
<?php endif; ?>
</div>
