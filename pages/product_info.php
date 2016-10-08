<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link href="../css/bootstrap.min.css" rel="stylesheet"> 
<link rel="stylesheet" type="text/css" href="demo.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>

<title>details</title>   
</head>

<body>
<div class="container-fluid">
<div class="row">
 <div class="col col-md-4 col-sm-2 col-xs-2">    
    <?php 
    include_once('classes.php');
    $pid = $_REQUEST['pid'];
    $pdo = Tools::connect('localhost', 'root', '123456', '08862_store_db');

    $sel ='select * from products where id=?';
    $res = $pdo->prepare($sel);
    $res-> execute(array($pid));

    $row1=$res->fetch();                     //строка одна, поэтому цикла нет

    echo '<div class="product_info"><p class="ptitle">'.$row1['product'].'</p>'; 

    $sel ='select path from images where product_id=?';
    $res = $pdo->prepare($sel);
    $res-> execute(array($pid));
    while($row = $res->fetch()){
                echo '<img src="../'.$row['path'].'" width="400" height="280" alt="picture"/>';
                break;
                }
    echo '<p class="ptitle">Maker: '.$row1['country'].'</p>';
    echo '<p class="ptitle">Price: $'.$row1['price'].'</p>';
    echo '<p class="ptitle">Info: '.$row1['info'].'</p></div>';

?>
    </div>
<div class="col col-md-8 col-sm-10 col-xs-10">  

<div id="main">
    <div id="gallery">
    <div id="slides">
    <?php 
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
    </div>




</div>
</div>
</body>
</html>