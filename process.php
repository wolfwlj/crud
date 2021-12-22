<?php
session_start();




$serverName = "localhost";
$dBUsername = "u482055086_Test1234";
$dBPassword = "Test1234";
$dBName = "u482055086_Test1234";

$mysqli = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
  }

$id = 0;
$update = false;
$naam = '';
$grade = '';
$prijs = '';
$platform = '';
$seal = '';
$img = '';



if (isset($_POST['save'])){
    $naam = $_POST['naam'];
    $grade = $_POST['grade'];
    $prijs = $_POST['prijs'];
    $platform = $_POST['platform'];
    $seal = $_POST['seal'];
    $img = $_POST['img'];

    $prep1 = $mysqli->prepare("INSERT INTO data (naam, grade, prijs, console, sealed, img) VALUES(?, ?, ?, ?, ?, ?)");
    $prep1->bind_param("ssisss", $naam, $grade, $prijs, $platform, $seal, $img);
    $prep1->execute();
    //$mysqli->query("INSERT INTO data (naam, grade, prijs, console, sealed, img) VALUES('$naam', '$grade', $prijs, '$platform', '$seal', '$img')");


    if(is_numeric($prijs)){
        $_SESSION['message'] = "Opgeslagen!!";
        $_SESSION['msg_type'] = "success";

    }else{
        $_SESSION['message'] = "Foute input!!!";
        $_SESSION['msg_type'] = "warning";
    }


    header("location: collectie.php");
}

if(isset($_GET['delete'])) {
    $id = $_GET['delete'];


    $poop = $mysqli->prepare("DELETE FROM data WHERE id=?");
    $poop->bind_param('i',$id);
    $poop->execute();


    $_SESSION['message'] = "Verwijdert!!";
    $_SESSION['msg_type'] = "danger";

    header("location: collectie.php");

}
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    //$result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    $sql = "SELECT * FROM data WHERE id=?";
    $result5 = $mysqli->prepare($sql);
    $result5->bind_param('i', $id);
    $result5->execute();
    $result = $result5->get_result();

        if(count($result)==1){
            $row = $result->fetch_array();
            $naam = $row['naam'];
            $grade = $row['grade'];
            $prijs = $row['prijs'];
            $platform = $row['console'];
            $seal = $row['sealed'];
            $img = $row['img'];
        }
}



if(isset($_POST['update'])){
    $id = $_POST['id'];
    $naam = $_POST['naam'];
    $grade = $_POST['grade'];
    $prijs = $_POST['prijs'];
    $platform = $_POST['platform'];
    $seal = $_POST['seal'];
    $img = $_POST['img'];

   // $mysqli->query("UPDATE data SET naam='$naam', grade='$grade', prijs='$prijs', console='$platform', sealed='$seal', img='$img' WHERE id=$id");
    $result2 = $mysqli->prepare("UPDATE data SET naam=?, grade=?, prijs=?, console=?, sealed=?, img=? WHERE id=?");
    $result2->bind_param('ssisssi', $naam, $grade, $prijs, $platform, $seal, $img, $id);     
    $result2->execute();


    if(is_numeric($prijs)){
        $_SESSION['message'] = "Opgeslagen!!";
        $_SESSION['msg_type'] = "success";

    }else{
        $_SESSION['message'] = "Foute input!!!";
        $_SESSION['msg_type'] = "warning";
    }


    header("location: collectie.php");

}
?>