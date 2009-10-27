<?php
// $Id$ beta 2
/**
 * Created at 2009.1.7 21:11
 * Updated at 2009.1.13
 * Version : beta 2.1
 * Author : Kelvin_gao
 *
 * 测试Interface.array.class.php 中定义的函数
 * -- php内建函数：
 * 26个单数组操作 (OK)
 * 9个多数组操作  (OK)
 * 18个回调函数相关（跳过）
 * 7个返回非数组  (OK)
 * 12个数组指针操作（跳过）
 * -- 第三方：
 * 以及10个第三方扩展数组函数 (OK)
 */
// test at 2009.1.10
include_once 'ArrayExtenderMaint.php';
echo '<style>p{color:red;font-weight:bold;}</style>';
echo '<p>由于$a -> {method()} 操作会对 $a 中的数组做出操作，因此每次只打开一个操作进行测试，防止数组受上一次操作的影响</p><hr /><hr />';
/**
 * 测试26个单数组操作：
 * 分组测试目标函数
 */
/**
 * 第一组：键操作
 * 1. array_change_key_case()
 * 2. array_chunk()
 * 3. array_flip()
 * 4. array_keys()
 * 5. array_rand()
 * 6. array_reverse()
 */
/**
 * 第二组：值操作
 * 7. array_count_values()
 * 8. array_fill()
 * 9. array_pad()
 * 10. array_pop()
 * 11. array_push()
 * 12. array_shift()
 * 13. array_slice()
 * 14. array_splice()
 * 15. array_unshift()
 * 16. array_values()
 * 17. array_unique()
 */
/** 第三组：排序操作
 * 18. asort()
 * 19. arsort()
 * 20. ksort()
 * 21. krsort()
 * 22. natort()
 * 23. natcasesort()
 * 24. rsort()
 * 25. sort()
 * 26. shuffle()
 */

/**
 * 键操作
 */
$a = array(
    'key-1-k1'=> 'layer1-v1',
    'key-1-k2'=> 'layer1-v2',
    'kEY-1-k3'=> 'layer1-v3',
    'key-1-k4'=> 'layer1-v4',
    'keY-1-k5'=> 'layer1-v5',
    'Key-1-k6'=> 'layer1-v6',
    array(
        'kEy-2-k7'=> 'layer2-v7',
        'KEy-2-k5'=> 'layer2-v2',
        array(
            'keY-3-1-k9'=> 'layer3-1-v1',
            'key-3-1-k8'=> 'layer3-1-v2',
            'key-3-1-k10'=> 'layer3-1-v3',
            'KeY-3-1-k11'=> 'layer3-1-v4',
        ),
        array(
            'key-3-2-k8'=> 'layER3-2-V2',
            'key-3-2-k1'=> 'lAyer3-2-v1',
            'KEY-3-2-k190'=> 'Layer3-2-v190',
            'key-3-2-k110'=> 'layer3-2-v110',
        ),
        'key-2-K3'=> 'layer2-v3',
        'Key-2-K4'=> 'layer2-v4',
        'key-2-K5'=> 22.01,
    ),
    'lAYER1-v7',
    -10,11,12.01,
    'key-1-k8' => 'layer1-v8',
    'key-1-K9' => 'layer1-v9',
    'kEy-1-k10' => 'layer1-v10',
    'key-1-k11' => 'layer1-v11',
);
A::extend($a);
/* 1.array_change_key_case($case = CASE_UPPER, $recursive = FALSE) */
/*
echo '<p>array_change_key_case(CASE_UPPER, FALSE)</p>';
var_dump($a -> array_change_key_case(CASE_UPPER, FALSE) -> _done());
echo '<hr />';
*/
/*
echo '<p>array_change_key_case(CASE_UPPER, TRUE)</p>';
var_dump($a -> array_change_key_case(CASE_UPPER, TRUE)  -> _done());
echo '<hr />';
*/
/*
echo '<p>array_change_key_case(CASE_LOWER, FALSE)</p>';
var_dump($a -> array_change_key_case(CASE_LOWER, FALSE) -> _done());
echo '<hr />';
*/
/*
echo '<p>array_change_key_case(CASE_LOWER, TRUE)</p>';
var_dump($a -> array_change_key_case(CASE_LOWER, TRUE)  -> _done());
echo '<hr />';
*/

