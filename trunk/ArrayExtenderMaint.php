<?php
// $Id$
/**
 * Created at 2009.1.1 21:11
 * Updated at 2009.1.13
 * Version : beta 2.1
 * Author : Kelvin_gao
 *
 * 1php内置数组函数分类:
 * 1.1 单数组操作相关：
 *   1. (172)array_change_key_case(); // OK
 *   2. (190)array_chunk();           // OK
 *   3. (204)array_count_values();    // OK
 *   4. (224)array_fill();            // OK
 *   5. (249)array_flip();            // OK
 *   6. (270)array_keys();            // OK
 *   7. (285)array_pad();             // OK
 *   8. (297)array_pop();             // OK 简化操作，可一次弹出N个
 *   9. (309)array_push();            // OK 支持一次弹入多个
 *   10.(334)array_rand();            // OK 未完成
 *   11.(378)array_reverse();         // OK
 *   12.(395)array_shift();           // OK 简化操作，可一次入列N个
 *   13.(409)array_slice();           // OK
 *   14.(421)array_splice();          // OK
 *   15.(444)array_unique();          // OK
 *   16.(459)array_unshift();         // OK 支持一次弹入多个
 *   17.(481)array_values();          // OK
 *
 *   (505)sorter() 类别：
 *   18.(529)asort();                 // OK
 *   19.(538)arsort();                // OK
 *   20.(547)ksort();                 // OK
 *   21.(556)krsort();                // OK
 *   22.(565)natsort();               // OK
 *   23.(574)natcasesort();           // OK
 *   24.(583)rsort();                 // OK
 *   25.(592)sort();                  // OK
 *   26.(620)shuffle();               // OK
 *
 * 1.2 多数组操作相关:
    (643)multicaller()
 *   1. (658)array_combine();
 *   2. (666)array_diff();
 *   3. (672)array_diff_assoc();
 *   4. (680)array_diff_key();
 *   5. (688)array_intersect();
 *   6. (696)array_intersect_assoc();
 *   7. (704)array_intersect_key();
 *   8. (715)array_merge();
 *   9. (726)array_merge_recursive();
 *   *10.array_multisort();
 *
 * 1.3 回调函数相关：(跳过)
 *   1. array_diff_uassoc();
 *   2. array_diff_ukey();
 *   3. array_filter();
 *   4. array_intersect_uassoc();
 *   5. array_intersect_ukey();
 *   6. array_map();
 *   7. array_reduce();
 *   8. array_udiff_assoc();
 *   9. array_udiff_uassoc();
 *   10.array_udiff();
 *   11.array_uintersect_assoc();
 *   12.array_uintersect_uassoc();
 *   13.array_uintersect();
 *   14.array_walk();
 *   15.array_walk_recursive();
 *   16.array_uintersect();
 *   17.uasort();
 *   18.usort();
 *
 * 1.4 返回非数组：
 *   1. (747)_array_key_exists();
 *   2. (765)_array_product();
 *   3. (788)_array_search();
 *   4. (802)_array_sum();
 *   5. (825)_count();
 *   6. (836)_in_array();
 *   7. (850)_sizeof();
 *
 * 1.5 其他：（跳过）
 *   1. compact();                    // ? 没用
 *   2. extract();                    // ? 没用
 *   3. current();
 *   4. end();
 *   5. each();
 *   6. key();
 *   7. list();
 *   8. next();
 *   9. pos();
 *   10.prev();
 *   11.range();
 *   12.reset();
 *
 * 2 核心函数
 * (862)A::extend();
 * (897)_done();
 *
 * 说明：
 * 这个类用来方便得操作数组。
 *
 * 优点： 1.1 简化数组操作；
 *        1.2 提供扩展的数组操作；
 *        1.3 写法简洁明了，可读性、可改性好；
 * 缺点： 2.1 实质是实例化一个类，效率相对比内置函数低；
 *        2.2 类似js写法，可能风格不习惯；
 *
 * 用法1：
 * A::extend($arr1,$arr2,$arr3,$arr4);       // 参数一次最少1个，最多25个，返回的结果使得所有作为参数的数组都具有扩展操作
 *
 * 用法2：
 * $testArr = new A(array(0,1,2,3,4,5));     // 新建一个A的实例，使其具有扩展操作
 *
 * 使用连贯接口，作为A的实例都具有 $method_1() -> $method_2() -> $method_n(); 的写法。这样做直接操作数组，不必赋值。见实例
 *
 * 典型写法：
 * $testArr1 = array(0,1,2,3,4,5);
 * $testArr2 = array(10,11,12,13,14,15);
 * A::extend($testArr1, $testArr2);
 *
 * $testArr -> array_push('extended!') -> array_3rd_compact() -> array_merge($testArr2);
 * var_dump($testArr1 -> myArray);
 *
 * 修改建议：
 * 1. 也许参数使用地址传递更快
 */
