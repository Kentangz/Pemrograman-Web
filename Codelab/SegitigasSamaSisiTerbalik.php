<?php
$height = 5;

for ($i = $height; $i >= 1; $i--) {
    for ($j = $height; $j > $i; $j--) {
        echo "&nbsp;&nbsp;";
    }
    for ($k = 1; $k <= (2 * $i - 1); $k++) {
        echo "*";
    }
    echo "<br>";
}
?>