/* 2.array_chunk($size) */
/*
echo '<p>array_chunk(3)</p>';
var_dump($a -> array_chunk(3) -> _done());
echo '<hr />';
*/

/* 3.array_flip($recursive = FALSE) */
/*
echo '<p>array_flip(FALSE)</p>';
var_dump($a -> array_flip(FALSE) -> _done());
echo '<hr />';
*/
/*
echo '<p>array_flip(TRUE)</p>';
var_dump($a -> array_flip(TRUE)  -> _done());
echo '<hr />';
*/

/* 4.array_keys($recursive = FALSE) */
/*
echo '<p>array_keys(FALSE)</p>';
var_dump($a -> array_keys(FALSE) -> _done());
echo '<hr />';
*/
/*
echo '<p>array_keys(TRUE)</p>';
var_dump($a -> array_keys(TRUE)  -> _done());
echo '<hr />';
*/

/* 5.array_rand($number, $recursive = FALSE, $for = 'key') */
/*
echo '<p>array_rand(4,FALSE,"key")</p>';
var_dump($a -> array_rand(4,FALSE,"key") -> _done());
echo '<hr />';
*/
/*
echo '<p>array_rand(4,FALSE,"value")</p>';
var_dump($a -> array_rand(4,FALSE,"value") -> _done());
echo '<hr />';
*/
/*
echo '<p>array_rand(4,TRUE,"key")</p>';
var_dump($a -> array_rand(4,TRUE,"key") -> _done());
echo '<hr />';
*/
/*
echo '<p>array_rand(4,TRUE,"value")</p>';
var_dump($a -> array_rand(4,TRUE,"value") -> _done());
echo '<hr />';
*/

/* 6.array_reverse($recursive = FALSE) */
/*
echo '<p>array_reverse(FALSE)</p>';
var_dump($a -> array_reverse(FALSE) -> _done());
echo '<hr />';
*/

/*
echo '<p>array_reverse(TRUE)</p>';
var_dump($a -> array_reverse(TRUE)  -> _done());
echo '<hr />';
*/
/* --------------------------------------- 第一组 键操作 测试结束--------------------------------------------- */

/**
 * 值操作
 */
$b = array(
    1,2,3,4,'fruit'=>5,6,7,8,9,1,2,3,5,
    array(
        100,101,107,119,121,100,121,
        array(
            1010,1011,11210,1011,1119,1120,11210,78.1,78.1,
        ),
        100,121,101,107
    ),
    1,5,4,74.4,74.6,74.4,
);
A::extend($b);
/* 7.array_count_values() */ // ?  好像结果有错
/*
echo '<p>array_count_values(FALSE)</p>';
var_dump($b -> array_count_values(FALSE) -> _done());
echo '<hr />';
*/
/*
echo '<p>array_count_values(TRUE)</p>';
var_dump($b -> array_count_values(TRUE) -> _done());
echo '<hr />';
*/

/* 8.array_fill($start_index, $num, $value) */
/*
echo '<p>array_fill(4,7,"go !")</p>';
var_dump($b -> array_fill(4,7,"go !") -> _done());
echo '<hr />';
*/

/* 9.array_pad() */
/*
echo '<p>array_pad(27, "Sindy")</p>';
var_dump($b -> array_pad(27, "Sindy") -> _done());
echo '<hr />';
*/

/* 10.array_pop($times = 1) */
/*
echo '<p>array_pop(3)</p>';
var_dump($b -> array_pop(3) -> _done());
echo '<hr />';
*/

/* 11.array_push() */
/*
echo '<p>array_push("I am a string", array("I am in AN Array", "Array 2"), 90)</p>';
var_dump($b -> array_push("I am a string", array("I am in AN Array", "Array 2"), 90) -> _done());
echo '<hr />';
*/

/* 12.array_shift($times = 1) */
/*
echo '<p>array_shift(3)</p>';
var_dump($b -> array_shift(3) -> _done());
echo '<hr />';
*/

/* 13.array_slice($offset, $length, $preserve_keys = FALSE) */
/*
echo '<p>array_slice(3,2,FALSE)</p>';
var_dump($b -> array_slice(3,2, FALSE) -> _done());
echo '<hr />';
*/
/*
echo '<p>array_slice(3,2,TRUE)</p>';
var_dump($b -> array_slice(3,2, TRUE) -> _done());
echo '<hr />';
*/

