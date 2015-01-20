<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

CModule::IncludeModule('iblock');

$arResult['SUCCESS'] = 'N';
$arResult['SUCCESS_MSG'] = '';
$arResult['ERROR'] = 'N';
$arResult['ERROR_MSG'] = '';

$sf = '';
if ($arParams['SUPER_FAST'] != 'Y') $sf = '_sf';

if (isset($_REQUEST['fastordersend'.$sf])) {
	$name = htmlspecialchars($_REQUEST['fio'.$sf]);
	if (strlen($name) == 0) $name = "Не указано";
	$city = $GLOBALS['CITY'];
	$phone = $_REQUEST['phone'.$sf];
	$email = $_REQUEST['email'.$sf];
	$super_fast = $arParams['SUPER_FAST'] == 'Y' ? 28 : '';	//28 - id значения списка
	
	if (!preg_match('/^[0-9\-\s\(\)\+]+$/', $phone)) {
		$arResult['ERROR'] = 'Y';
		$arResult['ERROR_MSG'] = 'Телефон заполнен некорректно';
	}
	else if (strlen($email) > 0 and !preg_match('/^[a-z0-9\.\-]+@[a-z0-9\.\-]+\.[a-z]{1,4}$/i', $email)) {
		$arResult['ERROR'] = 'Y';
		$arResult['ERROR_MSG'] = 'Эл-Почта заполнена некорректно';
	}
	
	if ($arResult['ERROR'] == 'N') {
		$arFields = array(
				"IBLOCK_ID" => $arParams['IBLOCK_ID'],
				"NAME" => $name,
				"ACTIVE" => "Y",
				"PROPERTY_VALUES" => array(
						"CITY" => $city,
						"PHONE" => $phone,
						"EMAIL" => $email,
						"SUPER_FAST" => array('VALUE' => $super_fast),
				),
		);
		
		$el = new CIBlockElement;
		$res = $el->Add($arFields, false, false, false);
		
		if ($res) {
			$arResult['SUCCESS'] = 'Y';
			$arResult['SUCCESS_MSG'] = 'Спасибо! Ваша заявка успешно отправлена!';
			$_REQUEST['fio'.$sf] = '';
			$_REQUEST['phone'.$sf] = '';
			$_REQUEST['email'.$sf] = '';
			
			$arEventFields = array(
					'ID' => $res,
					'FIO' => $name,
					'PHONE' => $phone,
					'CITY' => $city,
					'EMAIL' => $email,
					'SUPER_FAST' => ($super_fast ? 'Да' : 'Нет'),
			);
			CEvent::SendImmediate("NEW_FAST_ORDER", s1, $arEventFields, "N", 65);
		} else {
			$arResult['ERROR'] = 'Y';
			$arResult['ERROR_MSG'] = 'Заявка не была отправлена из-за неизвестной ошибки.';
		}
	}
}

$this->IncludeComponentTemplate();
?>