<?php
require_once 'Book.php';
require_once 'Novel.php';

use MyLibrary\Genres\Novel;


$book = new Novel("Harry Potter", "fffufa", "Fiction");

echo $book->getSummary();
echo "<br>";
echo $book->displayAuthor();
echo "<br>";
echo $book;
?>
