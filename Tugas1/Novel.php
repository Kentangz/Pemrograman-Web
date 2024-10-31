<?php
// Namespace declaration for the Novel class
namespace MyLibrary\Genres;

// Importing the necessary classes and traits
use MyLibrary\Base\Book;

// Trait for displaying author information
trait AuthorInfo {
    public function displayAuthor() {
        return "Author: " . $this->author;
    }
}

// Class for a specific type of book
class Novel extends Book {
    use AuthorInfo;

    private $genre;

    public function __construct($title, $author, $genre) {
        parent::__construct($title, $author);
        $this->genre = $genre;
    }

    // Magic method __toString to display book information
    public function __toString() {
        return "Title: " . $this->title . ", Genre: " . $this->genre;
    }

    public function getSummary() {
        return "This book, titled '{$this->title}', is a {$this->genre} novel.";
    }
}
?>
