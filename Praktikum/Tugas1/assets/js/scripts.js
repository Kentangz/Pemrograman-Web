// Search functionality for books
const searchInput = document.getElementById('search-input');
const searchButton = document.querySelector('.search-btn');
const bookCards = document.querySelectorAll('.book-card');

// Function to filter books based on the search input
function searchBooks() {
    const searchText = searchInput.value.toLowerCase();

    bookCards.forEach(book => {
        const bookTitle = book.querySelector('h3').textContent.toLowerCase();


        if (bookTitle.includes(searchText)) {
            book.style.display = 'flex'; // Show book card
        } else {
            book.style.display = 'none'; // Hide book card
        }
    });
}

// Event listener for the search button
searchButton.addEventListener('click', () => {
    searchBooks();
});

// Event listener for pressing Enter key to search
searchInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        searchBooks();
    }
});


