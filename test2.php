<?php
/**
 * Написать функцию которая из этого массива
 */
$data1 = [
    'parent.child.field' => 1,
    'parent.child.field2' => 2,
    'parent2.child.name' => 'test',
    'parent2.child2.name' => 'test',
    'parent2.child2.position' => 10,
    'parent3.child3.position' => 10,
];

//сделает такой и наоборот
$data = [
    'parent' => [
        'child' => [
            'field' => 1,
            'field2' => 2,
        ]
    ],
    'parent2' => [
        'child' => [
            'name' => 'test'
        ],
        'child2' => [
            'name' => 'test',
            'position' => 10
        ]
    ],
    'parent3' => [
        'child3' => [
            'position' => 10
        ]
    ],
];


// $data1 -> $data
/**
 * @param array $data
 * @return array
 */
function custom_decode (array $data) {
    $result = [];
    foreach ($data AS $keys => $value) {
        $keys_arr = explode('.', $keys);
        $a = &$result;
        foreach ($keys_arr AS $key) {
            if (!isset($a[$key])) {
                $a[$key] = [];
            }
            $a = &$a[$key];
        }
        $a = $value;
    }
    return $result;
}

// $data -> $data1
/**
 * @param $data
 * @param string $prefix
 * @return array
 */
function custom_encode ($data, $prefix = '') {
    $result = [];

    foreach ($data AS $k => $v) {
        $prefix_next = '';
        if ($prefix) {
            $prefix_next = $prefix . '.';
        }
        $prefix_next .= $k;
        if (is_array($v)) {
            $result += custom_encode($v, $prefix_next);
        } else {
            $result[$prefix_next] = $v;
        }
    }

    return $result;
}

print_r(custom_decode($data1));
print_r(custom_encode($data));