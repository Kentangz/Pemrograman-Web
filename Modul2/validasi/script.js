function validasi() {
    const nama = document.getElementById("nama").value.trim();
    const email = document.getElementById("email").value.trim();
    const alamat = document.getElementById("alamat").value.trim();

    if (nama === "") {
        alert("Nama harus diisi.");
    } else if (email === "") {
        alert("Email harus diisi.");
    } else if (alamat === "") {
        alert("Alamat harus diisi.");
    } else {
        alert("Pendaftaran berhasil!");
    }
}
