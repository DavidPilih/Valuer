<script src="/assets/js/auth.js" defer></script>
<div class="uporabnik_form">
    <!-- <img src="/assets/images/user_icon.png" alt="prijavna ikona"> -->
    <h2>Dobrodošli nazaj</h2>
    <p>Za nadaljevanje se prosim prijavite</p>

    <form action="/auth/prijava" method="POST">

        <div class="mb-3">
            <label for="email" class="form-label">E-poštni naslov</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="geslo" class="form-label">Geslo</label>
            <input type="password" id="geslo" name="geslo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-check-label">
                <input type="checkbox" name="zapomni" class="form-check-input"> Zapomni si me
            </label>
        </div>

        <div class="d-flex flex-column align-items-center gap-2">
            <a href="/pozabljeno-geslo">Pozabljeno geslo?</a>
            <button type="submit" class="btn btn-primary">Prijava</button>
        </div>

    </form>

    <div class="text-center">
        <p class="mt-3">Nimate računa? <a href="/auth/registracija">Registracija</a></p>
    </div>
    
<?php if(isset($napaka)): ?>
    <div class="alert alert-danger mt-3" role="alert">
        <?= $napaka ?>
    </div>
<?php endif; ?>
</div>
