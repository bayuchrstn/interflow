<?php
/* Add by - akbar */
function limit_str($str='', $limit=50)
{
    $result = '';
        if(!empty($str)) {
            $result = $str;
            if(strlen($str) > $limit) {
                $result = substr($str, 0, $limit) . '...';                
            }
        }
    return $result;
}
/* Add by - akbar */
function build_condition($arr = array(), $attr='') 
{
    $condition ='';
        if(!empty($arr)) {
            for ($i = 0; $i < count($arr); $i++) {
                $condition .= $arr[$i];
                if (end($arr) != $arr[$i]) {
                    $condition .= ' '.$attr.' ';
                } else {
                    $condition .= ' ';
                }
            }
        }
    return $condition;
}