<?php

include "connect.php";
include "functions.php";

if(isset($_POST['delete'])) { 
    if(ISSET($_POST['check'])){
            $checked = $_POST['check'];
            for($i=0; $i < count($checked); $i++){
                $id = $checked[$i];
                $query = $db->prepare("DELETE FROM productdash WHERE id='$id'");
                $query->execute();
}
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;700;800;900&display=swap" rel="stylesheet">
    <title>scandiweb task</title>
</head>
<body>


    <?php 
    
        $do = (isset($_GET["do"]))? $_GET["do"] : "manage";


        if($do == "manage") {

            //fetch data from db
            
            $stmt = $db->prepare("SELECT * FROM productdash ORDER BY id DESC");
            $stmt->execute();
            $row = $stmt->fetchAll();
            
            
            ?>
                <div class="container">
                    <form action="" method="post">
                        <div class="header">
                            
                            <p>Product List </p>
                            <label for="chk_all">Select All
                                <input type="checkbox" id="chk_all" name="chk_all">
                            </label>
                            <a href="index.php?do=add" class="btn btn-primary manage"><i class="fa fa-plus"></i>ADD</a>
                            <button type="submit" class="confirm btn btn-danger" name="delete" id="delete-product-btn">MASS DELETE</button>
     
                        </div>
                        <div class="row">
                            <?php
                                foreach($row as $itm) {
                                    echo '<div class="col-sm-6 col-md-3 main">';
                                        echo '<div class="thumbnail box-item">';
                                            echo '<input type="checkbox" class="checkItem delete-checkbox" name="check[]" value=' . $itm["id"] . '>';
                                            echo $itm["SKU"] . "<br>";
                                            echo $itm["Name"] . "<br>";

                                            echo '<p class="price">' . $itm["Price"] . "$" . '</p>';

                                            if($itm["typeSwitcher"] == 1) {
                                                echo '<p>' . "Size: " . $itm["Size"] . " MB" . '</p>';
                                            }
                                            elseif($itm["typeSwitcher"] == 2) {

                                                echo '<p>' . "Dimension: " . $itm["Height"] . "x" . $itm["Width"] . "x" . $itm["Length"] . '</p>';
                                            }
                                            elseif($itm["typeSwitcher"] == 3) {

                                                echo '<p>' . "Weight: " . $itm["Weight"] . " KG" . '</p>';
                                            }
                        
                                        echo '</div>';
                                    echo '</div>';  
                            
                            }

                            ?>
                        </div>
                    </form>
                </div>
        <?php
        }
        elseif($do == "add") {?>
            <div class="container">
                <h1 class="text-center">add product</h1>
                <form  class="form-horizontal" action="?do=insert" method="POST">
                    <div class="form-group">
                        <label class="col-sm-6 offset-sm-3 control-label">sku</label>
                        <div class="col-sm-6 offset-sm-3">
                            <input type="text" class="form-control" name="sku">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6 offset-sm-3 control-label">name</label>
                        <div class="col-sm-6 offset-sm-3">
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6 offset-sm-3 control-label">price</label>
                        <div class="col-sm-6 offset-sm-3">
                            <input type="text" class="form-control" name="price" required="required">
                        </div>
                    </div>
                    <div class="form-group selection">
                        <label class="col-sm-6 offset-sm-3 control-label">type switcher</label>
                        <div class="col-sm-6 offset-sm-3">
                            <select name="switcher" required="required" title="must choose one">
                                <option value="0">type switcher</option>
                                <option value="1" rel="DVD">DVD</option>
                                <option value="2" rel="Furniture">Furniture</option> 
                                <option value="3" rel="Book">Book</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 offset-sm-3 cascade dvd">
                            <input type="text" class="form-control DVD" name="size" placeholder="Size (MB)" id="size">
                            <p>please provide size in MB</p>
                        </div>
                        <div class="col-sm-6 offset-sm-3 cascade frnt">
                            <input type="text" class="form-control Furniture" name="height" id="height" placeholder="Height (CM)">
                            <input type="text" class="form-control Furniture" name="width" id="width" placeholder="Width (CM)">
                            <input type="text" class="form-control Furniture" name="length" id="length" placeholder="Length (CM)">
                            <p>please provide dimensions in HxWxL</p>
                        </div>
                        <div class="col-sm-6 offset-sm-3 cascade book">
                            <input type="text" class="form-control Book" name="weight" id="weight" placeholder="Weight (KG)">
                            <p>please provide weight in KG</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 offset-sm-3">
                            <input type="submit" class="btn btn-primary form-control" value="Save">
                        </div>
                    </div>
                </form>
            </div>
        <?php 
        }
        elseif($do == "insert") {

            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $sku = $_POST["sku"];
                $name = $_POST["name"];
                $price = $_POST["price"];
                $switcher = $_POST["switcher"];
                $size = $_POST["size"];
                $height = $_POST["height"];
                $width = $_POST["width"];
                $length = $_POST["length"];
                $weight = $_POST["weight"];

                $formErrors = array();

                if(empty($name)) {
                    $formErrors[] = "required name";
                }
                if ($switcher == 0) {

                    $formErrors[] = "you must choose one of type switcher";
                }
                foreach($formErrors as $error) {

                    $themsg = '<div class="alert alert-danger" role="alert">' . $error . '</div>';

                    redirect($themsg, "back", 5);
                }
                if(empty($formErrors)) {

                    $stmt = $db->prepare("INSERT INTO productdash( SKU, Name, Price, typeSwitcher, Size, Height, Width, Length, Weight) 
                                        VALUES(:tsk, :tnm, :tpr, :tsw, :tsz, :thg, :twd, :tln, :twt ) ");
                        $stmt->execute(array(
                            "tsk"     => $sku, 
                            "tnm"     => $name, 
                            "tpr"     => $price, 
                            "tsw"     => $switcher,
                            "tsz"     => $size,
                            "thg"     => $height,
                            "twd"     => $width,
                            "tln"     => $length,
                            "twt"     => $weight
                            ));

                    $themsg = '<div class="alert alert-success" role="alert">' . $stmt->rowCount() . "record updated" . '</div>';

                    redirect($themsg);
                }
            }
            else
            {

                echo '<div class="container">';

                // calling redirect function 
                
                $themsg = '<div class="alert alert-danger" role="alert">sorry you aren\'t allowed to be here directly </div>';

                redirect($themsg);

                echo '</div>';
            }
            
        }
      
    
   
    
    
    ?>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/task.js"></script>
    
</body>
</html>



    