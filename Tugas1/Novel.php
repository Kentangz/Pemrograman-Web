<?php
namespace MyLibrary\Genres;
use MyLibrary\Base\Book;


trait AuthorInfo {
    public function displayAuthor() {
        return "Author: " . $this->author;
    }
}

class Novel extends Book {
    use AuthorInfo;

    private $genre;

    public function __construct($title, $author, $genre) {
        parent::__construct($title, $author);
        $this->genre = $genre;
    }

    public function __toString() {
        return "Title: " . $this->title . ", Genre: " . $this->genre;
    }

    public function getSummary() {
        return "This book, titled '{$this->title}', is a {$this->genre} novel.";
    }
}
?>
