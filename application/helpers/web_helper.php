<?php
defined('BASEPATH') or exit('No direct script access allowed');

function text_center($val = '')
{
	$result = '<div class="text-center">'.$val.'</div>';
	return $result;
}

function text_right($val = '')
{
	$result = '<div class="text-right">'.$val.'</div>';
	return $result;
}

function search_datatable($kolom = [], $search = '')
{
    $condition = '';
    if ($search != '') {
        $condition .= ' AND (';
        for ($i = 0; $i < count($kolom); $i++) {
            $condition .= $kolom[$i]." LIKE '%$search%' ";
            if ($kolom[$i] != end($kolom)) {
                $condition .= ' OR ';
            }
        }
        $condition .= ')';
    }

    return $condition;
}

function order_datatable($kolom_order = [], $column = '', $dir = '')
{
    $order = '';
    if ($column != '' && $dir != '') {
        $col = isset($kolom_order[$column]) ? $kolom_order[$column] : '';

        if ($col != '') {
            $order .= " ORDER BY $col $dir ";
        }
    }

    return $order;
}

function response_datatable($draw = '', $total_filtered = 0, $data = [])
{
    $arr = array(
        'draw' => $draw,
        'recordsFiltered' => $total_filtered,
        'recordsTotal' => $total_filtered,
        'data' => $data
    );

    return $arr;
}