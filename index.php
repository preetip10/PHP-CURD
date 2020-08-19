<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </head>
    <body class="container">

    <?php require_once("process.php"); ?>

    <?php if(isset($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['msg_type']; ?>">
        <?php echo $_SESSION['message']; 
            unset($_SESSION['message']);
        ?>
    </div>
    <?php endif; ?>

    <?php $result = $con->query("select * from data") or die($con->error); 
    /*echo '<pre>';
    print_r($result);
    echo '</pre>';*/?>
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php while( $row = $result->fetch_assoc()): ?>
                <tr>
                    <td> <?php echo $row['name'] ?></td>
                    <td> <?php echo $row['location'] ?></td>
                    <td> <a class="btn btn-info" href="index.php?edit=<?php echo $row['id'] ?>">Edit</td>
                    <td> <a class="btn btn-danger" href="index.php?delete=<?php echo $row['id'] ?>">Delete</td>
                </tr>
                <?php endwhile; ?> 
            </table>  
        </div>  

        <div class="row justify-content-center">
            <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo $id ?>" >
                <div class="form-group">
                    <lavel for="name">Name</lavel>
                    <input type="text" name="name" class="form-control"
                        value="<?php echo $name; ?>" placeholder="enter your name"> 
                </div>
                <div class="form-group">
                    <lavel for="location">Location</lavel>
                    <input type="text" name="location" class="form-control" 
                        value="<?php echo $location; ?>" placeholder="enter your location"> 
                </div>
                <div class="form-group">
                    <?php if($update == true): ?>
                        <button class="btn btn-info" type="submit" name="update">Update</button>
                    <?php else: ?>
                        <button class="btn btn-primary" type="submit" name="save">Save</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </body>
</html>