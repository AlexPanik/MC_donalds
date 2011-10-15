<h1><?php echo $title; ?></h1>
<br>
<a href="/make-hamburger/">Сделай свой гамбургер</a><br>
<a href="/make-order/">Сделай заказ</a><br>
<br>
<b>Доступная продукция:</b><br>
<?php foreach($pr as $key=>$val): ?>
	<a href="/production/<?php echo $val['id'] ?>/"><?php echo $val['name_ru'] ?></a><br>
<?php endforeach; ?>

<br>
<b>Бургеры пользователей:</b><br>
<?php foreach($urPr as $key=>$val): ?>
	<a href="/user-production/<?php echo $val['id'] ?>/"><?php echo $val['name_ru'] ?></a><br>
<?php endforeach; ?>