<?php
	/**
	* see https://www.nidup.io/blog/manipulate-google-sheets-in-php-with-api
	* code examples ..
	*/
	require_once(__DIR__ . "/vendor/autoload.php");
	
	$client = new Google_Client();
	$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
	//$client->setAccessType('offline');

	$path = __DIR__ . '/credentials.json';
	$spreadsheetId = '1iJcRU_6rBqiSqjTh4gBfujjIEfW37WMfVG9miwkcBMg';
	$client->setAuthConfig($path);
	$service = new \Google_Service_Sheets($client);
	
	/* получение Spreadsheet object: */
//	$data = $service->spreadsheets->get($spreadsheetId);

	/* получение всех строк заданного листа */
	$sheet = 'Лист1';
//	$data = $service->spreadsheets_values->get($spreadsheetId, $sheet);

	/* получение нескольких строк используя диапазон */
/*	$cell_range = 'A1:D3';
	$range = $sheet . "!" . $cell_range;
	$response = $service->spreadsheets_values->get($spreadsheetId, $range);
	$data = $response->getValues();
*/
	/* обновление ячеек */
	$rows = [
		[date('Y-m-d H:i:s'), 3333, 333, 33],
		[date('Y-m-d H:i:s'), 2222, 222, 22]
	];
	$valueRange = new \Google_Service_Sheets_ValueRange();
	$valueRange->setValues($rows);
	$range = 'Лист1!A3:D4';
	$options = ['valueInputOption' => 'USER_ENTERED'];
	$data = $service->spreadsheets_values->update($spreadsheetId, $range, $valueRange, $options);

	print_r($data);