class A {
    private $myArray = array();
    function __construct($accepted_array) {
        $this -> myArray = $accepted_array;
    }
    function __destruct() {}

// 其他魔法方法 (magic function)
//    function __call() {}
//    function __get() {}
//    function __set() {}
//    function __isset() {}
//    function __unset() {}
//    function __sleep() {}
//    function __wakeup() {}
//    function __toString() {}
//    function __set_state() {}
//    function __clone() {}
//    function __autoload() {}

/** ---------------------------------
 * php functions
 *
 */
/**
 * 单数组操作
 */
    /**
     * array_change_key_case($case, FALSE)表示只变化第一维数组元素的键名。数字索引键键名不变。如果元素是数组，则被忽略并产生一个警告级别错误
     * array_change_key_case($case, TRUE) 表示除上述外元素是数组时，进入该子数组，将这个子数组进行递归键名变化。
     * $case 的 可能值： CASE_UPPPER, CASE_LOWER
     *
     * @param int $case
     * @param boolean $recursive
     *
     * @return object
     */
    private static function array_change_key_case_helper($a, $case = CASE_UPPER) {
        foreach($a as $k => $v) {
            if(is_array($v)) {
                $a[$k] = self::array_change_key_case_helper($v, $case);
            }
        }
        return array_change_key_case($a, $case);
    }
    function array_change_key_case($case = CASE_UPPER, $recursive = FALSE) {
        if($recursive == FALSE) {
            $this -> myArray = array_change_key_case($this -> myArray, $case);
            return $this;
        } elseif($recursive == TRUE) {
            $this -> myArray = self::array_change_key_case_helper($this -> myArray, $case);
            return $this;
        }
    }

    /**
     * 按 $size 大小切割数组
     *
     * @param int $size >  0
     * @param boolean $preserve_keys
     *
     * @return object
     */
    function array_chunk($size, $preserve_keys = FALSE) {
        $this -> myArray = array_chunk($this -> myArray, $size, $preserve_keys);
        return $this;
    }

    /**
     * array_count_values(FALSE)表示计算数组第一维值出现的个数，如果元素是数组，则被忽略并产生一个警告级别错误
     * array_count_values(TRUE) 表示元素是数组时，进入该子数组，将这个子数组取出值进行数量计算。
     * 注： 当遇到 浮点数 时，该元素被忽略并产生一个警告错误
     *
     * @param boolean $recursive
     *
     * @return object
     */
    function array_count_values($recursive = FALSE) {
        if($recursive == FALSE) {
            // 需要重写，遇到数组会出错
            $this -> myArray = array_count_values($this -> array_3rd_float2int(FALSE) -> _done());
            return $this;
        } elseif($recursive == TRUE) {
            $this -> myArray = array_count_values($this -> array_values(TRUE, FALSE) -> array_3rd_float2int(TRUE) -> _done());
        }
        return $this;
    }

    /**
     * 用 $value 从数组索引 $start_index 开始 填充 $num 个相同的元素
     *
     * @param int $start_index > 0
     * @param int $num > 0
     * @param mixed $value
     *
     * return object
     */
    function array_fill($start_index, $num, $value) {
        $this -> myArray = array_fill($start_index, $num, $value);
        return $this;
    }

    /**
     * array_flip(FALSE)表示按php交换键与值，如果元素是数组，则被忽略并产生一个警告级别错误
     * array_flip(TRUE) 表示元素是数组时，保持键名，递归运算子数组
     * 任何值为 float, double 类型将强制去尾被转化为int, 如 10.1 变成 10,  9.99 变成 9。 负数同理， -10.1 变成 -10.(允许出现负整数索引)
     *
     * @param boolean $recursive
     *
     * @return object
     */
    private static function array_flip_helper($a) {
        $ab = array();
        foreach($a as $k => $v) {
            if(is_array($v)) {
                $ab[$k] = self::array_flip_helper($v);
            } else {
                $ab[$v] = $k;
            }
        }
        return $ab;
    }
    function array_flip($recursive = FALSE) {
        if($recursive == FALSE) {
            // 要重写，否则遇到数组会出错
            $this -> myArray = array_flip($this -> array_3rd_float2int() -> _done());
            return $this;
        } elseif($recursive == TRUE) {
            $this -> myArray = self::array_flip_helper($this -> array_3rd_float2int(TRUE) -> myArray);
            //$this -> myArray = self::array_flip_helper($this -> myArray);
            return $this;
        }
    }