/* 14.array_splice($offset, $length, $replacement = NULL) */
/*
echo '<p>array_splice(3,2,array(999999,"COOL", array("right", "wrong"), "HONg !!"))</p>';
var_dump($b -> array_splice(3,2,array(999999,"COOL", array("right", "wrong"), "HONg !!")) -> _done());
echo '<hr />';
*/

/* 15.array_unshift() */
/*
echo '<p>array_unshift("I am a string", array("I am in AN Array", "Array 2"), 90)</p>';
var_dump($b -> array_unshift("I am a string", array("I am in AN Array", "Array 2"), 90) -> _done());
echo '<hr />';
*/

/* 16.array_values($recursive = FALSE, $unique = FALSE) */
/*
echo '<p>array_values(FALSE, FALSE)</p>';
var_dump($b -> array_values(FALSE, FALSE) -> _done());
echo '<hr />';
*/
/*
echo '<p>array_values(TRUE, FALSE)</p>';
var_dump($b -> array_values(TRUE, FALSE) -> _done());
echo '<hr />';
*/
/*
echo '<p>array_values(TRUE, TRUE)</p>';
var_dump($b -> array_values(TRUE, TRUE) -> _done());
echo '<hr />';
*/

/* 17.array_unique($recursive = FALSE) */
/*
echo '<p>array_unique(FALSE)</p>';
var_dump($b -> array_unique(FALSE) -> _done());
echo '<hr />';
*/
/*
echo '<p>array_unique(TRUE)</p>';
var_dump($b -> array_unique(TRUE) -> _done());
echo '<hr />';
*/
/* --------------------------------------- 第二组 值操作 测试结束--------------------------------------------- */

/**
 * 排序操作
 */
$c = array(
    'galleryQ' => array(
        'Go' => array(
            'img02.png',
            'img04.png',
            'img01.png',
            'img04.png',
            'img08.png',
            'img09.png',
            'img10.png',
            'img11.png',
            'img14.png',
            'img19.png',
        ),
        'Gf' => array(
            'photo01.png',
            'photo03.png',
            'photo05.png',
            'photo02.png',
            'photo08.png',
            'photo09.png',
            'photo19.png',
            'photo13.png',
            'photo14.png',
        ),
    ),
    'galleryM' => array(
        'h9' => array(
            'pimg01.png',
            'pimg02.png',
            'pimg03.png',
            'pimg06.png',
            'pimg08.png',
            'pimg09.png',
            'pimg20.png',
            'pimg21.png',
            'pimg24.png',
            'pimg19.png',
        ),
        'h82' => array(
            'jphoto01.png',
            'jphoto03.png',
            'jphoto05.png',
            'jphoto47.png',
            'jphoto58.png',
            'jphoto09.png',
            'jphoto91.png',
            'jphoto93.png',
            'jphoto14.png',
        ),
    ),
);
A::extend($c);
/* 18.asort($recursive = FALSE) */
/*
echo '<p>asort(FALSE)</p>';
var_dump($c -> asort(FALSE) -> _done());
echo '<hr />';
*/
/*
echo '<p>asort(TRUE)</p>';
var_dump($c -> asort(TRUE) -> _done());
echo '<hr />';
*/

/* 19.arsort($recursive = FALSE) */
/*
echo '<p>arsort(FALSE)</p>';
var_dump($c -> arsort(FALSE) -> _done());
echo '<hr />';
*/
/*
echo '<p>arsort(TRUE)</p>';
var_dump($c -> arsort(TRUE) -> _done());
echo '<hr />';
*/

/* 20.ksort($recursive = FALSE) */
/*
echo '<p>ksort(FALSE)</p>';
var_dump($c -> ksort(FALSE) -> _done());
echo '<hr />';
*/
/*
echo '<p>ksort(TRUE)</p>';
var_dump($c -> ksort(TRUE) -> _done());
echo '<hr />';
*/

/* 21.krsort($recursive = FALSE) */
/*
echo '<p>krsort(FALSE)</p>';
var_dump($c -> krsort(FALSE) -> _done());
echo '<hr />';
*/
/*
echo '<p>krsort(TRUE)</p>';
var_dump($c -> krsort(TRUE) -> _done());
echo '<hr />';
*/

