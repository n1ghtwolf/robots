<?
function get_web_page( $url )
{
  $uagent = "Opera/9.80 (Windows NT 6.1; WOW64) Presto/2.12.388 Version/12.14";

  $ch = curl_init ( $url );

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   // возвращает веб-страницу
  curl_setopt($ch, CURLOPT_HEADER, 0);           // не возвращает заголовки
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);   // переходит по редиректам
  curl_setopt($ch, CURLOPT_ENCODING, "");        // обрабатывает все кодировки
  curl_setopt($ch, CURLOPT_USERAGENT, $uagent);  // useragent
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120); // таймаут соединения
  curl_setopt($ch, CURLOPT_TIMEOUT, 120);        // таймаут ответа
  curl_setopt($ch, CURLOPT_MAXREDIRS, 10);       // останавливаться после 10-ого редиректа
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  
	  

  $content = curl_exec( $ch );
  $err     = curl_errno( $ch );
  $errmsg  = curl_error( $ch );
  $header  = curl_getinfo( $ch );
  curl_close( $ch );

  $header['errno']   = $err;
  $header['errmsg']  = $errmsg;
  $header['content'] = $content;
  return $header;
  
  
}

function size($url){
	$headers = get_headers($url, true);

if ( isset($headers['Content-Length']) ) {
	
	$presign= round($headers['Content-Length']/1024,2);
   $size = $presign."KB";
}
else {
   $size = 'file size: unknown';
}


return $size;
}

