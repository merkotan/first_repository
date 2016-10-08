<?php 
//----------------------------------------------------------------------------------------//
//					Б А З А   Д А Н Н Ы Х    подключение
//----------------------------------------------------------------------------------------//
	class Tools{
		static function connect($host, $user, $pass, $dbname){
			//строка подключения
			$dsn='mysql:host='.$host.';dbname='.$dbname.';charset=utf8;';
			//массив с исключениями
			$options=array(
					 PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
					 PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
					 PDO::MYSQL_ATTR_INIT_COMMAND=>'set names utf8');
			//создаем объект pdo
			$pdo=new PDO($dsn, $user, $pass, $options);
			return $pdo;
		}

		static function createTable($query){
			$pdo=Tools::connect('localhost', 'root', '123456', '08862_store_db');
			$pdo->query($query);
		}
	}

//----------------------------------------------------------------------------------------//
//					Т О В А Р Ы    для интернет-магазина заносим в БД
//----------------------------------------------------------------------------------------//
	class Product{
		private $id, $product, $group_id, $country, $price, $discount, $info, $datein;

		function __construct($product, $group_id, $country, $price=0, $info="", $id=0){
			$this->product=$product;
			$this->group_id=$group_id;
			$this->country=$country;
			$this->price=$price;
			$this->info=$info;
			$this->id=$id;
			$this->discount=0;
			$this->datein=@date("Y/m/d"); 			// @ - для подавления warning'ов     date("Y/m/d h:i:s") для даты и времени
		}

		function intoDB(){
			$ins='insert into products (product, group_id, country, price, discount, info, datein) 
			values ("'.$this->product.'",'.$this->group_id.',"'.$this->country.'",'.$this->price.','.$this->discount.',"'.$this->info.'","'.$this->datein.'")';
			$pdo = Tools::connect('localhost', 'root', '123456', '08862_store_db');
			$pdo->query($ins);
		}

		static function fromDB($id){
			$pdo = Tools::connect('localhost', 'root', '123456', '08862_store_db');
			$sel ='select * from products where id=?';
			$res = $pdo->prepare($sel); ///prepare когда есть where,
			$res->execute(array($id));
			$product=''; $group_id=''; $country=''; $price=''; $info=''; $id='';
			foreach ($res as $v) {//перебирает в объекте его свойства
				$product=$v['product'];
				$group_id=$v['group_id'];
				$country=$v['country'];
				$price=$v['price'];
			//	$info=$v['info'];
				$id=$v['id'];
			}
			$product = new Product($product, $group_id, $country, $price, $info, $id);
			return $product;
		}

		function draw(){
			echo '<div class="product">';
			echo '<p class="ptitle">'.$this->product.'</p>';
			$pdo = Tools::connect('localhost', 'root', '123456', '08862_store_db');

//вывод фотографий товара
			echo '<div class="pphoto">';
			$res = $pdo->prepare('select * from images where product_id=?');
			$res-> execute(array($this->id));
			foreach ($res as $v) {
				echo '<img src="'.$v['path'].'" width="200px" height="" alt="picture"/>';
				break;
			}
			echo '</div>';
			echo '<p><span class="country">'.$this->country.'</span></p>';
			echo '<p><span class="price"  >$'.$this->price.'  </span></p>';
			echo '<div class="pinfo"   >'.$this->info.'   </div>';

			echo '<a href="pages/product_info.php?pid='.$this->id.'" target="_blank">Details</a>';
			echo '<br/>';
			echo '<button type="submit" name="into'.$this->id.'" class="btn btn-success btn-xs">
			Add to Cart</button>';

			echo '</div>';
		}
	
		function forCart($id){
			//можно сделать в таблице вывод
			$pdo=Tools::connect('localhost', 'root', '123456', '08862_store_db');
			$sel ='select * from products where id=?';
			$res = $pdo->prepare($sel);
			$res-> execute(array($id));
			echo '<div>';
				foreach ($res as $v) {
					
					echo ' '.$v['product'].
					     ' '.$v['price'].
					'<a href="pages/product_info.php?pid='.$v['id'].'" target="_blank">info</a>';
				}

				$res = $pdo->prepare('select * from images where product_id=?');
				$res-> execute(array($this->id));
				foreach ($res as $v) {
					echo '<img src="'.$v['path'].'" width="200px" alt="picture"/>';
					break;
				}

				echo '<button type="submit" class="btn btn-danger btn-xs" name="del'.$id.' ">X</button>';
			echo '</div>';
		}

	}

 ?>