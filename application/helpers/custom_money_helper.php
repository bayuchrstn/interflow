<?php 
// format uang ke juta / ribu  
function format_ribuan($param='')
{
	$jumlah = strlen($param); 
	if ($jumlah >= 7 && $jumlah < 10) {
		$param = round($param / 1000000, 0);
		$param = $param.' Juta';
	} else if($jumlah >= 5 && $jumlah < 7) {
		$param = round($param / 1000, 0);
		$param = $param.' Ribu';
	} else if ($jumlah >= 10 && $jumlah < 14) {
		$param = round($param / 1000000000, 0);
		$param = $param.' Milyar';
	} else if ($jumlah >= 14) {
		$param = round($param / 1000000000000, 0);
		$param = $param.' Trilyun';
	} else {
		$param = $param;
	}

	return $param;
}

function uang($angka='0', $style='1')
{
	if ($style == 1) {
		$uang = number_format($angka, 0, ".", ".");
	} else if ($style == 2) {
		$uang = number_format($angka, 0, ",", ",");
	} else {
		$uang = number_format($angka, 0, ".", ".");
		$uang = $uang.',00';
	}

	return $uang;
}
?>