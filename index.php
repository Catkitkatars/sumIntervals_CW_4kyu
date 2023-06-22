<?php 
// Write a function called sumIntervals/sum_intervals that accepts an array of intervals, 
// and returns the sum of all the interval lengths. Overlapping intervals should only be counted once.

// Intervals
// Intervals are represented by a pair of integers in the form of an array. The first value of the interval 
// will always be less than the second value. Interval example: [1, 5] is an interval from 1 to 5. The length of this interval is 4.

// Overlapping Intervals
// List containing overlapping intervals:

// [
//    [1, 4],
//    [7, 10],
//    [3, 5]
// ]
// The sum of the lengths of these intervals is 7. Since [1, 4] and [3, 5] overlap, 
// we can treat the interval as [1, 5], which has a length of 4.




// Напишите функцию с именем sum Intervals/some_intervals, которая принимает массив интервалов
// и возвращает сумму всех длин интервалов. Перекрывающиеся интервалы следует подсчитывать только один раз.

// Интервалы
// Интервалы представлены парой целых чисел в виде массива. Первое значение интервала всегда будет меньше второго значения.
// Пример интервала: [1, 5] - это интервал от 1 до 5. Длина этого интервала равна 4.

// [
//    [1, 4],
//    [7, 10],
//    [3, 5]
// ]

// Сумма длин этих интервалов равна 7. Поскольку [1, 4] и [3, 5] перекрываются, 
// мы можем рассматривать интервал как [1, 5], длина которого равна 4.


function sum_intervals(array $intervals) {
    $sum = 0;

    foreach($intervals as $key => &$value) {
        if($intervals[$key] == 'A') {
            continue;
        }
        foreach($intervals as $key2 => $value2) {
            if($intervals[$key2] == 'A') {
                continue;
            }
            if($key == $key2){
                continue;
            }
            if($intervals[$key][0] <= $intervals[$key2][0] && $intervals[$key][1] >= $intervals[$key2][0]) {
                if ($intervals[$key][1] >= $intervals[$key2][1]) {
                    array_push($intervals, [$intervals[$key][0], $intervals[$key][1]]);
                }
                else
                {
                    array_push($intervals, [$intervals[$key][0], $intervals[$key2][1]]);
                }
                $intervals[$key] = 'A';
                $intervals[$key2] = 'A';

            }
            if($intervals[$key2] == 'A') {
                continue;
            }
            if($intervals[$key][0] >= $intervals[$key2][0] && $intervals[$key][0] <= $intervals[$key2][1]){
                if($intervals[$key][1] >= $intervals[$key2][1]) {
                    array_push($intervals, [$intervals[$key2][0], $intervals[$key][1]]);
                } 
                else 
                {
                    array_push($intervals, [$intervals[$key2][0], $intervals[$key2][1]]);
                }
                $intervals[$key] = 'A';
                $intervals[$key2] = 'A';

            }
        }
    }
    unset($value);

    foreach($intervals as $key => $value) {
        if($intervals[$key] != 'A'){
            $sum += $intervals[$key][1] - $intervals[$key][0];
        }
        else
        {
            continue;
        }
    }
    return $sum;
}

$i = [[1, 6], [7, 8], [10, 12]]; // 8

$i2 = [[1, 4], [3, 5]]; // 4

$i3 = [[1, 4], [3, 5], [10, 12]]; // 6

$i4 = [[1,5],[10,20],[1,6],[16,19],[5,11]]; // 19

$i5 = [[0, 20], [-100000000, 10], [30, 40]]; // 100000030

var_dump(sum_intervals($i5));


// Best Practices

// function sum_intervals(array $intervals): int
// {
//     usort($intervals, function($a, $b) { return $a[0] - $b[0]; });
//     $top = -INF;
//     $cnt = 0;
//     foreach ($intervals as list($from, $to)) {
//         $local_from = max($from, $top);
//         if ($to > $local_from) {
//             $cnt += $to - $local_from;
//             $top = $to;
//         }
//     }
//     return $cnt;
// }
