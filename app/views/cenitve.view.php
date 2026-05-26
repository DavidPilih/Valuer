<script src="/assets/js/cenitve.js" defer></script>
<div class="ms-3 me-3">

    <?php if (isset($izbrisane)): ?>
        <h2 id="kos_cenitev">Koš cenitev</h2>
    <?php else: ?>
        <h2>Cenitve</h2>
    <?php endif ?>

    <div class="text-end mb-2">
        <button class="btn btn-primary" onclick="filterToogle()">
            <i class="bi bi-funnel"></i> Filtri
        </button>
        <?php if (isset($izbrisane)): ?>
            <button id="gumb_zbrisi_cenitve" class="btn btn-danger ms-1" disabled onclick="odpriDeleteModal('vec')">Trajno izbriši cenitve</button>
        <?php else: ?>
            <a href="/cenitve/dodajCenitev" class="btn btn-success">Dodaj cenitev</a>
            <button id="gumb_zbrisi_cenitve" class="btn btn-danger ms-1" disabled onclick="odpriDeleteModal('vec')">Izbriši cenitve</button>
            <a href="/cenitve/izbrisaneCenitve" class="btn btn-info">Koš cenitev</a>
        <?php endif ?>
    </div>

    <div id="filtri" style="display: none;">
        <div class="row mb-3">
            <div class="col-md-3">
                <input type="text" id="filter_naziv" class="form-control" placeholder="Išči naziv naročnika...">
            </div>
            <div class="col-md-2">
                <select id="filter_namen" class="form-select">
                    <option value="">Vsi nameni</option>
                    <?php foreach ($nameni as $namen): ?>
                        <option value="<?= $namen->naziv ?>"><?= $namen->naziv ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <select id="filter_podlaga" class="form-select">
                    <option value="">Vse podlage</option>
                    <?php foreach ($podlage as $podlaga): ?>
                        <option value="<?= $podlaga->naziv ?>"><?= $podlaga->naziv ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <select id="filter_premisa" class="form-select">
                    <option value="">Vse premise</option>
                    <?php foreach ($premise as $premisa): ?>
                        <option value="<?= $premisa->naziv ?>"><?= $premisa->naziv ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <select id="filter_uporabnik" class="form-select">
                    <option value="">Vsi uporabniki</option>
                    <?php foreach ($uporabniki as $uporabnik): ?>
                        <option value="<?= $uporabnik->ime . ' ' . $uporabnik->priimek ?>">
                            <?= $uporabnik->ime ?> <?= $uporabnik->priimek ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-1">
                <button class="btn btn-secondary w-100" onclick="resetFiltre()">Ponastavi</button>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3">
                <label class="form-label">Datum od:</label>
                <input type="date" id="filter_datum_od" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label">Datum do:</label>
                <input type="date" id="filter_datum_do" class="form-control">
            </div>
        </div>
    </div>

    <table class="table table-light table-striped table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col"></th>
                <th scope="col" class="sortable" data-col="1" style="cursor:pointer">Naziv naročnika <i class="bi bi-arrow-down-up"></i></th>
                <th scope="col" class="sortable" data-col="2" style="cursor:pointer">Naslov naročnika <i class="bi bi-arrow-down-up"></i></th>
                <th scope="col" class="sortable" data-col="3" style="cursor:pointer">Prvi ogled <i class="bi bi-arrow-down-up"></i></th>
                <th scope="col" class="sortable" data-col="4" style="cursor:pointer">Namen <i class="bi bi-arrow-down-up"></i></th>
                <th scope="col" class="sortable" data-col="5" style="cursor:pointer">Podlaga <i class="bi bi-arrow-down-up"></i></th>
                <th scope="col" class="sortable" data-col="6" style="cursor:pointer">Premisa <i class="bi bi-arrow-down-up"></i></th>
                <th scope="col" class="sortable" data-col="7" style="cursor:pointer">Uporabnik <i class="bi bi-arrow-down-up"></i></th>
                <th scope="col">Akcije</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cenitve as $cenitev): ?>
                <tr id="cenitev-<?= $cenitev->id ?>" style="cursor:pointer;" onclick="odpriCenitev(<?= $cenitev->id ?>)">

                    <td onclick="event.stopPropagation()" style="cursor: default;">
                        <input type="checkbox" name="izbrana_cenitev" value="<?= $cenitev->id ?>" style="width: 15px; height: 15px;">
                    </td>

                    <td><?= $cenitev->naziv_narocnika ?></td>
                    <td><?= $cenitev->naslov_narocnika ?></td>
                    <td><?= date('d.m.Y H:i', strtotime($cenitev->prvi_ogled)) ?></td>
                    <td><?= $cenitev->namen_naziv ?></td>
                    <td><?= $cenitev->podlaga_naziv ?></td>
                    <td><?= $cenitev->premisa_naziv ?></td>
                    <td><?= $cenitev->uporabnik_ime ?> <?= $cenitev->uporabnik_priimek ?></td>

                    <td onclick="event.stopPropagation()" style="cursor: default;">
                        <?php if (isset($izbrisane)): ?>
                            <button class="btn btn-sm btn-success ms-1" onclick="obnoviCenitev(<?= $cenitev->id ?>)">
                                <i class="bi bi-arrow-counterclockwise"></i> Obnovi
                            </button>
                            <button class="btn btn-sm btn-danger ms-1" onclick="odpriDeleteModal(<?= $cenitev->id ?>)">
                                <i class="bi bi-trash"></i> Trajno izbriši
                            </button>
                        <?php else: ?>
                            <a href="/cenitve/urediCenitev/<?= $cenitev->id ?>" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> Uredi
                            </a>
                            <button class="btn btn-sm btn-danger ms-1" onclick="odpriDeleteModal(<?= $cenitev->id ?>)">
                                <i class="bi bi-trash"></i> Izbriši
                            </button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Potrditev brisanja</h5>
            </div>
            <div class="modal-body">
                <?php if (isset($izbrisane)): ?>
                    Ali ste prepričani, da želite trajno izbrisati cenitev?
                <?php else: ?>
                    Ali ste prepričani, da želite izbrisati cenitev?
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Prekliči</button>
                <a id="confirmDeleteBtn" href="#" class="btn btn-danger">Izbriši</a>
            </div>
        </div>
    </div>
</div>