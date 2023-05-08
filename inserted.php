<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inserted</title>
</head>
<body>
     <?php
    
    if(isset($_POST['s'])) {
        $first = '';
        $last = '';
        $email = '';
        $courses=array();
    
        // Check if $_POST['firstName'], $_POST['lastName'], and $_POST['email'] are set
        if(isset($_POST['firstName'])) {
            $first = $_POST['firstName'];
        }
    
        if(isset($_POST['lastName'])) {
            $last = $_POST['lastName'];
        }
    
        if(isset($_POST['email'])) {
            $email = $_POST['email'];
        }
        if(isset($_POST['courses'])) {
            $courses = $_POST['courses']; // Assign the selected courses to the $courses array
        }
        // Check if $first, $last, and $email are not empty
        if(empty($first) || empty($last) || empty($email)) {
            // Do something with the $first, $last, and $email variables here
            echo "plz make sure that all inputs true";
        } else {
            require_once'config.php';
            $conn=new PDO($dsn,$username,$password,$options);
        
            $sql='insert into student(fname, lname, email)
            values(:fname,:lname,:email)';
            $st=$conn->prepare($sql);
            $st->execute(array(
                ':fname'=>$_POST['firstName'],
                ':lname'=>$_POST['lastName'],
                ':email'=>$_POST['email']
            ));
            $student_id = $conn->lastInsertId();
            $courses=$_POST['courses'];
           // add the selected courses to the course table if they don't already exist
        foreach ($courses as $course) {
           $sql='insert into student_course (studenid, coursecode) values(:student_id, :course_code)';
           $st=$conn->prepare($sql);
           $st->execute(array(
            'student_id'=> $student_id,
            'course_code'=>$course
           ));
        }

        }
    }
    if($conn)
    {
    echo"thanks for your regestration";
    }
    header("Location: index.php");
    exit();
     ?>
    
</body>
</html>