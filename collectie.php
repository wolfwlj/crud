<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>overZichtPagina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <link rel="stylesheet" href="styles/style1.css">
    <link rel="stylesheet" href="styles/style.css">

</head>
<body>
    <header>
        <nav>
            <img src="styles/images/logo.png" alt="#" class="logo">

            <ul>
            <li><a class="groter" href="index.html">Home</a></li>
            <li><a class="groter" href="collectie.php">My Collection</a></li>

            </ul>
        </nav>
    </header>
        <main>
            <div class="main-content">
                
            <?php require_once 'process.php';?>

<div class="">
<?php if (isset($_SESSION['message'])): ?>


<div class="alert alert-<?=$_SESSION['msg_type']?>">
<?php
echo $_SESSION['message'];
unset($_SESSION['message']);
?>
</div>
<?php endif?>
<?php
$mysqli = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);
$result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
//pre_r($result);
?>

<div >
        <form class="grid2" action="process.php" method="POST">
        <input type="hidden" name="id" value="<?=$id?>">

            <div class="griditems21">
                <label for="naam">Name</label><br>
                <input name="naam" type="text" value="<?=$naam;?>" class="" placeholder="Name of product">
            </div>



            <div class="griditems22">
                <label for="grade">Grade</label> <br>
                <input name="grade" type="text" value="<?=$grade;?>" class=""  placeholder="What grade is it?">
            </div>


            <div class="griditems23">
                <label for="prijs">Price ($)</label><br>
                <input name="prijs" type="text" value="<?=$prijs;?>" class=""  placeholder="Set the price here">
            </div>


            <div class="griditems24">
                <label for="platform">Platform</label><br>
                <input name="platform" type="text" value="<?=$platform;?>" class=""  placeholder="ps5,xbox, Switch etc...">
            </div>

            <div class="griditems25">
                <label for="seal">Seal</label><br>
                <input name="seal" type="text" value="<?=$seal;?>" class=""  placeholder="Input, Sealed of Non-Sealed">

            </div>
            <div class="griditems26">
                <label for="img">Image (has to be a link)</label><br>
                <input name="img" type="text" value="<?=$img;?>" class=""  placeholder="Right click a image online, click copy address.">

            </div>

            <div class="griditems27">
            <?php if ($update == true): ?>
                    <button  type="submit" class=""  name="update">Update</button>
                <?php else: ?>
                    <button  type="submit" class=""  name="save">Save</button>
                <?php endif;?>
            </div>

        </form>
    </div>


<div class="grid">
<?php
while ($row = $result->fetch_assoc()): ?>
<div class="doos">

                <p>Name : <span> <?=$row['naam']?></span></p>
                <p>Grade :<span> <?=$row['grade']?></span> </p>
                <p>Price :<span> <?=$row['prijs']?></span>$ </p>
                <p>Platform :<span> <?=$row['console']?></span> </p>
                <p>Seal :<span> <?=$row['sealed']?></span> </p>
                     <p>image : <img  class="imgUP" src="<?=$row['img']?>"> </img></p>

                <p>
                <button class="NICEMAN"><a href="collectie.php?edit=<?=$row['id']?>"
                    class="LINK">Edit</a></button>
                    <button class="NICEMAN"><a href="process.php?delete=<?=$row['id']?>"
                    class="LINK">Delete </a></button>
</p>
</div>
        <?php endwhile;?>
        </div>




<?php
function pre_r($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';

}
?>



    



     </div>
        </div>
 </div>

    </main>
<footer></footer>

    <script src="js/slideshow.js"></script>
</body>
</html>