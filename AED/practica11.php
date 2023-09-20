<?php
$var = "";
if (empty($var)) { // true because "" is considered empty
    echo '<br>empty($var) para $var="" ';
} else {
    echo '<br>!empty($var) para $var="" ';
}
if (isset($var)) { //true because var is set
    echo '<br>isset($var) para $var="" ';
} else {
    echo '<br> !isset($var) para $var="" ';
}
if (empty($otherVar)) { //true because $otherVar is null
    echo '<br>empty($otherVar) para $otherVar que no se ha establecido ';
} else {
    echo '<br> !empty($otherVar) para $otherVar que no se ha establecido ';
}
if (isset($otherVar)) { //false because $otherVar is not set
    echo '<br>isset($otherVar) para $otherVar que no se ha establecido ';
} else {
    echo '<br> !isset($otherVar) para $otherVar que no se ha establecido ';
}
?>