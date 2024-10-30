<?php
$height = 5;
for ($i = 1; $i <= $height; $i++) {

    for ($j = $i; $j < $height; $j++) {
        echo "&nbsp;&nbsp;";
    }
    for ($k = 1; $k <= (2 * $i - 1); $k++) {
        echo "*";
    }
    echo "<br>";
}
?>