    /**
     * array_keys(FALSE)获取第一维元素的键名，如果元素是值数组，也不递归
     * array_keys(TRUE) 表示获取元素的所有键名，不管它是在数组的第几维
     * 结果中除去相同的键名。形成新数组，从0起索引
     *
     * @param boolean $recursive
     *
     * @return object
     */
    function array_keys($recursive = FALSE) {
        if($recursive == FALSE) {
            $this -> myArray = array_keys($this -> myArray);
        } elseif($recursive == TRUE) {
            $this -> myArray = array_keys($this -> array_3rd_flatten() -> _done());
        }
        return $this;
    }

    /**
     * @param int $pad_size
     * @param mixed $pad_value
     *
     * @return object
     */
    function array_pad($pad_size, $pad_value) {
        $this -> myArray = array_pad($this -> myArray, $pad_size, $pad_value);
        return $this;
    }

    /**
     * array_pop($numbers) 数组出栈$times次，弹出末尾元素
     *
     * @param int $times > 0
     *
     * @return object
     */
    function array_pop($times = 1) {
        for($i=0;$i<$times;++$i) {
            array_pop($this -> myArray);
        }
        return $this;
    }

    /**
     * array_push() 将所有参数依次加入末尾，无法加入字符串键名
     *
     * @return object
     */
    function array_push() {
        $args = func_get_args();
        foreach($args as $value) {
            if($value instanceof A) {
                array_push($this -> myArray, $value -> myArray);
            }
            else
                array_push($this -> myArray, $value);
        }
        return $this;
    }

    /**
     * array_rand($number, FALSE, 'key')  表示随机获取$number个数组第一层的键
     * array_rand($number, FALSE, 'value')表示随机获取$number个数组第一层的值
     * array_rand($number, TRUE, 'key')   表示随机获取$number个数组的键，任何一层的键都有可能
     * array_rand($number, TRUE, 'value') 表示随机获取$number个数组的值，任何一层的值都有可能
     * // array_rand($number, TRUE, 'both') 表示随机获取$number 个数组的键值对（未完成）
     *
     * @param int $number
     * @param boolean $recursive
     * @param string $for
     *
     * @return object
     */
    function array_rand($number, $recursive = FALSE, $for = 'key') {
        if($recursive == FALSE) {
            switch($for) {
                case 'key' :
                    $this -> myArray = array_rand($this -> _done(), $number);
                    break;
                case 'value' :
                    $this -> myArray = array_rand($this -> array_flip(TRUE) -> _done(), $number);
                    break;
            }
            return $this;
        } elseif($recursive == TRUE) {
            switch($for) {
                case 'key' :
                    $this -> myArray = array_rand($this -> array_keys(TRUE) -> array_flip(TRUE) -> _done(), $number);
                    break;
                case 'value' :
                    $this -> myArray = array_rand($this -> array_values(TRUE) -> array_flip(TRUE) -> _done(), $number);
                    break;
                case 'both' :
                    // do something here
                    break;
            }
            return $this;
        }
    }

    /**
     * array_reverse(FALSE)表示按php内部格式倒排数组，如果元素是数组，则作为元素的数组本身不倒排，内部元素按原有顺序
     * array_reverse(TRUE) 表示元素是数组时，进入该子数组，保持键，将这个子数组元素倒排。
     *
     * @param boolean $recursive
     *
     * @return object
     */
    private static function array_reverse_helper($a) {
        foreach($a as $k => $v) {
            if(is_array($v)) {
                $a[$k] = self::array_reverse_helper($v);
            }
        }
        $a = array_reverse($a);
        return $a;
    }
    function array_reverse($recursive = FALSE) {
        if($recursive == FALSE) {
            $this -> myArray = array_reverse($this -> myArray);
            return $this;
        } elseif($recursive == TRUE) {
            $this -> myArray =  self::array_reverse_helper($this -> myArray);
            return $this;
        }
    }

    /**
     * array_shift($numbers) 数组出队列$times次，弹出第一个元素
     *
     * @param int $times > 0
     *
     * @return object
     */
    function array_shift($times = 1) {
        for($i=0;$i<$times;++$i) {
            array_shift($this -> myArray);
        }
        return $this;
    }

