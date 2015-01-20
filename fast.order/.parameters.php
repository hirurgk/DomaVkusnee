<? if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

$arComponentParameters = array(
	'PARAMETERS' => array(
		'IBLOCK_ID' => array(
			'NAME' => 'ID инфоблока',
			'TYPE' => 'STRING',
			'MULTIPLE' => 'N',
			'PARENT' => 'BASE',
		),
		'TITLE' => array(
			'NAME' => 'Заголовок',
			'TYPE' => 'STRING',
			'MULTIPLE' => 'N',
			'PARENT' => 'BASE',
		),
		'SUPER_FAST' => array(
			'NAME' => 'Очень быстрый заказ',
			'TYPE' => 'STRING',
			'MULTIPLE' => 'N',
			'PARENT' => 'BASE',
		),
		'CACHE_TIME'  =>  array('DEFAULT'=>3600),
	),
);
?>