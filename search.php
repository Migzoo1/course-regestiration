<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        th, td {
            text-align: left;
            padding: 8px;
        }
        
        th {
            background-color: #000;
            color: white;
        }
        
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>

</head>
<body>
        <h3>Search for all students enrolled in specific course:</h3>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">

            <label>Courses:</label><br>
            <input type="radio" name="course" value="comp102" id="comp102">
            <label for="comp102">COMP 102</label><br>
            <input type="radio" name="course" value="comp104" id="comp104">
            <label for="comp104">COMP 104</label><br>
            <input type="radio" name="course" value="comp206" id="comp206">
            <label for="comp206">COMP 206</label><br><br>
            <button type="submit" name="1">Search</button>
            <br><br>
        </form>

        <?php
            require_once 'config.php';
            $conn = new PDO($dsn, $username, $password, $options);

            if(isset($_POST['1']))
            {
                if(isset($_POST['course'])){
                $coursecode=$_POST['course'];        
                $sql="SELECT * FROM `student` as `s` INNER JOIN `student_course` as `sc` ON `s`.`studenid`=`sc`.`studenid`
                WHERE `sc`.`coursecode`=:coursecode ";
                $st=$conn->prepare($sql);
                $st->bindparam(':coursecode',$coursecode);
                $st->execute();

                echo "<table>";
                echo "<tr>";
                echo "<th>Student ID</th>";
                echo "<th>First Name</th>";
                echo "<th>Last Name</th>";
                echo "<th>Email</th>";
                echo "<th>Course Code</th>";
                echo "<th>Mark</th>";
                echo "</tr>";

                while($row = $st->fetch(PDO::FETCH_ASSOC))
                {
                    echo "<tr>";
                    echo "<td>" . $row['studenid'] . "</td>";
                    echo "<td>" . $row['fname'] . "</td>";
                    echo "<td>" . $row['lname'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['coursecode'] . "</td>";
                    echo "<td>" . $row['mark'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                }
            }
        ?>
        <h3>Search for all students with specifec marks specific course:</h3>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
            <label>Courses:</label><br>
            <input type="number" name="n" id="2" min="0" max="150">
            <label>Courses:</label><br>
            <input type="radio" name="course" value="comp102" id="comp102">
            <label for="comp102">COMP 102</label><br>
            <input type="radio" name="course" value="comp104" id="comp104">
            <label for="comp104">COMP 104</label><br>
            <input type="radio" name="course" value="comp206" id="comp206">
            <label for="comp206">COMP 206</label><br><br>
            <button type="submit" name="2">Search</button>
        </form>
        <?php
        if(isset($_POST['2']))
        {
            if(isset($_POST['course']) && isset($_POST['n']) )
            {
                $course=$_POST['course'];
                $num=$_POST['n'];
                $sql="SELECT * FROM `student` as `s` INNER JOIN `student_course` as `sc` ON `s`.`studenid`=`sc`.`studenid`
                WHERE `sc`.`coursecode`=:coursecode and `sc`.`mark`>=:num ";
                $st=$conn->prepare($sql);
                $st->execute(array(
                    'coursecode'=>$course,
                    'num'=>$num
                ));
                echo "<table>";
                echo "<tr>";
                echo "<th>Student ID</th>";
                echo "<th>First Name</th>";
                echo "<th>Last Name</th>";
                echo "<th>Email</th>";
                echo "<th>Course Code</th>";
                echo "<th>Mark</th>";
                echo "</tr>";


                while($row = $st->fetch(PDO::FETCH_ASSOC))
                {
                    echo "<tr>";
                    echo "<td>" . $row['studenid'] . "</td>";
                    echo "<td>" . $row['fname'] . "</td>";
                    echo "<td>" . $row['lname'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['coursecode'] . "</td>";
                    echo "<td>" . $row['mark'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        }
            ?>
            <h3>credit hours of specifec course:</h3>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" >

            <label>Courses:</label><br>
            <input type="radio" name="course" value="comp102" id="comp102">
            <label for="comp102">COMP 102</label><br>
            <input type="radio" name="course" value="comp104" id="comp104">
            <label for="comp104">COMP 104</label><br>
            <input type="radio" name="course" value="comp206" id="comp206">
            <label for="comp206">COMP 206</label><br><br>
            <button type="submit" name="3">Search</button>
            <br><br>
        </form>
                <?php
                if(isset($_POST['3']))
                {
                    if(isset($_POST['course']))
                    {
                        $course=$_POST['course'];
                        $sql="SELECT coursecode , crhour FROM course WHERE coursecode=:coursecode";
                        $st=$conn->prepare($sql);
                        $st->bindparam(':coursecode', $course);
                        $st->execute();
                        
                        echo"<table>";
                        echo "<tr>";
                        echo "<th>course code</th>";
                        echo "<th>credit hours</th>";
                        echo "</tr>";
                        while($rows=$st->fetch(PDO::FETCH_ASSOC))
                        {
                            echo "<tr>";
                            echo "<td>";
                            echo "{$rows['coursecode']}";
                            echo "</td>";
                            echo "<td>";
                            echo "{$rows['crhour']}";
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                }
                ?>
</body>
</html>
