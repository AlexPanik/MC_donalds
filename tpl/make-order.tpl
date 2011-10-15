<a href="/">Вернуться назад</a>
<h1>Заказ<span id="cst"></span></h1>
<script>
	function load_prod(){
		$.post("/json.php", { mode: "order_prod", city: $('#s_city').val() },
	   function(data) {
		 $('#d_ingr').html(data);
	   });
	}
	function load_pack(){
		$.post("/json.php", { mode: "order_prod_pack", city: $('#s_city').val() },
	   function(data) {
		 $('#s_package').html(data);
	   });
	}
	function load_disc(){
		$.post("/json.php", { mode: "order_prod_disc", city: $('#s_city').val() },
	   function(data) {
		 $('#s_discount').html(data);
	   });
	}
	function load_prod_by_disc(){
		$.post("/json.php", { mode: "order_prod_by_disc", city: $('#s_city').val() , disc: $('#s_discount').val()},
	   function(data) {
		 $('#d_ingr').html(data);
	   });
	}	
	function get_cost(){
		var koli=$('#last_ingr').val();
		var url='';
		for(i=0; i<=koli; i++){
			if(i==0)
				url+='?';
			else
				url+='&';
			url+='ingr_'+i+'='+$('#ingr_'+i).val()+'&ingrid_'+i+'='+$('#ingrid_'+i).val();
		}
		
		
		$.post("/json.php"+url, { mode: "get_cost", pack: $('#s_package').val() , kol: $('#last_ingr').val(), disc: $('#s_discount').val()},
	   function(data) {
		 $('#cst').html(data);
		 
	   });
	}
	$(document).ready(function () {
		load_prod();
		load_pack();
		load_disc();
		$('#s_city').change(function() {
			load_prod();
			load_pack();
			load_disc();
		});
		$('#s_discount').change(function() {
			load_prod_by_disc();
		});
		$('#b_prise').click(function() {
			get_cost();
		});
	});
</script>
<div class="form">
	<div class="label">Город:</div>
	<div class="value">
		<select name="city" id="s_city">
			<option value="0">Есть во всех городах</option>
			<?php foreach($citys as $key=>$val): ?>
			<option value="<?php echo $val['id'] ?>"><?php echo $val['name_ru'] ?></option>	
			<?php endforeach; ?>
		</select>
	</div><br><br>
	<hr>
	<div id="d_ingr"></div>
	<hr>
	<div class="label">Упаковка:</div>
	<div class="value">
		<select name="package" id="s_package">	
			<option value="0">Без упаковки</option>
		</select>
	</div><br><br>
	<hr>
	<div class="label">Скидка:</div>
	<div class="value">
		<select name="discount" id="s_discount">	
			<option value="0">Без скидки</option>
		</select>
	</div><br><br>
	<hr>
	<input type="button" value="Какая цена?" id="b_prise">
</div>
