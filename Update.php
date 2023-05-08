<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update</title>
</head>
<body>
    <?php 
    require_once 'config.php';
    $conn = new PDO($dsn, $username, $password, $options);
    ?>

    <center>
        <h2> Update Form </h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
            <?php if(isset($_GET['studenid'])): ?>
                <input type="hidden" name="studenid" value="<?php echo htmlspecialchars($_GET['studenid']); ?>">
            <?php endif; ?>
            <?php if(isset($_GET['coursecode'])): ?>
                <input type="hidden" name="coursecode" value="<?php echo htmlspecialchars($_GET['coursecode']); ?>">
            <?php endif; ?>
            <table>
                <tr>
                    <td>Mark:</td>
                    <td><input type="number" id="mark" name="mark" min="0" max="150"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Update" name="update"></td>
                </tr>
            </table>
        </form>
    </center>

    <?php
    if(isset($_POST['update'])) {
        $mark = $_POST['mark'];
        $studenid = $_POST['studenid'];
        $coursecode = $_POST['coursecode'];

        // Update student_course table with new mark
        $sql = "UPDATE student_course SET mark = :mark WHERE studenid = :studenid AND coursecode = :coursecode";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            'mark' => $mark,
            'studenid' => $studenid,
            'coursecode' => $coursecode
        ));

        // Redirect to index.php after updating the mark
        header("Location: index.php");
        exit();
    }
    ?>
</body>
</html>
