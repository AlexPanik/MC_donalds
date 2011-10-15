<h1><?php echo $data['name_ru'] ?></h1>
<h2>Состав:</h2>
<?php foreach($ingr as $key=>$val){  
		foreach($allIngr as $k=>$v){  
			if($val['id']==$v['id'] && $val['ingr']!=''){
				echo  $v['name_ru'].': '.$val['ingr'].'<br>';
			}
			//print_r($val); 
		} 
	  }
 ?>
<h2>Город:</h2>
<?php 
	if($data['city_id']==0)
	echo 'Используется во всех городах';
	else
	foreach($citys as $k=>$v){
		if($v['id']==$data['city_id']){
			echo $v['name_ru'];
		}
	}

?>


<br><br>
<a href="/">Вернуться назад</a>