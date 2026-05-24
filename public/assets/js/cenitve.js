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


        gumb_zbrisi_cenitve.disabled = (stevilo>0)? false : true;
        gumb_zbrisi_cenitve.textContent = (kos_cenitev) ? "Trajno izbriši cenitve" : "Izbriši cenitve";
        gumb_zbrisi_cenitve.textContent+= (stevilo>0)? " (" + stevilo + ")": "";
    }
document.addEventListener('DOMContentLoaded', function() {
    const checkboxi = document.querySelectorAll('input[name="izbrana_cenitev"]');
    checkboxi.forEach(function(cb) {
        cb.addEventListener('change', posodobiGumb);
    });
});

async function brisiCenitve() {
    const oznaceni = document.querySelectorAll('input[name="izbrana_cenitev"]:checked');
    const zaIzbris = [];
    oznaceni.forEach(function (oz) {
        zaIzbris.push(oz.value);
    })
        const trajnoIzbrisi = (kos_cenitev)? true: false;

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