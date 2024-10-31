<?php
// Namespace declaration for the base Book class
namespace MyLibrary\Base;

// Abstract class with abstract method
abstract class Book {
    protected $title;
    protected $author;

    public function __construct($title, $author) {
        $this->title = $title;
        $this->author = $author;
    }

    abstract public function getSummary();
}
?>
