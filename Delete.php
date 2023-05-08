<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <style>
                body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        form {
            background-color: #black;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 300px;
            margin: 50px auto;
        }
        input[type="text"], input[type="number"], input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #5d5da5;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: violet;
        }
        h1 {
            color: #5d5da5;
            text-align: center;
        }
    </style>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
    Name: <br>
    <input type="text" name="name" id="name">
    <input type="number" name="id" id="name">
    <input type="submit" value="Delete" name="s">
    </form>
    <?php
    require_once'config.php';
    $conn=new PDO($dsn,$username,$password,$options);
        if(isset($_POST['s']))
        {
            if((isset($_POST['name']))&& isset($_POST['id'])) 
            {
                $name=$_POST['name'];
                $id=$_POST['id'];
                $sql="DELETE FROM student WHERE fname=:fname and studenid=:id";
                $st=$conn->prepare($sql);
                $st->execute(array(
                    'fname'=>$name,
                    'id'=>$id
                ));
                header("location:index.php");
            }
        }
    ?>
    
</body>
</html>