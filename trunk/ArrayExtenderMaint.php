<?php
// $Id$
/**
 * Created at 2009.1.1 21:11
 * Updated at 2009.1.13
 * Version : beta 2.1
 * Author : Kelvin_gao
 *
 * 1php�������麯������:
 * 1.1 �����������أ�
 *   1. (172)array_change_key_case(); // OK
 *   2. (190)array_chunk();           // OK
 *   3. (204)array_count_values();    // OK
 *   4. (224)array_fill();            // OK
 *   5. (249)array_flip();            // OK
 *   6. (270)array_keys();            // OK
 *   7. (285)array_pad();             // OK
 *   8. (297)array_pop();             // OK �򻯲�������һ�ε���N��
 *   9. (309)array_push();            // OK ֧��һ�ε�����
 *   10.(334)array_rand();            // OK δ���
 *   11.(378)array_reverse();         // OK
 *   12.(395)array_shift();           // OK �򻯲�������һ������N��
 *   13.(409)array_slice();           // OK
 *   14.(421)array_splice();          // OK
 *   15.(444)array_unique();          // OK
 *   16.(459)array_unshift();         // OK ֧��һ�ε�����
 *   17.(481)array_values();          // OK
 *
 *   (505)sorter() ���
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
 * 1.2 ������������:
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
 * 1.3 �ص�������أ�(����)
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
 * 1.4 ���ط����飺
 *   1. (747)_array_key_exists();
 *   2. (765)_array_product();
 *   3. (788)_array_search();
 *   4. (802)_array_sum();
 *   5. (825)_count();
 *   6. (836)_in_array();
 *   7. (850)_sizeof();
 *
 * 1.5 ��������������
 *   1. compact();                    // ? û��
 *   2. extract();                    // ? û��
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
 * 2 ���ĺ���
 * (862)A::extend();
 * (897)_done();
 *
 * ˵����
 * �������������ò������顣
 *
 * �ŵ㣺 1.1 �����������
 *        1.2 �ṩ��չ�����������
 *        1.3 д��������ˣ��ɶ��ԡ��ɸ��Ժã�
 * ȱ�㣺 2.1 ʵ����ʵ����һ���࣬Ч����Ա����ú����ͣ�
 *        2.2 ����jsд�������ܷ��ϰ�ߣ�
 *
 * �÷�1��
 * A::extend($arr1,$arr2,$arr3,$arr4);       // ����һ������1�������25�������صĽ��ʹ��������Ϊ���������鶼������չ����
 *
 * �÷�2��
 * $testArr = new A(array(0,1,2,3,4,5));     // �½�һ��A��ʵ����ʹ�������չ����
 *
 * ʹ������ӿڣ���ΪA��ʵ�������� $method_1() -> $method_2() -> $method_n(); ��д����������ֱ�Ӳ������飬���ظ�ֵ����ʵ��
 *
 * ����д����
 * $testArr1 = array(0,1,2,3,4,5);
 * $testArr2 = array(10,11,12,13,14,15);
 * A::extend($testArr1, $testArr2);
 *
 * $testArr -> array_push('extended!') -> array_3rd_compact() -> array_merge($testArr2);
 * var_dump($testArr1 -> myArray);
 *
 * �޸Ľ��飺
 * 1. Ҳ�����ʹ�õ�ַ���ݸ���
 */
class A {
    private $myArray = array();
    function __construct($accepted_array) {
        $this -> myArray = $accepted_array;
    }
    function __destruct() {}

// ����ħ������ (magic function)
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
 * ���������
 */
    /**
     * array_change_key_case($case, FALSE)��ʾֻ�仯��һά����Ԫ�صļ����������������������䡣���Ԫ�������飬�򱻺��Բ�����һ�����漶�����
     * array_change_key_case($case, TRUE) ��ʾ��������Ԫ��������ʱ������������飬�������������еݹ�����仯��
     * $case �� ����ֵ�� CASE_UPPPER, CASE_LOWER
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
     * �� $size ��С�и�����
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
     * array_count_values(FALSE)��ʾ���������һάֵ���ֵĸ��������Ԫ�������飬�򱻺��Բ�����һ�����漶�����
     * array_count_values(TRUE) ��ʾԪ��������ʱ������������飬�����������ȡ��ֵ�����������㡣
     * ע�� ������ ������ ʱ����Ԫ�ر����Բ�����һ���������
     *
     * @param boolean $recursive
     *
     * @return object
     */
    function array_count_values($recursive = FALSE) {
        if($recursive == FALSE) {
            // ��Ҫ��д��������������
            $this -> myArray = array_count_values($this -> array_3rd_float2int(FALSE) -> _done());
            return $this;
        } elseif($recursive == TRUE) {
            $this -> myArray = array_count_values($this -> array_values(TRUE, FALSE) -> array_3rd_float2int(TRUE) -> _done());
        }
        return $this;
    }

