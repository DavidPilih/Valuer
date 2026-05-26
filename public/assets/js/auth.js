const staro_geslo = document.getElementById('staro_geslo');
const novo_geslo = document.getElementById('novo_geslo');
const ponovno_geslo = document.getElementById('ponovno_geslo');
const geslo_napaka = document.getElementById('geslo_napaka');
const ponovitev_napaka = document.getElementById('ponovitev_napaka');
const gumb_potrdi = document.getElementById('gumb_potrdi');

if (novo_geslo) {
    novo_geslo.addEventListener('input', preveri);
    ponovno_geslo.addEventListener('input', preveri);
}

function preveri() {
    const napaka = validirajGeslo(novo_geslo.value);
    const ujemanje = novo_geslo.value === ponovno_geslo.value;

    if (novo_geslo.value.length > 0 && napaka) {
        geslo_napaka.textContent = napaka;
        geslo_napaka.style.display = 'block';
    } else {
        geslo_napaka.style.display = 'none';
    }

    if (ponovno_geslo.value.length > 0 && !ujemanje) {
        ponovitev_napaka.textContent = 'Gesli se ne ujemata.';
        ponovitev_napaka.style.display = 'block';
    } else {
        ponovitev_napaka.style.display = 'none';
    }

    gumb_potrdi.disabled = !(!napaka && ujemanje && ponovno_geslo.value.length > 0);
}

function preveri_ujemanje_gesl() {
    const ujemanje = novo_geslo.value === ponovno_geslo.value;

    if (ponovno_geslo.value.length > 0 && !ujemanje) {
        ponovitev_napaka.textContent = 'Gesli se ne ujemata.';
        ponovitev_napaka.style.display = 'block';
    } else {
        ponovitev_napaka.style.display = 'none';
    }

    posodobiGumb();
}

function posodobiGumb() {
    const napaka = validirajGeslo(novo_geslo.value);
    const ujemanje = novo_geslo.value === ponovno_geslo.value;

    gumb_potrdi.disabled = !(!napaka && ujemanje && ponovno_geslo.value.length > 0);
}

function validirajGeslo(geslo) {
    if (geslo.length < 8 || geslo.length > 20) return 'Geslo mora biti dolgo 8–20 znakov.';
    if (!/[a-zA-Z]/.test(geslo)) return 'Geslo mora vsebovati črke.';
    if (!/[0-9]/.test(geslo)) return 'Geslo mora vsebovati številke.';
    if (/[\s]/.test(geslo)) return 'Geslo ne sme vsebovati presledkov.';
    if (/[^a-zA-Z0-9]/.test(geslo)) return 'Geslo ne sme vsebovati posebnih znakov.';
    return null;
}

