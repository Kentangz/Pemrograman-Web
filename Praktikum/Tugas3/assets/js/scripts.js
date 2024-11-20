// Fungsi untuk mengambil data buku dari API dan menampilkannya di halaman
async function fetchBooks() {
    try {
        const response = await fetch('http://localhost:8000/api/book');  // Ganti dengan URL API backend Anda
        const data = await response.json();

        if (data.code === 200) {
            displayBooks(data.data);  // Panggil fungsi untuk menampilkan buku
        } else {
            console.log('Error fetching books:', data.message);
        }
    } catch (error) {
        console.error('Error fetching books:', error);
    }
}

// Fungsi untuk menampilkan buku di halaman
function displayBooks(books) {
    const bookList = document.getElementById('book-list');  // Pastikan ada elemen dengan ID 'book-list'
    bookList.innerHTML = '';  // Reset tampilan sebelumnya

    // Iterasi untuk menampilkan setiap buku
    books.forEach(book => {
        const bookItem = document.createElement('div');
        bookItem.classList.add('book-card'); // Pastikan menggunakan class 'book-card' sesuai dengan CSS Anda

        // HTML untuk setiap buku
        bookItem.innerHTML = `
            <img src="${book.image}" alt="${book.book_name}" class="book-image" />
            <div class="book-info">
                <h3>${book.book_name}</h3>
                <p class="author">${book.creator}</p>
                <p class="price">Rp ${book.price}</p>
                <p class="description">${book.description}</p>
            </div>
        `;

        // Tambahkan elemen buku ke dalam daftar
        bookList.appendChild(bookItem);
    });
}

// Pencarian Buku berdasarkan input
const searchInput = document.getElementById('search-input');
const searchButton = document.querySelector('.search-btn');

// Fungsi untuk memfilter buku berdasarkan input pencarian
function searchBooks() {
    const searchText = searchInput.value.toLowerCase();
    const bookCards = document.querySelectorAll('.book-card');  // Mengambil semua elemen dengan class 'book-card'

    bookCards.forEach(book => {
        const bookTitle = book.querySelector('h3').textContent.toLowerCase();
        const bookDescription = book.querySelector('.description').textContent.toLowerCase();

        if (bookTitle.includes(searchText) || bookDescription.includes(searchText)) {
            book.style.display = 'flex'; // Tampilkan buku
        } else {
            book.style.display = 'none'; // Sembunyikan buku
        }
    });
}

// Event listener untuk tombol pencarian
searchButton.addEventListener('click', () => {
    searchBooks();
});

// Event listener untuk pencarian dengan tombol Enter
searchInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        searchBooks();
    }
});

// Panggil fungsi fetchBooks saat halaman dimuat
window.onload = function() {
    fetchBooks();
}
