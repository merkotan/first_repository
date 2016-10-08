<?php 

echo '<form action = "index.php?id=2" method="post">';

foreach ($_COOKIE as $k => $v) {
	if (substr($k, 0, 4) == 'cart'){
		$cid=substr($k, 4);
		$product=Product::fromDB($cid);
		$product->forCart($cid);
	}
}
echo '<button type="submit" class="btn btn success">Buy</button>';
echo '</form>';
 ?>