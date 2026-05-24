
<script src="/assets/js/auth.js" defer></script>
<div class="uporabnik_form">
<form action="/auth/spremembaGesla" method="POST">
    <h2>Sprememba gesla</h2>

  <div class="mb-3">
    <label for="staro_geslo" class="form-label">Staro geslo</label>
    <input type="password" id="staro_geslo" name="staro_geslo" class="form-control">
  </div>

<div class="mb-3">
    <label for="novo_geslo" class="form-label">Geslo</label>
    <input type="password" id="novo_geslo" name="geslo" class="form-control" required aria-describedby="gesloHelp">
    <div id="gesloHelp" class="form-text">
        Vaše geslo mora biti dolgo 8–20 znakov, vsebovati mora črke in številke ter ne sme vsebovati presledkov, posebnih znakov ali emojijev.
    </div>
    <div id="geslo_napaka" class="text-danger mt-1" style="display:none;"></div>
</div>

  <div class="mb-3">
    <label for="ponovno_geslo" class="form-label">Ponovni vnos gesla</label>
    <input type="password" id="ponovno_geslo" name="ponovno_geslo" class="form-control">
    <div id="ponovitev_napaka" class="text-danger mt-1" style="display:none;"></div>
  </div>

  <button type="submit" id="gumb_potrdi" class="btn btn-primary" disabled>Potrdi</button>

</form>
</div>
<?php if(isset($napaka)): ?>
<p><?= $napaka?></p>
<?php endif; ?>