/* 22.natsort($recursive = FALSE) */
/*
echo '<p>natsort(FALSE)</p>';
var_dump($c -> natsort(FALSE) -> _done());
echo '<hr />';
*/
/*
echo '<p>natsort(TRUE)</p>';
var_dump($c -> natsort(TRUE) -> _done());
echo '<hr />';
*/

/* 23.natcasesort($recursive = FALSE) */
/*
echo '<p>natcasesort(FALSE)</p>';
var_dump($c -> natcasesort(FALSE) -> _done());
echo '<hr />';
*/
/*
echo '<p>natcasesort(TRUE)</p>';
var_dump($c -> natcasesort(TRUE) -> _done());
echo '<hr />';
*/

/* 24.rsort($recursive = FALSE) */
/*
echo '<p>rsort(FALSE)</p>';
var_dump($c -> rsort(FALSE) -> _done());
echo '<hr />';
*/
/*
echo '<p>rsort(TRUE)</p>';
var_dump($c -> rsort(TRUE) -> _done());
echo '<hr />';
*/

/* 25.sort($recursive = FALSE) */
/*
echo '<p>sort(FALSE)</p>';
var_dump($c -> sort(FALSE) -> _done());
echo '<hr />';
*/
/*
echo '<p>sort(TRUE)</p>';
var_dump($c -> sort(TRUE) -> _done());
echo '<hr />';
*/

/* 26.shuffle($recursive = FALSE) */
/*
echo '<p>shuffle(FALSE)</p>';
var_dump($c -> shuffle(FALSE) -> _done());
echo '<hr />';
*/
/*
echo '<p>shuffle(TRUE)</p>';
var_dump($c -> shuffle(TRUE) -> _done());
echo '<hr />';
*/
/* --------------------------------------- 第三组 排序操作 测试结束--------------------------------------------- */
/* --------------------------------------- 单数组操作 测试全部结束--------------------------------------------- */

/**
 * 多数组操作
 */
/**
 * 1. array_combine();
 * 2. array_diff();
 * 3. array_diff_assoc();
 * 4. array_diff_key();
 * 5. array_intersect();
 * 6. array_intersect_assoc();
 * 7. array_intersect_key();
 * 8. array_merge();
 * 9. array_merge_recursive();
 * *10.array_multisort();
 */
$Jack_fav = array(
    'computer_brand' => 'Dell',
    'fruits' => array(
        'banana','apple','lemon'
    ),
    'breakfast' => array(
        'milk','bread'
    ),
    'university' => 'Shanghai Internation Studies University',
    'motto' => 'Love is love. like is like',
    'lucky_number' => 7
);
$Kelvin_fav = array(
    'computer_brand' => 'Hp Compaq',
    'fruits' => array(
        'banana','pineapple','lemon'
    ),
    'breakfast' => array(
        'bread','soya milk'
    ),
    'university' => 'Shanghai Internation Studies University',
    'motto' => 'Love is love. like is like',
    'lucky_number' => 7,
    'slice' => 'yes, we have'
);
$key_a = array('red', 'blue' , 'yellow');
$value_a = array('sun', 'sea' , 'mood');
A::extend($Jack_fav, $Kelvin_fav, $key_a, $value_a);
/* array_combine($array_b) */
/*
echo '<p>array_combine($value_a)</p>';
var_dump($key_a -> array_combine($value_a) -> _done());
echo '<hr />';
*/

/* array_diff($array_b) */
/*
echo '<p>array_diff($Kelvin_fav)</p>';
var_dump($Jack_fav -> array_diff($Kelvin_fav) -> _done());
echo '<hr />';
*/

/* array_diff_assoc($array_b) */
/*
echo '<p>array_diff_assoc($Kelvin_fav)</p>';
var_dump($Jack_fav -> array_diff_assoc($Kelvin_fav) -> _done());
echo '<hr />';
*/

/* array_diff_key($array_b) */
/*
echo '<p>array_diff_key($Kelvin_fav)</p>';
var_dump($Jack_fav -> array_diff_key($Kelvin_fav) -> _done());
echo '<hr />';
*/

/* array_intersect($array_b) */
/*
echo '<p>array_intersect($Kelvin_fav)</p>';
var_dump($Jack_fav -> array_intersect($Kelvin_fav) -> _done());
echo '<hr />';
*/