    /**
     * @param int $offset
     * @param int length > 0
     * @param boolean $preserve_keys
     *
     * @return object
     */
    function array_slice($offset, $length, $preserve_keys = FALSE) {
        $this -> myArray = array_slice($this -> myArray, $offset, $length, $preserve_keys);
        return $this;
    }

    /**
     * @param int $offset
     * @param int $length > 0
     * @param mixed $replacement
     *
     * @return object
     */
    function array_splice($offset, $length, $replacement = NULL) {
        array_splice($this -> myArray, $offset, $length, $replacement);
        return $this;
    }

    /**
     * array_unique(FALSE)表示按php内部格式删除数组内重复值，如果元素是数组，则作为元素的数组本身不变化
     * array_unique(TRUE) 表示元素是数组时，继续进入该子数组，将这个子数组删除重复值
     * 注：保持键值对
     *
     * @param boolean $recursive
     *
     * @return object
     */
    private static function array_unique_helper($a) {
        foreach($a as $k => $v) {
            if(is_array($v)) {
                $a[$k] = self::array_unique_helper($v);
            }
        }
        $a = array_unique($a);
        return $a;
    }
    function array_unique($recursive = FALSE) {
        if($recursive == FALSE) {
            $this -> myArray = array_unique($this -> myArray);
            return $this;
        } elseif($recursive == TRUE) {
            $this -> myArray =  self::array_unique_helper($this -> myArray);
            return $this;
        }
    }

    /**
     * array_unshift() 将所有参数依次加入队头，无法加入字符串键名
     *
     * @return object
     */
    function array_unshift() {
        $args = func_get_args();
        foreach($args as $value) {
            if($value instanceof A) {
                array_unshift($this -> myArray, $value -> myArray);
            }
            else
                array_unshift($this -> myArray, $value);
        }
        return $this;
    }

    /**
     * array_values(FLASE, FALSE)表示按php内部格式获取值，如果元素值是数组，则该数组被当作单值看待
     * array_values(TRUE, FALSE) 表示获取数组的所有值，不管其是否在数组的第几维。保留重复值
     * array_values(TRUE, TRUE)  表示获取元素的所有值，不管其是否在数组的第几维。剔除重复值
     *
     * @param boolean $recursive
     * @param boolean $unique
     *
     * @return object
     */
    function array_values($recursive = FALSE, $unique = FALSE) {
        if($recursive == FALSE) {
            $this -> myArray = array_values($this -> myArray);
        } elseif($recursive == TRUE) {
            if($unique == FALSE) {
                $this -> myArray = array_values($this -> array_3rd_flatten() -> _done());
            } elseif($unique == TRUE) {
                $this -> myArray = array_values($this -> array_3rd_flatten() -> array_unique() -> _done());
            }
        }
        return $this;
    }

    /**
     * 原型函数，可以调用下列8个中的任何函数
     * 用来递归调用一个排序数组系列的函数
     * 如sorter(FALSE, 'ksort') 表示非递归调用 ksort()
     * 而sorter(TRUE,  'ksort') 表示递归调用 ksort()
     *
     * @param boolean $recursive
     * @param string $func
     *
     * @return object
     */
    private static function sorter_helper($a, $func) {
        foreach($a as $k => $v) {
            if(is_array($v)) {
                $a[$k] = self::sorter_helper($v, $func);
            }
        }
        $func($a);
        return $a;
    }
    function sorter($recursive = FALSE, $func) {
        if($recursive == FALSE) {
            $func($this -> myArray);
            return $this;
        } elseif($recursive == TRUE) {
            $this -> myArray =  self::sorter_helper($this -> myArray, $func);
            return $this;
        }
    }

