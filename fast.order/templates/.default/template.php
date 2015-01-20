<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>

<?
$sf = '';
if ($arParams['SUPER_FAST'] != 'Y') $sf = '_sf';

$price_id = $GLOBALS['CITY'] == 'Санкт-Петербург' ? 4837 : 4836;
$price_an = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 24, 'ID' => $price_id), false, array('nTopCount' => 1), array('PROPERTY_PRICE'))->Fetch();
$price_an = $price_an['PROPERTY_PRICE_VALUE'];
$analitic = "ga('send', 'event', 'Knopka', 'Podtverdit','ProbnoeMenuM',{$price_an});";
if ($arParams['SUPER_FAST'] == 'Y') {
	$analitic = "ga('send', 'event', 'Knopka1', 'Podtverdit','ProbnoeMenuM',{$price_an});";
}
?>

<div class="fast-order">
	<h2><?=$arParams['TITLE']?></h2>
	<?if($arResult['SUCCESS'] == 'Y'):?>
		<span class="fast-ifo fast-success"><?=$arResult['SUCCESS_MSG']?></span>
		<script>
			$(function(){
				<?=$analitic?>
			});
		</script>
	<?elseif($arResult['ERROR'] == 'Y'):?>
		<span class="fast-error"><?=$arResult['ERROR_MSG']?></span>
	<?endif;?>
	<form method="POST">
		<input name="fio<?=$sf?>" type="text" placeholder="Фамилия, Имя" value="<?=$_REQUEST['fio'.$sf]?>">
		<input name="phone<?=$sf?>" type="text" placeholder="Телефон" value="<?=$_REQUEST['phone'.$sf]?>">
		<input name="email<?=$sf?>" type="text" placeholder="Эл-Почта" value="<?=$_REQUEST['email'.$sf]?>">
		<input name="fastordersend<?=$sf?>" type="submit" class="green-but" value="Отправить">
	</form>
</div>