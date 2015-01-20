<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>

<form class="your-city" method="POST">
	<?if($arResult['SUCCESS'] == 'Y'):?>
		<span class="your-success"><?=$arResult['SUCCESS_MSG']?></span>
	<?elseif($arResult['ERROR'] == 'Y'):?>
		<span class="your-error"><?=$arResult['ERROR_MSG']?></span>
	<?endif;?>
	<div class="column-items">
		<label class="columns">
			<span class="col_lab">Фамилия, Имя : </span>
			<input name="fio" type="text" value="<?=$_REQUEST['fio']?>">
			<span class="col_imp">*</span>
		</label>
		
		<label class="columns">
			<span class="col_lab">Город : </span>
			<input name="city" type="text" value="<?=$_REQUEST['city']?>">
			<span class="col_imp">*</span>
		</label>
		
		<label class="columns">
			<span class="col_lab">Телефон : </span>
			<input name="phone" type="text" value="<?=$_REQUEST['phone']?>">
			<span class="col_imp">*</span>
		</label>
		
		<label class="columns">
			<span class="col_lab">Эл-Почта : </span>
			<input name="email" type="text" value="<?=$_REQUEST['email']?>">
			<span class="col_imp">*</span>
		</label>
		
		<label class="columns">
			<span class="col_lab">Ссылка на Ваш профиль в ВК или FB : </span>
			<input name="social" type="text" value="<?=$_REQUEST['social']?>">
		</label>
		
		<label class="columns">
			<span class="col_lab">Какую корзину собираетесь заказывать : </span>
			<select name="basket">
				<?foreach($arResult['BASKET_ITEMS'] as $k => $b):?>
					<option value="<?=$k?>" <?=($_REQUEST['basket'] == $k ? 'selected' : '')?>><?=$b?></option>
				<?endforeach;?>
			</select>
		</label>
		
		<label class="columns">
			<span class="col_lab">Комментарий : </span>
			<textarea name="comment"><?=$_REQUEST['comment']?></textarea>
		</label>
	</div>
	
	<div class="imp_note">* - Обязательные поля</div>
	
	<input type="submit" name="youcitysubmit" value="Отправить заявку" class="green-but">
</form>