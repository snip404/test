<?php
/**
 * Нужно написать код, который из массива выведет то что приведено ниже в комментарии.
 */
$x = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'];

/*
print_r($x) - должен выводить это:
Array
(
    [h] => Array
        (
            [g] => Array
                (
                    [f] => Array
                        (
                            [e] => Array
                                (
                                    [d] => Array
                                        (
                                            [c] => Array
                                                (
                                                    [b] => Array
                                                        (
                                                            [a] =>
                                                        )

                                                )

                                        )

                                )

                        )

                )

        )

);*/

$count = count ($x);
$tmp = [];
$a = &$tmp;

for ($i = $count - 1; $i >= 0; $i--) {
    $v = $x[$i];

    if ($i == 0) {
        $new_value = null;
    } else {
        $new_value = [];
    }

    $a[$v] = $new_value;
    $a = &$a[$v];
}

$x = $tmp;
unset ($tmp);
print_r($x);