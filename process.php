<?php
session_start();
$name = '';
$location = '';
$update = false;

$con = new mysqli('localhost','root','','curd') or die(mysqli_error($con));

if(isset($_POST['save'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];

    $con->query("insert into data (name, location) values ('$name', '$location')") or die($con->error());

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $con->query("delete from data where id= $id") or  die($con->error);

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

if(isset($_GET['edit'])) { 
    $id = $_GET['edit'];
    $result = $con->query("select * from data where id = '$id'") or die($con->error) ;
     /*echo '<pre>';
     print_r($result);
     echo '</pre>';
     exit;*/
    if (!is_null($result)) {
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
        $update = true;
    }
    
}

if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $result = $con->query("update data SET name = '$name', location = '$location' where id = $id") or die($con->error);

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header("location: index.php");
}