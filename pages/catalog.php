<?php
foreach ($_REQUEST as $k=>$v ) {
	if(substr($k,0,4)=='into'){
		$btn_id=substr($k,4);
		setcookie('cart'.$btn_id,$btn_id);
	}
}
include_once('classes.php');

$pdo=Tools::connect('localhost', 'root', '123456', '08862_store_db');

//--------------------------------------------------------------------------------//
// 				select  групп товаров 
//--------------------------------------------------------------------------------//
echo '
	<form action="index.php?id=1" method="post" class="form-inline">
	<p>';
	$res=$pdo->query('select * from groups');
echo '
	<label for group_id>Choose item group: </label>
	<select name="group_id" class="form-control">';
	while ($row=$res->fetch()) {
		echo '<option value = "'.$row['id'].'">'.$row['groupname'].'
		 	 </option>';
	}
echo '</select>
	  </p>';

//--------------------------------------------------------------------------------//
// 				вывод товаров на htmlстранице
//--------------------------------------------------------------------------------//
$sel='select id from products';//'select id from products where group_id=3'
$res=$pdo->query($sel);
while ($row=$res->fetch()) {
	$product=product::fromDB($row['id']);
	$product->draw();

}
echo '</form>';





/*for ($i=0; $i < 4; $i++) { 
	echo '
<div class="row">';
for ($j=0; $j < 4; $j++) { 
	echo '
<div class="col col-md-3 col-sm-2 col-xs-1" >
    <a href="#" class="thumbnail">
    <h3>Item</h3>
      <img src="http://placehold.it/300x200" alt="">
   	
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est sequi laudantium repellendus quam, corporis animi cum, aspernatur unde quidem autem voluptas. Explicabo maxime minima, ratione doloremque. Laudantium culpa illo dolores.</p>
	 </a>

</div>';}
echo '
</div>';
}
 */?>