    /**
     * @param boolean $recursive
     *
     * @return object
     */
    function asort($recursive = FALSE) {
        if($recursive == FALSE) {
            asort($this -> myArray);
            return $this;
        } elseif($recursive == TRUE) {
            $this -> myArray =  self::sorter_helper($this -> myArray, 'asort');
            return $this;
        }
    }
    function arsort($recursive = FALSE) {
        if($recursive == FALSE) {
            arsort($this -> myArray);
            return $this;
        } elseif($recursive == TRUE) {
            $this -> myArray =  self::sorter_helper($this -> myArray, 'arsort');
            return $this;
        }
    }
    function ksort($recursive = FALSE) {
        if($recursive == FALSE) {
            ksort($this -> myArray);
            return $this;
        } elseif($recursive == TRUE) {
            $this -> myArray =  self::sorter_helper($this -> myArray, 'ksort');
            return $this;
        }
    }
    function krsort($recursive = FALSE) {
        if($recursive == FALSE) {
            krsort($this -> myArray);
            return $this;
        } elseif($recursive == TRUE) {
            $this -> myArray =  self::sorter_helper($this -> myArray, 'krsort');
            return $this;
        }
    }
    function natsort($recursive = FALSE) {
        if($recursive == FALSE) {
            natsort($this -> myArray);
            return $this;
        } elseif($recursive == TRUE) {
            $this -> myArray =  self::sorter_helper($this -> myArray, 'natsort');
            return $this;
        }
    }
    function natcasesort($recursive = FALSE) {
        if($recursive == FALSE) {
            natcasesort($this -> myArray);
            return $this;
        } elseif($recursive == TRUE) {
            $this -> myArray =  self::sorter_helper($this -> myArray, 'natcasesort');
            return $this;
        }
    }
    function rsort($recursive = FALSE) {
        if($recursive == FALSE) {
            rsort($this -> myArray);
            return $this;
        } elseif($recursive == TRUE) {
            $this -> myArray =  self::sorter_helper($this -> myArray, 'rsort');
            return $this;
        }
    }
    function sort($recursive = FALSE) {
        if($recursive == FALSE) {
            sort($this -> myArray);
            return $this;
        } elseif($recursive == TRUE) {
            $this -> myArray =  self::sorter_helper($this -> myArray, 'sort');
            return $this;
        }
    }

    /**
     * shuffle(FALSE)表示按php内部格式打乱数组，保持子数组内部顺序不受影响
     * shuffle(TRUE)表示打乱数组，且子数组内部顺序也受影响
     * 注：无法保持键值对， 因为有字符串键的值即使打乱顺序也无意义。但如果有些元素是字符串键而有些不是，则一律会变成数字键
     *
     * @param boolean $recursive
     *
     * @return object
     */
    private static function shuffle_helper($a) {
        foreach($a as $k => $v) {
            if(is_array($v)) {
                $a[$k] = self::shuffle_helper($v);
            }
        }
        shuffle($a);
        return $a;
    }
    function shuffle($recursive = FALSE) {
        if($recursive == FALSE) {
            shuffle($this -> myArray);
            return $this;
        } elseif($recursive == TRUE) {
            $this -> myArray =  self::shuffle_helper($this -> myArray);
            return $this;
        }
    }

/**
 * 多数组操作
 */
    /**
     * 原型函数，可以调用下列9个中的任何函数
     * 如multicaller($array_b, 'array_combine') 表示array_combine($array_b);
     * 如multicaller($array_b, 'array_merge') 表示array_merge($array_b);
     *
     * @param array $array_b
     * @param string $func
     *
     * @return object
     */
    function multicaller($array_b, $func) {
        if($array_b instanceof A) {
            $this -> myArray = $func($this -> myArray, $array_b -> myArray);
        }
        else
            $this -> myArray = $func($this -> myArray, $array_b);
        return $this;
    }

    /**
     * @param array||instanceof A $array_b
     *
     * @return object
     */
    function array_combine($array_b) {
        if($array_b instanceof A) {
            $this -> myArray = array_combine($this -> myArray, $array_b -> myArray);
        }
        else
            $this -> myArray = array_combine($this -> myArray, $array_b);
        return $this;
    }
    function array_diff($array_b) {
        if($array_b instanceof A) {
            $this -> myArray = array_diff($this -> myArray, $array_b -> myArray);
        }
        else
            $this -> myArray = array_diff($this -> myArray, $array_b);
        return $this;
    }
    function array_diff_assoc($array_b) {
        if($array_b instanceof A) {
            $this -> myArray = array_diff_assoc($this -> myArray, $array_b -> myArray);
        }
        else
            $this -> myArray = array_diff_assoc($this -> myArray, $array_b);
        return $this;
    }
    function array_diff_key($array_b) {
        if($array_b instanceof A) {
            $this -> myArray = array_diff_key($this -> myArray, $array_b -> myArray);
        }
        else
            $this -> myArray = array_diff_key($this -> myArray, $array_b);
        return $this;
    }
    function array_intersect($array_b) {
        if($array_b instanceof A) {
            $this -> myArray = array_intersect($this -> myArray, $array_b -> myArray);
        }
        else
            $this -> myArray = array_intersect($this -> myArray, $array_b);
        return $this;
    }
    function array_intersect_assoc($array_b) {
        if($array_b instanceof A) {
            $this -> myArray = array_intersect_assoc($this -> myArray, $array_b -> myArray);
        }
        else
            $this -> myArray = array_intersect_assoc($this -> myArray, $array_b);
        return $this;
    }
    function array_intersect_key($array_b) {
        if($array_b instanceof A) {
            $this -> myArray = array_intersect_key($this -> myArray, $array_b -> myArray);
        }
        else
            $this -> myArray = array_intersect_key($this -> myArray, $array_b);
        return $this;
    }

