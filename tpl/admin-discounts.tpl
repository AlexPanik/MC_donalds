<?php if($action=='main'){ ?>
<h1>Список скидок</h1>
<?php if(sizeof($data)==0){ ?>
	<h5>В базе нету скидок</h5>
<?php }else{   ?>
	<table border="1px">
		<tr><th>ID</th><th>Название скидки</th><th>Принадлежность к городу</th><th>Скидка</th><th>Редактирование</th></tr>
		<?php 
			foreach($data as $key=>$val){
				$tek_city='';
				if($val['city_id']==0){
					$tek_city='Используется во всех городах';
				}else{
					foreach($citys as $k=>$v){
						if($v['id']==$val['city_id']){
							$tek_city=$v['name_ru'];
						}
					}
				}
				
				
				echo '<tr><td>'.$val['id'].'</td><td>'.$val['name_ru'].'</td><td>'.$tek_city.'</td><td>'.$val['interest'].'%</td><td><a href="javascript:if (confirm(\'Редактировать?\')) document.location.href = \'/admin-discounts/edit/'.$val['id'].'/\'">Редактировать</a> / <a href="javascript:if (confirm(\'Удалить?\')) document.location.href = \'/admin-discounts/del/'.$val['id'].'/\'">Удалить</a></td></tr>';
				
			}
		?>
	</table>
<?php  } ?>
<br>
<a href="/admin-discounts/add/">Добавить скидку>></a><br>
<a href="/managment/">Вернуться назад</a>
<?php }elseif($action=='add'){ ?>
<h1>Добавление скидок</h1>
<br>
<script>
	function load_ingridients(){
		$.post("/json.php", { mode: "disc", city: $('#s_city').val() },
	   function(data) {
		 $('#d_ingr').html(data);
	   });
	}
	$(document).ready(function () {
		load_ingridients();
		$('#s_city').change(function() {
		  load_ingridients();
		});
		
		
	});
</script>
<form action="" method="POST">
	<div class="form">
		<div class="label">Название скидки:</div><div class="value"><input type="text" name="name_ru"></div><br><br>
		<div class="label">Скидка (%):</div><div class="value"><input type="text" name="interest"></div><br><br>
		<div class="label">Город:</div>
		<div class="value">
		<select name="city" id="s_city">
			<option value="0">Есть во всех городах</option>
			<?php foreach($citys as $key=>$val): ?>
			<option value="<?php echo $val['id'] ?>"><?php echo $val['name_ru'] ?></option>	
			<?php endforeach; ?>
		</select>
		</div><br><br>
		<div class="label">Применяется ко всей продукции:</div><div class="value"><input type="checkbox" name="all_production"></div><br><br>
		<div id="d_ingr"></div>
		<div class="label"><input type="submit" value="Добавить"></div>
	</div>
</form>


<?php }elseif($action=='edit'){ ?>
<h1>Редактирование скидок</h1>
<br>
<script>
	function load_ingridients(){
		$.post("/json.php", { mode: "disc_by_id", city: $('#s_city').val() , id: '<?php echo $data['id'];  ?>' },
	   function(data) {
		 $('#d_ingr').html(data);
	   });
	}
	$(document).ready(function () {
		load_ingridients();
		$('#s_city').change(function() {
		  load_ingridients();
		});
		
		
	});
</script>

<form action="" method="POST">
	<div class="form">
		<div class="label">Название скидки:</div><div class="value"><input value="<?php echo $data['name_ru']; ?>" type="text" name="name_ru"></div><br><br>
		<div class="label">Скидка ($):</div><div class="value"><input type="text" name="interest" value="<?php echo $data['interest']; ?>"></div><br><br>
		<div class="label">Город:</div>
		<div class="value">
		<select name="city" id="s_city">
			<option value="0">Есть во всех городах</option>
			<?php foreach($citys as $key=>$val): ?>
			<option value="<?php echo $val['id'] ?>" <?php if($val['id']==$data['city_id']){ echo'selected'; }  ?>><?php echo $val['name_ru'] ?></option>	
			<?php endforeach; ?>
		</select>
		</div><br><br>
		<div class="label">Применяется ко всей продукции:</div><div class="value"><input type="checkbox" <?php if($data['all_production']==1){ echo 'checked'; } ?> name="all_production"></div><br><br>
		<div id="d_ingr"></div>
		<div class="label"><input type="submit" value="Изменить"></div>
	</div>
</form>
<?php }?>