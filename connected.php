<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        h2 {
            color: #4b0082;
        }
        label {
            display: inline-block;
            width: 100px;
            text-align: right;
            margin-right: 10px;
            font-weight: bold;
            color: #4b0082;
        }
        input[type=text], input[type=email], select {
            padding: 5px;
            margin: 5px;
            width: 250px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type=submit] {
            background-color: #4b0082;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }
        input[type=submit]:hover {
            background-color: #800080;
        }
        #formContainer {
            display: none;
        }
        button {
            background-color: #4b0082;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #800080;
        }
    </style>
    <script>
    function showForm() {
      var formContainer = document.getElementById("formContainer");
      formContainer.style.display = "block";
    }
    </script>
</head>
<body>
    <?php
    require_once 'config.php';
    try {
        //code...
        $conn=new PDO($dsn,$username,$password,$options);
        echo"connected to  database successfully <br><br>";
        
    } catch (PDO_Execption $e) {
        echo "faild".$e->getMessage(); 
    }
    ?>
    <center>
        <button onclick="showForm()">Add Student</button>
        <div id="formContainer">
            <h2>Student Registration Form</h2>
            <form action="inserted.php" method="post">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName"><br>

                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName"><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email"><br>

                <label>Courses:</label><br>
                <input type="checkbox" name="courses[]" value="comp102" id="comp102">
                <label for="comp102">COMP 102</label><br>
                <input type="checkbox" name="courses[]" value="comp104" id="comp104">
                <label for="comp104">COMP 104</label><br>
                <input type="checkbox" name="courses[]" value="comp206" id="comp206">
                <label for="comp206">COMP 206</label><br><br>


                <input type="submit" value="Register" name="s">
            </form>
        </div>
    </center>
</body>
</html>
