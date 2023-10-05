<?php
$arr = array(1, 2, 3, 4);
foreach ($arr as &$val) {
    $val = $val * 2;
}
foreach ($arr as $key => $val) {
    echo "{$key} => {$val} <br>";
    print_r($arr);
    echo "<br><br>";
}
?>