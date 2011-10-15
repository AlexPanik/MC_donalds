<h1><?php echo $title; ?></h1>
<br>
<script>
	function load_ingridients(){
		$.post("/json.php", { mode: "ingr_user", city: $('#s_city').val() },
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
		<div class="label">Продукция:</div><div class="value"><input type="text" name="name_ru"></div><br><br>
		<div class="label">Город:</div>
		<div class="value">
		<select name="city" id="s_city">
			<option value="0">Есть во всех городах</option>
			<?php foreach($citys as $key=>$val): ?>
			<option value="<?php echo $val['id'] ?>"><?php echo $val['name_ru'] ?></option>	
			<?php endforeach; ?>
		</select>
		</div><br><br>
		<div id="d_ingr"></div>
		<div class="label"><input type="submit" value="Добавить"></div>
	</div>
</form>
