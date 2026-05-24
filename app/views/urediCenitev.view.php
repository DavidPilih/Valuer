<div class="uporabnik_form">
    <h2>Uredi cenitev</h2>

    <form action="/cenitve/urediCenitev/<?= $cenitev->id ?>" method="POST">

        <div class="mb-3">
            <label for="naziv_narocnika" class="form-label">Naziv naročnika</label>
            <input type="text" id="naziv_narocnika" name="naziv_narocnika" class="form-control" value="<?= $cenitev->naziv_narocnika ?>" required>
        </div>

        <div class="mb-3">
            <label for="naslov_narocnika" class="form-label">Naslov naročnika</label>
            <input type="text" id="naslov_narocnika" name="naslov_narocnika" class="form-control" value="<?= $cenitev->naslov_narocnika ?>" required>
        </div>

        <div class="mb-3">
            <label for="namen_id" class="form-label">Namen cenitve</label>
            <select id="namen_id" name="namen_id" class="form-select" required>
                <option value="">-- Izberite namen --</option>
                <?php foreach($nameni as $namen): ?>
                    <option value="<?= $namen->id ?>" <?= $namen->id == $cenitev->namen_id ? 'selected' : '' ?>><?= $namen->naziv ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="podlaga_id" class="form-label">Podlaga vrednosti</label>
            <select id="podlaga_id" name="podlaga_id" class="form-select" required>
                <option value="">-- Izberite podlago --</option>
                <?php foreach($podlage as $podlaga): ?>
                    <option value="<?= $podlaga->id ?>" <?= $podlaga->id == $cenitev->podlaga_id ? 'selected' : '' ?>><?= $podlaga->naziv ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="premisa_id" class="form-label">Premisa vrednosti</label>
            <select id="premisa_id" name="premisa_id" class="form-select" required>
                <option value="">-- Izberite premiso --</option>
                <?php foreach($premise as $premisa): ?>
                    <option value="<?= $premisa->id ?>" <?= $premisa->id == $cenitev->premisa_id ? 'selected' : '' ?>><?= $premisa->naziv ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="prvi_ogled" class="form-label">Prvi ogled</label>
            <input type="datetime-local" id="prvi_ogled" name="prvi_ogled" class="form-control" value="<?= $cenitev->prvi_ogled ?>" required>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Shrani spremembe</button>
        </div>

    </form>

    <?php if(isset($napaka)): ?>
        <p class="text-danger mt-3"><?= $napaka ?></p>
    <?php endif; ?>
</div>