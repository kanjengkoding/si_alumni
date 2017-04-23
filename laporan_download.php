<?php

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Asia/Jakarta');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

// Ambil data kiriman
$tipe = $_GET["tipe"];
if (isset($_GET["id"])) {
	$id = $_GET["id"];
}
// Include fungsi
include 'global_fungsi.php';
// Ambil data sistem 
$setting_sistem = setting_sistem();

// Include PHPExcel 
require_once dirname(__FILE__) . '/lib/PHPExcel.php';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Noerman Agustiyan")
							 ->setLastModifiedBy("Noerman Agustiyan")
							 ->setTitle("Laporan anggota ".$tipe)
							 ->setSubject("Laporan anggota ".$tipe)
							 ->setDescription("Menampilkan laporan data anggota ".$tipe)
							 ->setKeywords("alumni database php");

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Laporan anggota '.$tipe);

// Header Title
$objPHPExcel->getActiveSheet()->setCellValue("B2", $setting_sistem['nama_sistem']." Laporan Anggota ".$tipe);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->setSize(20);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);

// Header Column Setting
$objPHPExcel->getActiveSheet()->mergeCells('B4:B5'); // No
$objPHPExcel->getActiveSheet()->mergeCells('C4:H4'); // Basic
$objPHPExcel->getActiveSheet()->mergeCells('I4:J4'); // Family
$objPHPExcel->getActiveSheet()->mergeCells('K4:R4'); // Contact
$objPHPExcel->getActiveSheet()->mergeCells('S4:V4'); // Parent
$objPHPExcel->getActiveSheet()->mergeCells('W4:AA4'); // Academic
$objPHPExcel->getActiveSheet()->getStyle('B4:W4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B4:W4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

// Height
$objPHPExcel->getActiveSheet()->getRowDimension(4)->setRowHeight(25);

// Width
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(25);

// Value
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B4', 'No')
            ->setCellValue('C4', 'Info Dasar')
            ->setCellValue('C5', 'Nama Lengkap')
            ->setCellValue('D5', 'Panggilan')
            ->setCellValue('E5', 'JK')
            ->setCellValue('F5', 'Tempat, Tgl Lahir')
            ->setCellValue('G5', 'Agama')
            ->setCellValue('H5', 'Alamat')
            ->setCellValue('I4', 'Info Keluarga')
            ->setCellValue('I5', 'Nama Pasangan')
            ->setCellValue('J5', 'Nama Anak')
            ->setCellValue('K4', 'Info Kontak')
            ->setCellValue('K5', 'No Rumah')
            ->setCellValue('L5', 'Handphone 1')
            ->setCellValue('M5', 'Handphone 2')
            ->setCellValue('N5', 'Pin BB')
            ->setCellValue('O5', 'Email')
            ->setCellValue('P5', 'Website')
            ->setCellValue('Q5', 'Facebook')
            ->setCellValue('R5', 'Twitter')
            ->setCellValue('S4', 'Info Orang Tua')
            ->setCellValue('S5', 'Ayah')
            ->setCellValue('T5', 'Ibu')
            ->setCellValue('U5', 'Wali')
            ->setCellValue('V5', 'Alamat Orang Tua')
            ->setCellValue('W4', 'Info Akademik')
            ->setCellValue('W5', 'Angkatan')
            ->setCellValue('X5', 'Thn Masuk')
            ->setCellValue('Y5', 'Thn Keluar')
            ->setCellValue('Z5', 'Kelas Terakhir')
            ->setCellValue('AA5', 'Catatan')
            ;

// Header style
$objPHPExcel->getActiveSheet()->getStyle('B4:AA5')->applyFromArray(
	array(
		'fill' => array(
			'type'  => PHPExcel_Style_Fill::FILL_SOLID,
			'color' => array('argb' => 'ccffcc')
		),
		'borders' => array(
			'top'    => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
			'left'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
			'right'  => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
			'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
		)
	)
);
$objPHPExcel->getActiveSheet()->getStyle('C4:W4')->applyFromArray(
	array(
		'borders' => array(
			'left'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
		)
	)
);
$objPHPExcel->getActiveSheet()->getStyle('C5:AA5')->applyFromArray(
	array(
		'borders' => array(
			'top'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'left'   => array('style' => PHPExcel_Style_Border::BORDER_THIN)
		)
	)
);

// Top Limit
$top_limit = 5;

// Isi
$no = 0;

// Tetapkan query berdasarkan tipe laporan
if ($tipe=="keseluruhan") {
	$data_list = ambil_data_global("aluni_v_anggota_lengkap", "*", "", "id_anggota ASC");
}
else if ($tipe=="regional") {
	$data_list = ambil_data_global("aluni_v_anggota_lengkap", "*", "provinsi = '$id'", "id_anggota ASC");
}
else {
	$data_list = ambil_data_global("aluni_v_anggota_lengkap", "*", "$tipe = '$id'", "id_anggota ASC");
}
	
foreach ($data_list as $dl) {
	$no++;
	$top_limit++;
	
	// Content style
	$objPHPExcel->getActiveSheet()->getStyle('B'.$top_limit.':AA'.$top_limit)->applyFromArray(
		array(
			'borders' => array(
				'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'left'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
				'right'  => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
				'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
			)
		)
	);

	// Set zebra color (odds number)
	if ($top_limit%2==1) {
		$objPHPExcel->getActiveSheet()->getStyle('B'.$top_limit.':AA'.$top_limit)->applyFromArray(
			array(
				'fill' => array(
				'type'  => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('argb' => 'e1eaea')
				)
			)
		);
	}

	// Set child
	$childrens = "";
	$dt_child  = explode("|", $dl["nama_anak"]);
	for ($i=0; $i < count($dt_child); $i++) { 
		if ($dt_child[$i]!="") {
			$childrens .= "> ".$dt_child[$i]."\n";
		}
	}

	// Content 
	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue("B".$top_limit, $no)
            ->setCellValue("C".$top_limit, $dl["nama_lengkap"])
            ->setCellValue("D".$top_limit, $dl["nama_panggilan"])
            ->setCellValue("E".$top_limit, $dl["jenis_kelamin"])
            ->setCellValue("F".$top_limit, $dl["tempat_lahir"].", ".$dl["tanggal_lahir"])
            ->setCellValue("G".$top_limit, $dl["agama"])
            ->setCellValue("H".$top_limit, $dl["kota"].", ".$dl["provinsi"]."\n".strip_tags($dl["alamat"]))
            ->setCellValue("I".$top_limit, $dl["nama_pasangan"])
            ->setCellValue("J".$top_limit, $childrens)
            ->setCellValue("K".$top_limit, $dl["no_rumah"])
            ->setCellValue("L".$top_limit, $dl["no_handphone"])
            ->setCellValue("M".$top_limit, $dl["no_handphone2"])
            ->setCellValue("N".$top_limit, $dl["pin_blackberry"])
            ->setCellValue("O".$top_limit, $dl["alamat_email"])
            ->setCellValue("P".$top_limit, $dl["alamat_website"])
            ->setCellValue("Q".$top_limit, $dl["facebook"])
            ->setCellValue("R".$top_limit, $dl["twitter"])
            ->setCellValue("S".$top_limit, $dl["nama_ayah"])
            ->setCellValue("T".$top_limit, $dl["nama_ibu"])
            ->setCellValue("U".$top_limit, $dl["nama_wali"])
            ->setCellValue("V".$top_limit, $dl["kota_orang_tua"].", ".$dl["provinsi_orang_tua"]."\n".strip_tags($dl["alamat_orang_tua"]))
            ->setCellValue("W".$top_limit, $dl["angkatan"])
            ->setCellValue("X".$top_limit, $dl["tahun_masuk"])
            ->setCellValue("Y".$top_limit, $dl["tahun_keluar"])
            ->setCellValue("Z".$top_limit, $dl["kelas_terakhir"])
            ->setCellValue("AA".$top_limit, strip_tags($dl["catatan"]))
            ;
}

// Wrap it
$objPHPExcel->getActiveSheet()->getStyle('B6:AA'.$top_limit)->getAlignment()->setWrapText(true);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$setting_sistem["nama_sistem"].' laporan anggota '.$tipe.' '.date('d/m/Y').'.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;


?>