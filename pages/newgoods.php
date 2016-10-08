
<?php 
include_once('pages/classes.php');
 ?>
<div class="container-fluid">
	<div class="row">
	<div class="col col-md-4 col-sm-2 col-xs-1">
	<form action="index.php?id=4" method="post" >

		<div class="form-group">
			<label for="group_id">Group:</label>
			<select name="group_id" class="form-control">
			<?php 
				$pdo=Tools::connect('localhost', 'root', '123456', '08862_store_db');
				$res=$pdo->query('select * from groups');
				while($row = $res->fetch()){
					echo '<option value="'.$row['id'].'">'.$row['groupname'].'</option>';
				}
			?>
			</select>
 		</div>
 		<div class="form-group">
			<label for="product">Item:</label>
			<input type="text" class="form-control" name="product"/>
			<?php 
			
			?>
		</div>
 		<div class="form-group">
			<label for="country">Maker:</label>
			<input type="text" class="form-control" name="country"/>
			<?php 
			
			?>
 		</div>
 		<div class="form-group">
			<label for="price">Price:</label>
			<input type="number" class="form-control" name="price"/>
			<?php 
			
			?>
 		</div>
 		<div class="form-group">
 			<label for="info">Info:</label>
 			<textarea name="info" class="form-control">
 			</textarea>
 		</div>
 		<div class="form-group">
 			<input type="reset" class="btn btn-default" name="reset"/>
			<input type="submit" class="btn btn-default" name="addproduct"/>
 		</div>
 	</form>
	<?php
	if(isset($_POST['addproduct'])){
		$product=trim(htmlspecialchars(($_POST['product'])));
		$country=trim(htmlspecialchars(($_POST['country'])));
		$info=trim(htmlspecialchars(($_POST['info'])));

		if(empty($product)) return;

		$ins='insert into products (product, group_id, country, price, discount, info, datein) 
			values ("'.$product.'",'.$_POST["group_id"].',"'.$country.'",'.$_POST['price'].',0,"'.$info.'","'.@date('Y/m/d').'")';
			$pdo = Tools::connect('localhost', 'root', '123456', '08862_store_db');
			$pdo->query($ins);
	}

	?>
</div>
<div class="col col-md-4 col-sm-2 col-xs-1">

<form action="index.php?id=4" method="post" enctype="multipart/form-data">
	<div class="form-group">

<?php 	
/*------------------ЗАГРУЗКА ФОТО ТОВАРОВ------------------------------------------------*/


	$pdo=Tools::connect('localhost', 'root', '123456', '08862_store_db');
	$sel='select id, product from products';
	$res=$pdo->query($sel);
	echo '<label for product>Choose item: </label>		  
		<select name="product_id" class="form-control">';
	while ($row=$res->fetch()) {
		echo '<option value = "'.$row['id'].'">'.$row['id'].' '.$row['product'].'</option>';
	}
	echo '</select>';

?>

	<br/>
	<label for="file">Choose photos for item:</label>
	<br/>
	<input type="file" name="file[]" multiple="multiple" accept="image/*" />
	<br/>
	<input type="reset" class="btn btn-default" name="reset"/>
	<input type="submit" class="btn btn-default" name="add_img"/>

<?php 
	if (isset($_POST['add_img'])){
		$path="images/";
		$count=0;
	foreach ($_FILES['file']['name'] as $k => $v) {
			if ($_FILES['file']['error'][$k]>0) continue;
			if (move_uploaded_file($_FILES['file']['tmp_name'][$k], $path.$v )){
				$count++;
				$product_id=$_POST['product_id'];
				echo '<br/>'.$product_id.'<br/>'.$path.$v.'<br/>';
			$ins='insert into images (product_id, path) values ('.$product_id.',"'.$path.$v.'")';
			$pdo = Tools::connect('localhost', 'root', '123456', '08862_store_db');
			$pdo->query($ins);
			}
		}	
	}
echo '</form>';
 ?>
	</div>
	</form>
</div>
</div>
	
</div>
