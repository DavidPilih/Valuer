<script src="/assets/js/cenitve.js" defer></script>
<div class="ms-3 me-3">
    <?php if (isset($izbrisane)): ?>
        <h2 id="kos_cenitev">Koš cenitev</h2>
    <?php else: ?>
        <h2>Cenitve</h2>
    <?php endif ?>
    <div class="text-end mb-2">
        <?php if (isset($izbrisane)): ?>
            <button id="gumb_zbrisi_cenitve" class="btn btn-danger ms-1" disabled onclick="brisiCenitve()">Trajno izbriši
                cenitve</button>
        <?php else: ?>
            <a href="/cenitve/dodajCenitev" class="btn btn-success">Dodaj cenitev</a>
            <button id="gumb_zbrisi_cenitve" class="btn btn-danger ms-1" disabled onclick="brisiCenitve()">Izbriši
                cenitve</button>
            <a href="/cenitve/izbrisaneCenitve" class="btn btn-info">Koš cenitev</a>
        <?php endif ?>

    </div>
    <table class="table table-light table-striped table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col"></th>
                <th scope="col">Naziv naročnika</th>
                <th scope="col">Naslov naročnika</th>
                <th scope="col">Prvi ogled</th>
                <th scope="col">Namen</th>
                <th scope="col">Podlaga</th>
                <th scope="col">Premisa</th>
                <th scope="col">Uporabnik</th>
                <th scope="col">Akcije</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cenitve as $cenitev): ?>
                <tr id="cenitev-<?= $cenitev->id ?>">
                    <td class="text-center">
                        <input type="checkbox" name="izbrana_cenitev" value="<?= $cenitev->id ?>"
                            style="width: 15px; height: 15px;">
                    </td>
                    <td><?= $cenitev->naziv_narocnika ?></td>
                    <td><?= $cenitev->naslov_narocnika ?></td>
                    <td><?= date('d.m.Y H:i', strtotime($cenitev->prvi_ogled)) ?></td>
                    <td><?= $cenitev->namen_naziv ?></td>
                    <td><?= $cenitev->podlaga_naziv ?></td>
                    <td><?= $cenitev->premisa_naziv ?></td>
                    <td><?= $cenitev->uporabnik_ime ?>     <?= $cenitev->uporabnik_priimek ?></td>
                    <?php if (isset($izbrisane)): ?>
                        <td>
                            <button class="btn btn-sm btn-success ms-1" onclick="obnoviCenitev(<?= $cenitev->id ?>)">
                                <i>Obonvi</i>
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </button>
                            <button class="btn btn-sm btn-danger ms-1" onclick="brisiCenitev(<?= $cenitev->id ?>)">
                                <i>Trajno izbrisi </i>
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    <?php else: ?>
                        <td class="text-center">
                            <a href="/cenitve/urediCenitev/<?= $cenitev->id ?>" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button class="btn btn-sm btn-danger ms-1" onclick="brisiCenitev(<?= $cenitev->id ?>)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    <?php endif ?>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>