/* array_intersect_assoc($array_b) */
/*
echo '<p>array_intersect_assoc($Kelvin_fav)</p>';
var_dump($Jack_fav -> array_intersect_assoc($Kelvin_fav) -> _done());
echo '<hr />';
*/

/* array_intersect_key($array_b) */
/*
echo '<p>array_intersect_key($Kelvin_fav)</p>';
var_dump($Jack_fav -> array_intersect_key($Kelvin_fav) -> _done());
echo '<hr />';
*/

/* array_merge() */
/*
echo '<p>array_merge($value_a, array(7,8,78))</p>';
var_dump($key_a -> array_merge($value_a, array(7,8,78)) -> _done());
echo '<hr />';
*/

/* array_merge_recursive() */
/*
echo '<p>array_merge_recursive()</p>';
var_dump($Jack_fav -> array_merge_recursive($Kelvin_fav) -> _done());
echo '<hr />';
*/

/* array_multisort() */
/* --------------------------------------- 多数组操作 测试全部结束--------------------------------------------- */

/**
 * 返回非数组
 */
/**
 * 1. _array_key_exists();
 * 2. _array_product();
 * 3. _array_search();
 * 4. _array_sum();
 * 5. _count();
 * 6. _in_array();
 * 7. _sizeof();
 */
$e = array(
    'first'=>0.1,
    'final'=>19.2,
    'no' => NULL,
    array(
        'come' => NULL,
        'place' => 'Shanghai',
        'inner_num' => 100,
        200
    )
);
A::extend($e);
/* _array_key_exists($key, $needle = FALSE, $recursive = FALSE) */
/*
echo '<p>_array_key_exists("no", FALSE, FALSE)</p>';
var_dump($e -> _array_key_exists("no", FALSE, FALSE));
echo '<hr />';
*/
/*
echo '<p>_array_key_exists("come", TRUE, TRUE)</p>';
//var_dump($e -> _array_key_exists("no", TRUE, TRUE));
var_dump($e -> _array_key_exists("come", TRUE, TRUE));
echo '<hr />';
*/

/* _array_product($recursive = FALSE) */
/*
echo '<p>_array_product()</p>';
var_dump($e -> array_3rd_double_only(TRUE));
//var_dump($e -> _array_product(TRUE));
echo '<hr />';
*/

/* _array_search($key, $recursive = FALSE) */
/*
echo '<p>_array_search(19.2)</p>';
var_dump($e -> _array_search('19.2', FALSE));
echo '<hr />';
*/
/*
echo '<p>_array_search("Shanghai")</p>';
var_dump($e -> _array_search("Shanghai", TRUE));
echo '<hr />';
*/

/* _array_sum($recursive = FALSE, & $a = 'self') */
/*
echo '<p>_array_sum(FALSE)</p>';
var_dump($e -> _array_sum(FALSE));
echo '<hr />';
*/
/*
echo '<p>_array_sum(TRUE)</p>';
var_dump($e -> _array_sum(TRUE));
echo '<hr />';
*/

/* _count() */
/*
echo '<p>_count()</p>';
var_dump($e -> _count());
echo '<hr />';
*/

/* _in_array($needle, $recursive = FALSE) */
/*
echo '<p>_in_array(16.78, FALSE)</p>';
var_dump($e -> _in_array(16.78, FALSE));
echo '<hr />';
*/
/*
echo '<p>_in_array("Shanghai", TRUE)</p>';
var_dump($e -> _in_array("Shanghai", TRUE));
echo '<hr />';
*/

/* _sizeof() */
/*
echo '<p>_sizeof()</p>';
var_dump($e -> _sizeof());
echo '<hr />';
*/
/* --------------------------------------- 返回分数组 测试全部结束--------------------------------------------- */

/**
 * 第三方数组操作
 */
/**
 * 1. array_3rd_clear()       变成空元素数组
 * 2. array_3rd_compact()     等价于array_3rd_without(array(NULL,'')) 清空数组中空白元素
 * 3. array_3rd_first()       取出数组中第一个键值对元素，形成单元素数组
 * 4. array_3rd_flatten()     将N维数组变为一维数组，同键名时靠后的元素值将覆盖靠前的元素值
 * 5. array_3rd_last()        取出数组中末尾元素，形成单元素数组
 * 6. array_3rd_array_only()  剔除数组中非数组元素
 * 7. array_3rd_double_only() 剔除数组中非数字元素
 * 8. _array_3rd_toJSON()     返回JSON格式的字符串
 * 9. array_3rd_without()     剔除数组中的特定表达式
 * 10. array_3rd_float2int()  将数组中的浮点数转化成整数
 */