function generate_report($result,$exists,$page,$url)
{
		
	$red = array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'd41919')
        )
    );
	$green = array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '25d937')
        )
    );
	$grey =  array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'f5f0f0')
        )
    );
			
			$xls = new PHPExcel();
			$xls->setActiveSheetIndex(0);

		$sheet = $xls->getActiveSheet();
		$sheet->setTitle('Тest');
		$sheet->getColumnDimension('A')->setWidth(7);
		$sheet->getColumnDimension('B')->setWidth(35);
		$sheet->getColumnDimension('C')->setWidth(10);
		$sheet->getColumnDimension('D')->setWidth(15);
		$sheet->getColumnDimension('E')->setWidth(50);
		$sheet->setCellValue("A1", '№');
		$sheet->setCellValue("B1", 'Название проверки');
		$sheet->setCellValue("C1", 'Статус');
		$sheet->setCellValue("D1", '');
		$sheet->setCellValue("E1", 'Текущее состояние');
		$sheet->mergeCells('A2:E2');
		$sheet->getStyle('A1:E1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '919090'))));
		$sheet->getStyle('A2:E2')->applyFromArray($grey);
		$sheet->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$sheet->getDefaultStyle()->getAlignment()->setWrapText(true);	
		$sheet->setCellValue("B3",'Проверка наличия файла robots.txt');
		$sheet->mergeCells('C3:C4');
		$sheet->setCellValue("D3", 'Состояние');
		$sheet->setCellValue("D4", 'Рекомендации');
	
	
	

	if ($exists == TRUE)
	{			
		$sheet->mergeCells('A3:A4');
		$sheet->setCellValue("A3",'1');
		$sheet->mergeCells('B3:B4');
		$sheet->mergeCells('A5:E5');
		$sheet->mergeCells('A6:A7');
		$sheet->mergeCells('B6:B7');
		$sheet->mergeCells('C6:C7');
		$sheet->mergeCells('A8:E8');
		$sheet->mergeCells('A9:A10');
		$sheet->mergeCells('B9:B10');
		$sheet->mergeCells('C9:C10');
		$sheet->mergeCells('A11:E11');
		$sheet->mergeCells('A12:A13');
		$sheet->mergeCells('B12:B13');
		$sheet->mergeCells('C12:C13');
		$sheet->mergeCells('A14:E14');
		$sheet->mergeCells('A15:A16');
		$sheet->mergeCells('B15:B16');
		$sheet->mergeCells('C15:C16');
		$sheet->mergeCells('A17:E17');
		$sheet->mergeCells('A18:A19');
		$sheet->mergeCells('B18:B19');
		$sheet->mergeCells('C18:C19');
		$sheet->getStyle('A5:E5')->applyFromArray($grey);
		$sheet->getStyle('A8:E8')->applyFromArray($grey);
		$sheet->getStyle('A11:E11')->applyFromArray($grey);
		$sheet->getStyle('A14:E14')->applyFromArray($grey);
		$sheet->getStyle('A17:E17')->applyFromArray($grey);
		$sheet->getStyle('A20:E20')->applyFromArray($grey);
		$sheet->setCellValue("A12",'4');
		$sheet->setCellValue("B12",'Проверка размера файла robots.txt');
		$sheet->setCellValue("D12", 'Состояние');
		$sheet->setCellValue("D13", 'Рекомендации');
		$sheet->setCellValue("A18",'6');
		$sheet->setCellValue("B18",'Проверка кода ответа сервера для файла robots.txt');
		$sheet->setCellValue("D18", 'Состояние');
		$sheet->setCellValue("D19", 'Рекомендации');
		$sheet->setCellValue("A6",'2');
		$sheet->setCellValue("B6",'Проверка указания директивы Host');
		$sheet->setCellValue("D6", 'Состояние');
		$sheet->setCellValue("D7", 'Рекомендации');
		$sheet->setCellValue("A9",'3');
		$sheet->setCellValue("B9",'Проверка количества директив Host, прописанных в файле');
		$sheet->setCellValue("D9", 'Состояние');
		$sheet->setCellValue("D10", 'Рекомендации');
		$sheet->setCellValue("A15",'5');
		$sheet->setCellValue("B15",'Проверка указания директивы Sitemap');
		$sheet->setCellValue("D15", 'Состояние');
		$sheet->setCellValue("D16", 'Рекомендации');
		$sheet->setCellValue("B3",'Проверка наличия файла robots.txt');
		$sheet->mergeCells('C3:C4');
		$sheet->setCellValue("D3", 'Состояние');
		$sheet->setCellValue("D4", 'Рекомендации');
		$sheet->getStyle('C3:C4')->applyFromArray($green);
		$sheet->setCellValue("C3","ОК");
		$sheet->setCellValue("E3", 'Файл robots.txt присутствует');
		$sheet->setCellValue("E4", 'Доработки не требуются');

	if (size($url)<32)
	{
		$sheet->getStyle('C12')->applyFromArray($green);
		$sheet->setCellValue("C12","ОК");
		$sheet->setCellValue("E12", 'Размер файла robots.txt составляет '.size($url).', что находится в пределах допустимой нормы');
		$sheet->setCellValue("E13", 'Доработки не требуются');
	}
	else 
	{
		$sheet->getStyle('C12')->applyFromArray($red);
		$sheet->setCellValue("C12","Ошибка");
		$sheet->setCellValue("E12", 'Размер файла robots.txt составляет'.size($url).', что превышает допустимую норму');
		$sheet->setCellValue("E13", 'Программист: Максимально допустимый размер файла robots.txt составляем 32 кб. Необходимо отредактировть файл robots.txt таким образом, чтобы его размер не превышал 32 Кб');
	}
	if($result['http_code']==200)
	{
		$sheet->getStyle('C18')->applyFromArray($green);
		$sheet->setCellValue("C18","ОК");
		$sheet->setCellValue("E18", 'Файл robots.txt отдаёт код ответа сервера 200');
		$sheet->setCellValue("E19", 'Доработки не требуются');
	}
	else
	{
		$sheet->getStyle('C18')->applyFromArray($red);
		$sheet->setCellValue("C18","Ошибка");
		$sheet->setCellValue("E18", 'При обращении к файлу robots.txt сервер возвращает код ответа'. $result['http_code']);
		$sheet->setCellValue("E19", 'Программист: Файл robots.txt должны отдавать код ответа 200, иначе файл не будет обрабатываться. Необходимо настроить сайт таким образом, чтобы при обращении к файлу sitemap.xml сервер возвращает код ответа 200');
	}
	if (strripos($page,"host")==TRUE)
	{
		$host++;							
		$sheet->getStyle('C6')->applyFromArray($green);
		$sheet->setCellValue("C6","ОК");
		$sheet->setCellValue("E6", 'Директива Host указана');
		$sheet->setCellValue("E7", 'Доработки не требуются');
	}
	else
	{
		$sheet->getStyle('C6')->applyFromArray($red);
		$sheet->setCellValue("C6","Ошибка");
		$sheet->setCellValue("E6", 'В файле robots.txt не указана директива Host');
		$sheet->setCellValue("E7", 'Программист: Для того, чтобы поисковые системы знали, какая версия сайта является основных зеркалом, необходимо прописать адрес основного зеркала в директиве Host. В данный момент это не прописано. Необходимо добавить в файл robots.txt директиву Host. Директива Host задётся в файле 1 раз, после всех правил.');
	}
	if($host>1)
	{
		$sheet->getStyle('C6')->applyFromArray($red);
		$sheet->setCellValue("C9","Ошибка");
		$sheet->setCellValue("E9", 'В файле прописано несколько директив Host');
		$sheet->setCellValue("E10", 'Программист: Директива Host должна быть указана в файле толоко 1 раз. Необходимо удалить все дополнительные директивы Host и оставить только 1, корректную и соответствующую основному зеркалу сайта');
	}
	else 
	{
		$sheet->getStyle('C9')->applyFromArray($green);
		$sheet->setCellValue("C9","ОК");
		$sheet->setCellValue("E9", 'В файле прописана 1 директива Host');
		$sheet->setCellValue("E10", 'Доработки не требуются');
	}
	if (strripos($page,"sitemap")==TRUE)
	{
		$sheet->getStyle('C15')->applyFromArray($green);
		$sheet->setCellValue("C15","ОК");
		$sheet->setCellValue("E15", 'Директива Sitemap указана');
		$sheet->setCellValue("E16", 'Доработки не требуются');
	}
	else
	{
		$sheet->getStyle('C15')->applyFromArray($red);
		$sheet->setCellValue("C15","Ошибка");
		$sheet->setCellValue("E15", 'В файле robots.txt не указана директива Sitemap');
		$sheet->setCellValue("E16", 'Программист: Добавить в файл robots.txt директиву Sitemap');
	}
			$objWriter = new PHPExcel_Writer_Excel5($xls);
			$objWriter->save('test.xls');
	}
	else 
	{
		
		$sheet->getStyle('C3')->applyFromArray($red);
		$sheet->setCellValue("C3","Ошибка");
		$sheet->setCellValue("E3", 'Файл robots.txt отсутствует');
		$sheet->setCellValue("E4", 'Программист: Создать файл robots.txt и разместить его на сайте.');
			$objWriter = new PHPExcel_Writer_Excel5($xls);
			$objWriter->save('test.xls');
				
				
	}
	
}