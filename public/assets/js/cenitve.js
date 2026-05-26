const kos_cenitev = document.getElementById('kos_cenitev');
async function brisiCenitev(id) {
    const url = kos_cenitev ? `/cenitve/trajnoBrisiCenitev/${id}` : `/cenitve/brisiCenitev/${id}`;

    const response = await fetch(url, { method: 'DELETE' });
    const data = await response.json();

    if (data.success) {
        document.getElementById(`cenitev-${id}`).remove();
        posodobiGumb();
    }
}
async function brisiCenitve() {
    const oznaceni = document.querySelectorAll('input[name="izbrana_cenitev"]:checked');
    const zaIzbris = [];
    oznaceni.forEach(function (oz) {
        zaIzbris.push(oz.value);
    })
    const trajnoIzbrisi = (kos_cenitev) ? true : false;

    const response = await fetch('/cenitve/brisiCenitve', {

        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ zaIzbris: zaIzbris, trajnoIzbrisi: trajnoIzbrisi })
    });

    const data = await response.json();

    if (data.success) {
        zaIzbris.forEach(function (id) {
            document.getElementById(`cenitev-${id}`).remove();
        });
        gumb_zbrisi_cenitve.textContent = (kos_cenitev) ? "Trajno izbriši" : "Izbriši";
        gumb_zbrisi_cenitve.disabled = true;
    }
}
async function obnoviCenitev(id) {
    console.log("obnavljanje");

    const response = await fetch(`/cenitve/obnoviCenitev/${id}`, {
        method: 'PATCH'
    });
    const data = await response.json();
    console.log(response);

    if (data.success) {
        document.getElementById(`cenitev-${id}`).remove();
        posodobiGumb();
        toast_uspeh("Cenitev je bila obnovljena")
    }
}
const gumb_zbrisi_cenitve = document.getElementById('gumb_zbrisi_cenitve');
const checkboxi = document.querySelectorAll('input[name="izbrana_cenitev"]');

function posodobiGumb() {
    const oznaceni = document.querySelectorAll('input[name="izbrana_cenitev"]:checked');
    const stevilo = oznaceni.length;
    checkboxi.forEach(function (cb) {
        cb.closest('tr').classList.remove('table-danger');
    });

    oznaceni.forEach(function (cb) {
        cb.closest('tr').classList.add('table-danger');
    });


    gumb_zbrisi_cenitve.disabled = (stevilo > 0) ? false : true;
    gumb_zbrisi_cenitve.textContent = (kos_cenitev) ? "Trajno izbriši cenitve" : "Izbriši cenitve";
    gumb_zbrisi_cenitve.textContent += (stevilo > 0) ? " (" + stevilo + ")" : "";
}
document.addEventListener('DOMContentLoaded', function () {
    const checkboxi = document.querySelectorAll('input[name="izbrana_cenitev"]');
    checkboxi.forEach(function (cb) {
        cb.addEventListener('change', posodobiGumb);
    });
});

function odpriDeleteModal(id) {
    const btn = document.getElementById("confirmDeleteBtn");
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    if(id=='vec'){
    btn.onclick = async () => {
        await brisiCenitve(id);
        modal.hide();
        if(kos_cenitev) toast_uspeh("Cenitve so bile trajno izbrisane")
        else toast_uspeh("Cenitve so bile premaknjene v koš")
    };
    }else{
    btn.onclick = async () => {
        await brisiCenitev(id);
        modal.hide();
        if(kos_cenitev) toast_uspeh("Cenitev je bila trajno izbrisana")
        else toast_uspeh("Cenitev je bila premaknjena v koš")
    };
}
    modal.show();
}

function odpriCenitev(id) {
    window.location = "/cenitve/cenitev/" + id;
}
function filterToogle() {
    const filtri = document.getElementById('filtri');
    filtri.style.display = filtri.style.display === 'none' ? '' : 'none';
}


const filtri = {
    naziv: '',
    namen: '',
    podlaga: '',
    premisa: '',
    uporabnik: '',
    datum_od: '',
    datum_do: ''
};

