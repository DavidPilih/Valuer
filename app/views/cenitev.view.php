<div class="uporabnik_form">
    <h2>Cenitev</h2>

    <div class="mb-3">
        <label class="form-label fw-bold">Naziv naročnika</label>
        <p class="form-control-plaintext"><?= htmlspecialchars($cenitev->naziv_narocnika) ?></p>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Naslov naročnika</label>
        <p class="form-control-plaintext"><?= htmlspecialchars($cenitev->naslov_narocnika) ?></p>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Namen cenitve</label>
        <p class="form-control-plaintext"><?= htmlspecialchars($cenitev->namen_naziv) ?></p>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Podlaga vrednosti</label>
        <p class="form-control-plaintext"><?= htmlspecialchars($cenitev->podlaga_naziv) ?></p>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Premisa vrednosti</label>
        <p class="form-control-plaintext"><?= htmlspecialchars($cenitev->premisa_naziv) ?></p>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Prvi ogled</label>
        <p class="form-control-plaintext"><?= date("d.m.Y H:i", strtotime($cenitev->prvi_ogled)) ?></p>
    </div>

    <div class="d-flex justify-content-center">
        <a href="/cenitve/urediCenitev/<?= $cenitev->id ?>" class="btn btn-warning me-2">
            Uredi
        </a>
        <a href="/cenitve" class="btn btn-secondary">
            Nazaj
        </a>
    </div>

</div>