    /**
     * �� $value ���������� $start_index ��ʼ ��� $num ����ͬ��Ԫ��
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
     * array_flip(FALSE)��ʾ��php��������ֵ�����Ԫ�������飬�򱻺��Բ�����һ�����漶�����
     * array_flip(TRUE) ��ʾԪ��������ʱ�����ּ������ݹ�����������
     * �κ�ֵΪ float, double ���ͽ�ǿ��ȥβ��ת��Ϊint, �� 10.1 ��� 10,  9.99 ��� 9�� ����ͬ�� -10.1 ��� -10.(������ָ���������)
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
            // Ҫ��д������������������
            $this -> myArray = array_flip($this -> array_3rd_float2int() -> _done());
            return $this;
        } elseif($recursive == TRUE) {
            $this -> myArray = self::array_flip_helper($this -> array_3rd_float2int(TRUE) -> myArray);
            //$this -> myArray = self::array_flip_helper($this -> myArray);
            return $this;
        }
    }

    /**
     * array_keys(FALSE)��ȡ��һάԪ�صļ��������Ԫ����ֵ���飬Ҳ���ݹ�
     * array_keys(TRUE) ��ʾ��ȡԪ�ص����м�������������������ĵڼ�ά
     * ����г�ȥ��ͬ�ļ������γ������飬��0������
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
     * array_pop($numbers) �����ջ$times�Σ�����ĩβԪ��
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
     * array_push() �����в������μ���ĩβ���޷������ַ�������
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
     * array_rand($number, FALSE, 'key')  ��ʾ�����ȡ$number�������һ��ļ�
     * array_rand($number, FALSE, 'value')��ʾ�����ȡ$number�������һ���ֵ
     * array_rand($number, TRUE, 'key')   ��ʾ�����ȡ$number������ļ����κ�һ��ļ����п���
     * array_rand($number, TRUE, 'value') ��ʾ�����ȡ$number�������ֵ���κ�һ���ֵ���п���
     * // array_rand($number, TRUE, 'both') ��ʾ�����ȡ$number ������ļ�ֵ�ԣ�δ��ɣ�
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
     * array_reverse(FALSE)��ʾ��php�ڲ���ʽ�������飬���Ԫ�������飬����ΪԪ�ص����鱾�����ţ��ڲ�Ԫ�ذ�ԭ��˳��
     * array_reverse(TRUE) ��ʾԪ��������ʱ������������飬���ּ��������������Ԫ�ص��š�
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
     * array_shift($numbers) ���������$times�Σ�������һ��Ԫ��
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
     * array_unique(FALSE)��ʾ��php�ڲ���ʽɾ���������ظ�ֵ�����Ԫ�������飬����ΪԪ�ص����鱾���仯
     * array_unique(TRUE) ��ʾԪ��������ʱ����������������飬�����������ɾ���ظ�ֵ
     * ע�����ּ�ֵ��
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
     * array_unshift() �����в������μ����ͷ���޷������ַ�������
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
     * array_values(FLASE, FALSE)��ʾ��php�ڲ���ʽ��ȡֵ�����Ԫ��ֵ�����飬������鱻������ֵ����
     * array_values(TRUE, FALSE) ��ʾ��ȡ���������ֵ���������Ƿ�������ĵڼ�ά�������ظ�ֵ
     * array_values(TRUE, TRUE)  ��ʾ��ȡԪ�ص�����ֵ���������Ƿ�������ĵڼ�ά���޳��ظ�ֵ
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
     * ԭ�ͺ��������Ե�������8���е��κκ���
     * �����ݹ����һ����������ϵ�еĺ���
     * ��sorter(FALSE, 'ksort') ��ʾ�ǵݹ���� ksort()
     * ��sorter(TRUE,  'ksort') ��ʾ�ݹ���� ksort()
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
     * shuffle(FALSE)��ʾ��php�ڲ���ʽ�������飬�����������ڲ�˳����Ӱ��
     * shuffle(TRUE)��ʾ�������飬���������ڲ�˳��Ҳ��Ӱ��
     * ע���޷����ּ�ֵ�ԣ� ��Ϊ���ַ�������ֵ��ʹ����˳��Ҳ�����塣�������ЩԪ�����ַ���������Щ���ǣ���һ�ɻ������ּ�
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
 * ���������
 */
    /**
     * ԭ�ͺ��������Ե�������9���е��κκ���
     * ��multicaller($array_b, 'array_combine') ��ʾarray_combine($array_b);
     * ��multicaller($array_b, 'array_merge') ��ʾarray_merge($array_b);
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
 * ���ط�����
 */
    /**
     * @param string $key
     * @param boolean $needle (��ָ��nullֵ�ļ���$needle Ϊ TRUE ʱ���� TRUE, $needle Ϊ FALSE ʱ���� FALSE)
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
     * ������������Ԫ�س˻�
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
     * ������������Ԫ�صĺ�
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
     * ��������Ԫ�ظ���
     *
     * @return int
     */
    function _count() {
        return count($this -> myArray);
    }

