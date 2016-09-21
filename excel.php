<?
require_once ('PHPExcel.php');
require_once('PHPExcel/Writer/Excel5.php');


// Создаем объект класса PHPExcel
$xls = new PHPExcel();
// Устанавливаем индекс активного листа
$xls->setActiveSheetIndex(0);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('Тest');
$sheet->getColumnDimension('A')->setWidth(7);
$sheet->getColumnDimension('B')->setWidth(35);
$sheet->getColumnDimension('C')->setWidth(10);
$sheet->getColumnDimension('D')->setWidth(15);
$sheet->getColumnDimension('E')->setWidth(40);

// Вставляем текст в ячейку A1
$sheet->setCellValue("A1", '№');
$sheet->setCellValue("B1", 'Название проверки');
$sheet->setCellValue("C1", 'Статус');
$sheet->setCellValue("D1", '');
$sheet->setCellValue("E1", 'Текущее состояние');
$sheet->getStyle('A1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('EEEEEE');

// Объединяем ячейки
$sheet->mergeCells('A2:E2');
$sheet->mergeCells('A3:A4');
$sheet->setCellValue("A3",'1');
$sheet->setCellValue("B3",'Проверка наличия файла robots.txt');
$sheet->setCellValue("C3",$arr);
$sheet->setCellValue("D1", '');
$sheet->mergeCells('A5:E5');
$sheet->mergeCells('A6:A7');
$sheet->mergeCells('A8:E8');
$sheet->mergeCells('A9:A10');
$sheet->mergeCells('A11:E11');
$sheet->mergeCells('A12:A13');
$sheet->mergeCells('A14:E14');
$sheet->mergeCells('A15:A16');
$sheet->mergeCells('A17:E17');
$sheet->mergeCells('A18:A19');

 
$objWriter = new PHPExcel_Writer_Excel5($xls);
$objWriter->save('test.xls');