    function array_merge() {
        $args = func_get_args();
        foreach($args as $arg) {
            if($arg instanceof A) {
                $this -> myArray = array_merge($this -> myArray, $arg -> myArray);
            }
            else
                $this -> myArray = array_merge($this -> myArray, $arg);
        }
        return $this;
    }
    function array_merge_recursive() {
        $args = func_get_args();
        foreach($args as $arg) {
            if($arg instanceof A) {
                $this -> myArray = array_merge_recursive($this -> myArray, $arg -> myArray);
            }
            else
                $this -> myArray = array_merge_recursive($this -> myArray, $arg);
        }
        return $this;
    }

/**
 * 返回非数组
 */
    /**
     * @param string $key
     * @param boolean $needle (对指向null值的键，$needle 为 TRUE 时返回 TRUE, $needle 为 FALSE 时返回 FALSE)
     *
     * @return boolean
     */
    function _array_key_exists($key, $needle = FALSE, $recursive = FALSE) {
        if($recursive == FALSE) {
            $a = &$this -> myArray;
        } elseif($recursive == TRUE) {
            $a = &$this -> array_3rd_flatten() -> _done();
        }
        if($needle) {
            return array_key_exists($key, $a);
        }
        else
            return isset($a[$key]);
    }

    /**
     * 计算数组数字元素乘积
     *
     * @return float
     */
    function _array_product($recursive = FALSE, & $a = 'self') {
        if($a == 'self') {
            $a = &$this -> myArray;
        }
        if($recursive == FALSE) {
            return array_product($this -> array_3rd_double_only(FALSE) -> _done());
        } elseif($recursive == TRUE) {
            $return = 1;
            foreach($a as $k => $v) {
                if(is_array($v)) {
                    $return *= $this -> _array_product($recursive, $v);
                }
            }
            $return *= array_product($a);
            return $return;
        }
    }

    /**
     * @param mixed $needle
     *
     * @return string||int||FALSE
     */
    function _array_search($needle, $recursive = FALSE) {
        if($recursive == FALSE) {
            $a = &$this -> myArray;
        } elseif($recursive == TRUE) {
            $a = &$this -> array_3rd_flatten() -> _done();
        }
        return array_search($needle, $a);
    }

    /**
     * 计算数组数字元素的和
     *
     * @return float
     */
    function _array_sum($recursive = FALSE, & $a = 'self') {
        if($a == 'self') {
            $a = &$this -> myArray;
        }
        if($recursive == TRUE) {
            $sum = 0;
            foreach($a as $k => $v) {
                if(is_array($v)) {
                    $sum += $this -> _array_sum($recursive, $v);
                }
            }
            $sum += array_sum($a);
            return $sum;
        } else {
            return array_sum($a);
        }
    }

    /**
     * 计算数组元素个数
     *
     * @return int
     */
    function _count() {
        return count($this -> myArray);
    }

    /**
     * 判断元素是否存在于数组中
     *
     * @param array $needle
     *
     * @return boolean
     */
    function _in_array($needle, $recursive = FALSE) {
        if($recursive == FALSE) {
            $a = &$this -> myArray;
        } elseif($recursive == TRUE) {
            $a = &$this -> array_3rd_flatten() -> _done();
        }
        return in_array($needle, $a);
    }

    /**
     * 计算数组元素个数
     *
     * @return int
     */
    function _sizeof() {
        return sizeof($this -> myArray);
    }


