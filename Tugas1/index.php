<?php
// Including the necessary files
require_once 'Book.php';
require_once 'Novel.php';

// Using namespaces
use MyLibrary\Genres\Novel;

// Instantiating the Novel class
$book = new Novel("To Kill a Mockingbird", "Harper Lee", "Fiction");

// Displaying book details
echo $book->getSummary();
echo "<br>";
echo $book->displayAuthor();
echo "<br>";
echo $book;
?>