$f = array(
    'name' => 'Bob',
    'profession' => 'doctor',
    'has' => 2,
    'has2' => 2.7,
    'children' => array(
        'a' => 'Sindy',
        'b' => 'Jack',
        'num' => 10.5,
        'num3' => 21,
        'num0' => 30.4,
        array(
        'hAha1' => 'h1Ha'
        )
    ),
    'brothers' => 'Tom Bob',
    'brother_num' => 1.8,
    'blank1' => '',
    'blank2' => NULL
);
A::extend($f);
/* 1.array_3rd_clear() */
/*
echo '<p>array_3rd_clear()</p>';
var_dump($f -> array_3rd_clear() -> _done());
echo '<hr />';
*/

/* 2.array_3rd_compact() */
/*
echo '<p>array_3rd_compact()</p>';
var_dump($f -> array_3rd_compact() -> _done());
echo '<hr />';
*/

/* 3.array_3rd_first() */
/*
echo '<p>array_3rd_first()</p>';
var_dump($f -> array_3rd_first() -> _done());
echo '<hr />';
*/

/* 4.array_3rd_flatten() */
/*
echo '<p>array_3rd_flatten()</p>';
var_dump($f -> array_3rd_flatten() -> _done());
echo '<hr />';
*/

/* 5.array_3rd_last() */
/*
echo '<p>array_3rd_last()</p>';
var_dump($f -> array_3rd_last() -> _done());
echo '<hr />';
*/

/* 6.array_3rd_array_only() */
/*
echo '<p>array_3rd_array_only()</p>';
var_dump($f -> array_3rd_array_only() -> _done());
echo '<hr />';
*/
/* 7.array_3rd_double_only() */
/*
echo '<p>array_3rd_product(TRUE)</p>';
//var_dump($f -> array_3rd_double_only(TRUE) -> array_3rd_flatten(FALSE) -> _array_product(TRUE));
var_dump($f -> _array_product(FALSE));
echo '<hr />';
*/

/* 8._array_3rd_toJSON() */
/*
echo '<p>_array_3rd_toJSON()</p>';
var_dump($f -> _array_3rd_toJSON());
echo '<hr />';
*/

/* 9.array_3rd_without($without, $for = 'value', & $a = 'self') */
/*
echo '<p>array_3rd_without("Sindy","value")</p>';
var_dump($f -> array_3rd_without("Sindy") -> _done());
echo '<hr />';
*/
/*
echo '<p>array_3rd_without(array(NULL,"","Sindy"),"value")</p>';
var_dump($f -> array_3rd_without(array(NULL,"","Sindy"),"value") -> _done());
echo '<hr />';
*/
/*
echo '<p>array_3rd_without("num"),"key")</p>';
var_dump($f -> array_3rd_without("num"),"key") -> _done());
echo '<hr />';
*/
/*
echo '<p>array_3rd_without(array("num","num1","num2","num3"),"key")</p>';
var_dump($f -> array_3rd_without(array("num","num1","num2","num3"),"key") -> _done());
echo '<hr />';
*/
/*
echo '<p>array_3rd_without("/^num/","key")</p>';
var_dump($f -> array_3rd_without("/^num/","key") -> _done());
echo '<hr />';
*/
/*
echo '<p>array_3rd_without("/^J/","value")</p>';
var_dump($f -> array_3rd_without("/^J/","value") -> _done());
echo '<hr />';
*/

/* 10._array_3rd_float2int($recursive = FASLE, $func = 'ceil') */
/*
echo '<p>_array_3rd_float2int(FALSE)</p>';
var_dump($f -> array_3rd_float2int(FALSE) -> _done());
echo '<hr />';
*/
/*
echo '<p>_array_3rd_float2int(TRUE, 'round')</p>';
var_dump($f -> array_3rd_float2int(TRUE, 'round') -> _done());
echo '<hr />';
*/

/* --------------------------------------- 第三方数组 测试全部结束--------------------------------------------- */

/**
 * 结论：目前版本 beta 2
 *                  待修正与扩展：
 * 1. array_rand()         // 增加返回键值对
 */