    /**
     * �ж�Ԫ���Ƿ������������
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
     * ��������Ԫ�ظ���
     *
     * @return int
     */
    function _sizeof() {
        return sizeof($this -> myArray);
    }


    /**
     * ���ĺ��������ô˷���ʵ������������
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
     * ���ص�ǰʵ����������顣�����鲻�����ⲿ�޸ģ�ֻ�������������ȡ
     *
     * @return array
     */
    function _done() {
        return $this -> myArray;
    }

/** ---------------------------------
 * 3rd functions ������������
 * ע������չphp�ڲ�����ʱ���в��ֺ�����array_values()�õ���array_3rd_flatten()�����������Ҫɾ������ע��
 *
 */
/**
 *       �����б�                ��չ����
 * 1. (928)array_3rd_clear()       ��ɿ�Ԫ������
 * 2. (941)array_3rd_compact()     �ȼ���array_3rd_without(array(NULL,'')) ��������пհ�Ԫ��
 * 3. (965)array_3rd_first()       ȡ�������е�һ����ֵ��Ԫ�أ��γɵ�Ԫ������
 * 4. (990)array_3rd_flatten()     ��Nά�����Ϊһά���飬ͬ����ʱ�����Ԫ��ֵ�����ǿ�ǰ��Ԫ��ֵ
 * 5. (1020)array_3rd_last()        ȡ��������ĩβԪ�أ��γɵ�Ԫ������
 * 6. (1047)array_3rd_array_only()  �޳������з�����Ԫ��
 * 7. (1073)array_3rd_double_only() �޳������з�����Ԫ��
 * 8. (1096)_array_3rd_toJSON()     ����JSON��ʽ���ַ���
 * 9. (1108)array_3rd_without()     �޳�����Ԫ���а����� $without �����еļ���ֵ��Ԫ��, ֧������������ʽ��������������ʽ���飬ֻ�����ַ�����
 *
 * 10. �����������и�������ָ��Ҫ��תΪ������
 */
    /**
     * �������
     *
     * @return object
     */
    function array_3rd_clear() {
        $this -> myArray = NULL;
        $this -> myArray = array();
        return $this;
    }

    /**
     * ���������е�δ�����NULL���ֵ
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
     * ȡ�������е�һ��Ԫ�أ��γɵ�Ԫ������
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
     * ����ά����ת����һά���飬�����ظ�ʱ�����ֵ�����ǿ�ǰ��ֵ
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
     * ȡ�����������һ��Ԫ�أ��γɵ�Ԫ������
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
     *  �޳������з�����Ԫ��
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
     *  ���������еĿ���������
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
     *  ��������JSON��ʽ��ʾ
     *
     * @return string
     */
    function _array_3rd_toJSON() {
        return json_encode($this -> myArray);
    }

    /**
     *  �޳��������� $without �����ڵ�Ԫ�أ��ݹ����
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
     * ������������������� array_flip(), array_count_values() ׼��
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
