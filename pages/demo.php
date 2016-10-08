<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Details</title>

<link rel="stylesheet" type="text/css" href="demo.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

<script type="text/javascript" src="script.js"></script>
</head>

<body>
<div class="container-fluid">
    <div class="row">
    <div class="col col-lg-2 col-md-2 col-sm-1 col-xs-1">
<div> <h1>Hellogit</h1></div>
    <?php 
    include_once('classes.php');
$pid = $_REQUEST['pid'];
$pdo = Tools::connect('localhost', 'root', '123456', '08862_store_db');

$sel ='select * from products where id=?';
$res = $pdo->prepare($sel);
$res-> execute(array($pid));

$row=$res->fetch();                     //строка одна, поэтому цикла нет

echo '<p>
Product: '.$row['product'].'</p>'; 
echo '<p>Maker: '.$row['country'].'</p>';
echo '<p>Price: '.$row['price'].'</p>';
echo '<p>Info: '.$row['info'].'</p></div>';


$sel ='select path from images where product_id=?';
$res = $pdo->prepare($sel);
$res-> execute(array($pid));
while($row = $res->fetch()){
                echo '<img src="../'.$row['path'].'" width="100" height="100" alt="picture"/>';
                break;
                }
echo '</div>';
echo '
<div class="col col-lg-2 col-md-2 col-sm-1 col-xs-1">
   <div id="main">
       <div id="gallery">
            <div id="slides">';
            $count=0; 
            $sel ='select path from images where product_id=?';
            $res = $pdo->prepare($sel);
            $res-> execute(array($pid));
            while($row = $res->fetch()){
                echo '
                    <div class="slide"><img src="../'.$row['path'].'" width="700" height="500" alt="side" /></div>';
                    $count++;
            }
?>   
            </div>
   
        <div id="menu">
        <ul>
            <li class="fbar">&nbsp;</li>
            <?php 
                $sel ='select path from images where product_id=?';
                $res = $pdo->prepare($sel);
                $res-> execute(array($pid));
                while($row = $res->fetch()){
                //   for ($i = 1; $i <= $count; $i++) {    echo $i;
                echo '
                <li class="menuItem"><a href=""><img src="../'.$row['path'].'" width="50" height="35" alt="thumbnail" /></a></li>
                ';}
            ?>
        </ul>
        </div>
        </div>
    </div>
</div></div>
</body>
</html>
