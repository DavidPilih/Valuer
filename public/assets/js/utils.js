if (typeof napaka !== "undefined") {
    toast_napaka(napaka);

}

if (typeof uspeh !== "undefined") {
    toast_uspeh(uspeh);
}
console.log("Nkeja00");


function toast_uspeh(uspeh) {
    Toastify({
        text: uspeh,
        duration: 1500,
        gravity: "top",
        position: "center",
        offset: { y: 80 },
        style: {
            background: "#22bb33",
            fontSize: "1.1rem",
            padding: "16px 28px",
            borderRadius: "20px"
        }
    }).showToast();
}

function toast_napaka(napaka) {
    Toastify({
        text: napaka,
        duration: 1500,
        gravity: "top",
        position: "center",
        offset: { y: 80 },
        style: {
            background: "#e74c3c",
            fontSize: "1.1rem",
            padding: "16px 28px",
            borderRadius: "20px"
        }
    }).showToast();
}