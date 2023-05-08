<?php
include('config.php');
$conn = new PDO($dsn, $username, $password, $options);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Student Course List</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {background-color: #f2f2f2;}

        th {
            background-color: #444;
            color: white;
        }
        body
        {
            background-color:white;
        }
        .new-link {
  display: inline-block;
  padding: 8px 12px;
  background-color: #444;
  color: white;
  text-decoration: none;
  border-radius: 4px;
}

.new-link:hover {
  background-color: #999;
}

    
    </style>
</head>

<body>
    <h2>Student Course List</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Course Code</th>
                <th>Course Title</th>
                <th>Grade</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
           $sql = "SELECT `student`.`studenid`, `student`.`fname`, `student`.`lname`, `student`.`email`, `course`.`coursecode`, `course`.`title`, `student_course`.`mark` FROM `student_course`
            INNER JOIN `student` ON `student_course`.`studenid` = `student`.`studenid`
            INNER JOIN `course` ON `student_course`.`coursecode` = `course`.`coursecode`
            ORDER BY `student`.`studenid`, `course`.`coursecode`";

            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $currentStudent = null;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($currentStudent !== $row['studenid']) {
                    $currentStudent = $row['studenid'];
                    echo "<tr><td>{$row['studenid']}</td><td>{$row['fname']} {$row['lname']}</td><td>{$row['email']}</td>";
                } else {
                    echo "<tr><td>{$row['studenid']}</td><td>{$row['fname']} {$row['lname']}</td><td>{$row['email']}</td>";
                }

                echo "<td>{$row['coursecode']}</td><td>{$row['title']}</td><td>{$row['mark']}</td>";
                echo "<td><a href='update.php?studenid=" . htmlentities($row['studenid']) . "&coursecode=" . htmlentities($row['coursecode']) . "' class=\"new-link\">Update Grade</a></td>";

                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <center>
        <a href="connected.php" class="new-link">Add New Student</a>
        <br> <br>
        <a href="Delete.php" class="new-link">Delete Student</a>
        <br> <br>
        <a href="search.php" class="new-link">Search Student</a>
    </center>
</body>

</html>