document.getElementById('filter_naziv')?.addEventListener('input', function () {
    filtri.naziv = this.value.toLowerCase();
    filtrirajVrstice();
});
document.getElementById('filter_namen')?.addEventListener('change', function () {
    filtri.namen = this.value.toLowerCase();
    filtrirajVrstice();
});
document.getElementById('filter_podlaga')?.addEventListener('change', function () {
    filtri.podlaga = this.value.toLowerCase();
    filtrirajVrstice();
});
document.getElementById('filter_premisa')?.addEventListener('change', function () {
    filtri.premisa = this.value.toLowerCase();
    filtrirajVrstice();
});
document.getElementById('filter_uporabnik')?.addEventListener('change', function () {
    filtri.uporabnik = this.value.toLowerCase();
    filtrirajVrstice();
});
document.getElementById('filter_datum_od')?.addEventListener('change', function () {
    filtri.datum_od = this.value;
    filtrirajVrstice();
});
document.getElementById('filter_datum_do')?.addEventListener('change', function () {
    filtri.datum_do = this.value;
    filtrirajVrstice();
});

function filtrirajVrstice() {
    const vrstice = document.querySelectorAll('tbody tr');

    vrstice.forEach(function (tr) {
        const naziv = tr.cells[1].textContent.toLowerCase();
        const namen = tr.cells[4].textContent.toLowerCase();
        const podlaga = tr.cells[5].textContent.toLowerCase();
        const premisa = tr.cells[6].textContent.toLowerCase();
        const uporabnik = tr.cells[7].textContent.toLowerCase();
        const datumTekst = tr.cells[3].textContent.trim(); // dd.mm.yyyy HH:ii

        const delen = datumTekst.split(' ')[0].split('.');
        const datumISO = delen.length === 3 ? `${delen[2]}-${delen[1]}-${delen[0]}` : '';

        const vidna =
            naziv.includes(filtri.naziv) &&
            namen.includes(filtri.namen) &&
            podlaga.includes(filtri.podlaga) &&
            premisa.includes(filtri.premisa) &&
            uporabnik.includes(filtri.uporabnik) &&
            (filtri.datum_od === '' || datumISO >= filtri.datum_od) &&
            (filtri.datum_do === '' || datumISO <= filtri.datum_do);

        tr.style.display = vidna ? '' : 'none';
    });
}

function resetFiltre() {
    document.getElementById('filter_naziv').value = '';
    document.getElementById('filter_namen').value = '';
    document.getElementById('filter_podlaga').value = '';
    document.getElementById('filter_premisa').value = '';
    document.getElementById('filter_uporabnik').value = '';
    document.getElementById('filter_datum_od').value = '';
    document.getElementById('filter_datum_do').value = '';
    Object.keys(filtri).forEach(k => filtri[k] = '');
    filtrirajVrstice();
}

let sortSmer = {};

document.querySelectorAll('th.sortable').forEach(function (th) {
    th.addEventListener('click', function () {
        const col = parseInt(this.dataset.col);
        sortSmer[col] = !sortSmer[col];

        const tbody = document.querySelector('tbody');
        const vrstice = Array.from(tbody.querySelectorAll('tr'));

        vrstice.sort(function (a, b) {
            const aVal = a.cells[col].textContent.trim().toLowerCase();
            const bVal = b.cells[col].textContent.trim().toLowerCase();

            if (col === 3) {
                const parseDate = (str) => {
                    const d = str.split(' ')[0].split('.');
                    return d.length === 3 ? `${d[2]}${d[1]}${d[0]}` : '';
                };
                return sortSmer[col]
                    ? parseDate(aVal).localeCompare(parseDate(bVal))
                    : parseDate(bVal).localeCompare(parseDate(aVal));
            }

            return sortSmer[col]
                ? aVal.localeCompare(bVal)
                : bVal.localeCompare(aVal);
        });

        document.querySelectorAll('th.sortable i').forEach(i => i.className = 'bi bi-arrow-down-up');
        this.querySelector('i').className = sortSmer[col] ? 'bi bi-arrow-up' : 'bi bi-arrow-down';

        vrstice.forEach(tr => tbody.appendChild(tr));
    });
});