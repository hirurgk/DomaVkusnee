<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

CModule::IncludeModule('iblock');

$arResult['SUCCESS'] = 'N';
$arResult['SUCCESS_MSG'] = '';
$arResult['ERROR'] = 'N';
$arResult['ERROR_MSG'] = '';

$basket_items = $arParams['BASKET_ITEMS'];
$arResult['BASKET_ITEMS'] = $basket_items;

if (isset($_REQUEST['youcitysubmit'])) {
	$name = htmlspecialchars($_REQUEST['fio']);
	$city = htmlspecialchars($_REQUEST['city']);
	$phone = $_REQUEST['phone'];
	$email = $_REQUEST['email'];
	$social = urldecode($_REQUEST['social']);
	$basket = $basket_items[$_REQUEST['basket']];
	if(strlen($basket) == 0) $basket = current($basket_items);
	$comment = htmlspecialchars($_REQUEST['comment']);
	
	if (strlen($name) == 0) {
		$arResult['ERROR'] = 'Y';
		$arResult['ERROR_MSG'] = 'Необходимо указать Имя';
	}
	else if (strlen($city) == 0) {
		$arResult['ERROR'] = 'Y';
		$arResult['ERROR_MSG'] = 'Необходимо указать Город';
	}
	else if (!preg_match('/^[0-9\-\s\(\)\+]+$/', $phone)) {
		$arResult['ERROR'] = 'Y';
		$arResult['ERROR_MSG'] = 'Телефон заполнен некорректно';
	}
	else if (!preg_match('/^[a-z0-9\.\-]+@[a-z0-9\.\-]+\.[a-z]{1,4}$/i', $email)) {
		$arResult['ERROR'] = 'Y';
		$arResult['ERROR_MSG'] = 'Эл-Почта заполнена некорректно';
	}
	
	if ($arResult['ERROR'] == 'N') {
		$arComment[0] = Array("VALUE" => Array ("TEXT" => $comment, "TYPE" => "text"));
		
		$arFields = array(
				"IBLOCK_ID" => $arParams['IBLOCK_ID'],
				"NAME" => $name,
				"ACTIVE" => "Y",
				"PROPERTY_VALUES" => array(
						"CITY" => $city,
						"PHONE" => $phone,
						"EMAIL" => $email,
						"SOCIAL" => $social,
						"BASKET" => $basket,
						"COMMENT" => $arComment,
				),
		);
		
		$el = new CIBlockElement;
		$res = $el->Add($arFields, false, false, false);
		
		if ($res) {
			$arResult['SUCCESS'] = 'Y';
			$arResult['SUCCESS_MSG'] = 'Спасибо! Ваша заявка успешно отправлена!';
			
			$arEventFields = array(
					'ID' => $res,
					'FIO' => $name,
					'PHONE' => $phone,
					'CITY' => $city,
					'EMAIL' => $email,
					'SOCIAL' => $social,
					'BASKET' => $basket,
					'COMMENT' => $comment,
			);
			CEvent::SendImmediate("NEW_VOTE_CITY", s1, $arEventFields, "N", 66);
		} else {
			$arResult['ERROR'] = 'Y';
			$arResult['ERROR_MSG'] = 'Заявка не была отправлена из-за неизвестной ошибки.';
		}
	}
}

$this->IncludeComponentTemplate();
?>