    /**
     * 核心函数，利用此方法实例化，工厂类
     *
     * @param array
     *
     * @return object
     */
    static function extend(&$a, &$b = NULL, &$c = NULL, &$d = NULL, &$e = NULL, &$f = NULL, &$g = NULL, &$h = NULL, &$i = NULL,
                                &$j = NULL, &$k = NULL, &$l = NULL, &$m = NULL, &$n = NULL, &$o = NULL, &$p = NULL, &$q = NULL,
                                &$r = NULL, &$s = NULL, &$t = NULL, &$u = NULL, &$v = NULL, &$w = NULL, &$x = NULL, &$y = NULL) {
        $a = new A($a);
        if($b) {$b = new A($b);} else return;
        if($c) {$c = new A($c);} else return;
        if($d) {$d = new A($d);} else return;
        if($e) {$e = new A($e);} else return;
        if($f) {$f = new A($f);} else return;
        if($g) {$g = new A($g);} else return;
        if($h) {$h = new A($h);} else return;
        if($i) {$i = new A($i);} else return;
        if($j) {$j = new A($j);} else return;
        if($k) {$k = new A($k);} else return;
        if($l) {$l = new A($l);} else return;
        if($m) {$m = new A($m);} else return;
        if($n) {$n = new A($n);} else return;
        if($o) {$o = new A($o);} else return;
        if($p) {$p = new A($p);} else return;
        if($q) {$q = new A($q);} else return;
        if($r) {$r = new A($r);} else return;
        if($s) {$s = new A($s);} else return;
        if($t) {$t = new A($t);} else return;
        if($u) {$u = new A($u);} else return;
        if($v) {$v = new A($v);} else return;
        if($w) {$w = new A($w);} else return;
        if($x) {$x = new A($x);} else return;
        if($y) {$y = new A($y);} else return;
    }

    /**
     * 返回当前实例处理的数组。该数组不能由外部修改，只能由这个方法读取
     *
     * @return array
     */
    function _done() {
        return $this -> myArray;
    }

/** ---------------------------------
 * 3rd functions 第三方函数库
 * 注：在扩展php内部函数时，有部分函数如array_values()用到了array_3rd_flatten()这个函数，若要删减，请注意
 *
 */
/**
 *       函数列表                扩展功能
 * 1. (928)array_3rd_clear()       变成空元素数组
 * 2. (941)array_3rd_compact()     等价于array_3rd_without(array(NULL,'')) 清空数组中空白元素
 * 3. (965)array_3rd_first()       取出数组中第一个键值对元素，形成单元素数组
 * 4. (990)array_3rd_flatten()     将N维数组变为一维数组，同键名时靠后的元素值将覆盖靠前的元素值
 * 5. (1020)array_3rd_last()        取出数组中末尾元素，形成单元素数组
 * 6. (1047)array_3rd_array_only()  剔除数组中非数组元素
 * 7. (1073)array_3rd_double_only() 剔除数组中非数字元素
 * 8. (1096)_array_3rd_toJSON()     返回JSON格式的字符串
 * 9. (1108)array_3rd_without()     剔除数组元素中包含在 $without 数组中的键或值的元素, 支持输入正则表达式（不能是正则表达式数组，只能是字符串）
 *
 * 10. 将数组中所有浮点数按指定要求转为整型数
 */
    /**
     * 清空数组
     *
     * @return object
     */
    function array_3rd_clear() {
        $this -> myArray = NULL;
        $this -> myArray = array();
        return $this;
    }

    /**
     * 消除数组中的未定义或NULL或空值
     *
     * @param array $arr
     *
     * @return object
     */
    function array_3rd_compact(& $a = 'self') {
        if($a == 'self') {
            $a = &$this -> myArray;
        }
        foreach ($a as $k => $v) {
            if (is_array($v)) {
                $this -> array_3rd_compact($a[$k]);
            } else {
                $v = trim($v);
                if ($v == '') {
                    unset($a[$k]);
                }
            }
        }
        return $this;
    }

    /**
     * 取出数组中第一个元素，形成单元素数组
     *
     * @param boolean $preserve _keys
     *
     * @return object
     */
    function array_3rd_first($preserve_key = TRUE) {
        $start = 0;
        $ab = array();
        foreach($this -> myArray as $k => $v) {
            if($start == 0) {
                if($preserve_key == TRUE) {
                    $ab[$k] = $v;
                } elseif($preserve_key == FALSE) {
                    $ab = $v;
                }
            }
            break;
        }
        $this -> myArray = &$ab;
        return $this;
    }

    /**
     * 将多维数组转化成一维数组，键名重复时靠后的值将覆盖靠前的值
     *
     * @param boolean $preserve_keys
     * @param array $a
     *
     * @return object
     */
    function array_3rd_flatten($preserve_keys = TRUE, & $a = 'self') {
        if($a == 'self') {
            $a = &$this -> myArray;
        }
        $ab = array();
        if(!is_array($a)) {
            return $a;
        }
        foreach($a as $k => $v) {
            if(is_array($v)){
                $ab = array_merge($ab, $this -> array_3rd_flatten($preserve_keys, $v) -> _done());
            } else {
                if($preserve_keys == TRUE) {
                    $ab[$k] = $v;
                } else {
                    $ab[] = $v;
                }
            }
        }
        $this -> myArray = &$ab;
        return $this;
    }

