<?php if($action=='main'){ ?>
<h1>Список городов</h1>
<?php if(sizeof($citys)==0){ ?>
	<h5>В базе нету городов</h5>
<?php }else{   ?>
	<table border="1px">
		<tr><th>ID</th><th>Название города</th><th>Редактирование</th></tr>
		<?php 
			foreach($citys as $key=>$val){
				echo '<tr><td>'.$val['id'].'</td><td>'.$val['name_ru'].'</td><td><a href="javascript:if (confirm(\'Редактировать?\')) document.location.href = \'/admin-citys/edit/'.$val['id'].'/\'">Редактировать</a> / <a href="javascript:if (confirm(\'Удалить?\')) document.location.href = \'/admin-citys/del/'.$val['id'].'/\'">Удалить</a></td></tr>';
			}
		?>
	</table>
<?php  } ?>
<br>
<a href="/admin-citys/add-city/">Добавить город>></a><br>
<a href="/managment/">Вернуться назад</a>
<?php }elseif($action=='add-city'){ ?>
<h1>Добавление города</h1>
<br>
<form action="" method="POST">
	<div class="form">
		<div class="label">Город:</div><div class="value"><input type="text" name="name_ru"></div><br><br>
		<div class="label"><input type="submit" value="Добавить"></div>
	</div>
</form>


<?php }elseif($action=='edit'){ ?>
<h1>Редактирование города</h1>
<br>
<form action="" method="POST">
	<div class="form">
		<div class="label">Город:</div><div class="value"><input value="<?php echo $city['name_ru']; ?>" type="text" name="name_ru"></div><br><br>
		<div class="label"><input type="submit" value="Изменить"></div>
	</div>
</form>
<?php }?>