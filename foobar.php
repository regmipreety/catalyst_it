<?php
for ($i = 1; $i <= 100; $i++) {
    if ($i % 3 == 0 && $i % 5 == 0) {
        echo "foobar\n";
    } elseif ($i % 3 == 0) {
        echo "foo\n";
    } elseif ($i % 5 == 0) {
        echo "bar\n";
    } else {
        echo $i . "\n";
    }
}
?>