    /**
     * 取出数组中最后一个元素，形成单元素数组
     *
     * @param boolean $preserve _keys
     *
     * @return object
     */
    function array_3rd_last($preserve_key = TRUE) {
        if($preserve_key == TRUE) {
            $length = count($this -> myArray);
            $start = 0;
            $ab = array();
            foreach($this -> myArray as $k => $v) {
                if($start == $length-1) {
                    $ab[$k] = $v;
                }
                ++$start;
            }
            $this -> myArray = &$ab;
            return $this;
        } elseif($preserve_key == FALSE) {
            $last = end($this -> myArray);
            $this -> myArray = NULL;
            $this -> myArray = array();
            $this -> myArray[] = $last;
            return $this;
        }
    }

    /**
     *  剔除数组中非数组元素
     *
     * @return object
     */
    function array_3rd_array_only() {
        foreach($this -> myArray as $k => $v) {
            if(!is_array($v)) {
                unset($this -> myArray[$k]);
            }
        }
        return $this;
    }

    /**
     *  保留数组中的可运算数字
     *
     * @return object
     */
    static function array_3rd_double_only_helper($a) {
        foreach($a as $k => $v) {
            if(is_array($v)) {
                $a[$k] = self::array_3rd_double_only_helper($a[$k]);
            } else {
                if(!(is_float($v) || is_int($v))) {
                    unset($a[$k]);
                }
            }
        }
        return $a;
    }
    function array_3rd_double_only($recursive = FALSE) {
        if($recursive == FALSE) {
            foreach($this -> myArray as $k => $v) {
                if(is_array($v)) {
                    unset($this -> myArray[$k]);
                } else {
                    if(!(is_float($v) || is_int($v))) {
                        unset($this -> myArray[$k]);
                    }
                }
            }
            return $this;
        } elseif($recursive == TRUE) {
            $this -> myArray = self::array_3rd_double_only_helper($this -> myArray);
            return $this;
        }
    }

    /**
     *  将数组用JSON格式表示
     *
     * @return string
     */
    function _array_3rd_toJSON() {
        return json_encode($this -> myArray);
    }

    /**
     *  剔除数组中在 $without 数组内的元素，递归调用
     *
     * @param mixed $without
     * @param array $arr
     *
     * @return object
     */
    function array_3rd_without($without = '', $for = 'value', & $a = 'self') {
        if($a == 'self') {
            $a = &$this -> myArray;
        }
        switch($for) {
            case 'value' :
                $p = 'v';
                break;
            case 'key' :
                $p = 'k';
                break;
        }
        foreach ($a as $k => $v) {
            if (is_array($v)) {
                $this -> array_3rd_without($without, $for, $a[$k]);
            } else {
                $$p = trim($$p);
                switch(gettype($without)) {
                    case 'array' :
                        if(in_array($$p,$without)) {
                            unset($a[$k]);
                        }
                        break;
                    case 'string' :
                        if(strpos($without, '/') !== 0) {
                            if($$p == $without) {
                                unset($a[$k]);
                            }
                            break;
                        } elseif (strpos($without, '/') === 0) {
                            if(preg_match($without, $$p)) {
                                unset($a[$k]);
                            }
                        }
                }
            }
        }
        return $this;
    }

    /**
     * 将浮点数变成整数，给 array_flip(), array_count_values() 准备
     *
     * @param boolean $recursive
     * @param string $func
     *
     * @return object
     */
    static function array_3rd_float2int_helper($a, $func) {
        foreach($a as $k => $v) {
            if(is_array($v)) {
                $a[$k] = self::array_3rd_float2int_helper($a[$k], $func);
            } else {
                if(is_float($v) && !is_int($v)) {
                    $a[$k] = (int)$func($a[$k]);
                }
            }
        }
        return $a;
    }
    function array_3rd_float2int($recursive = FALSE, $func = 'ceil') {
        if($recursive == FALSE) {
            foreach($this -> myArray as $k => $v) {
                if(is_float($v)) {
                    $this -> myArray[$k] = (int)$func($v);
                }
            }
            return $this;
        } elseif($recursive == TRUE) {
            $this -> myArray = self::array_3rd_float2int_helper($this -> myArray, $func);
            return $this;
        }
    }

}
