function hitung() {
    const bil1 = document.getElementById("bilangan1").value;
    const bil2 = document.getElementById("bilangan2").value;
    const hasil = parseFloat(bil1) + parseFloat(bil2);
    document.getElementById("hasil").textContent = hasil;
}

function reset() {
    document.getElementById("bilangan1").value = '';
    document.getElementById("bilangan2").value = '';
    document.getElementById("hasil").textContent = '0';
}