<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb1";

$conn = new PDO("mysql:host=$servername;dbname=mydb1", $username, $password);

try {

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";

    if (!empty($_REQUEST['save'])) //save have value then put in bracket with dollar
    {
        $getname = $_REQUEST['n']; //getname is a variable & n is the name of textbox
        $getclass = $_REQUEST['c'];
        $getmarks1 = $_REQUEST['m1'];
        $getmarks2 = $_REQUEST['m2'];
        $getmarks3 = $_REQUEST['m3'];

        // prepare query for execution
        $sql = $conn->prepare("insert into student(Name,Class,Marks1,Marks2,Marks3) values('$getname','$getclass',$getmarks1,$getmarks2,$getmarks3)");

        $sql->execute();
        if ($sql->execute()) {
            echo "New record created successfully";
        } else {
            echo "Record Not Inserted";
        }
    }

    if (!empty($_REQUEST['did'])) //inorder to delete data from current data also
    {
        $id = $_REQUEST['did'];

        $sql = $conn->prepare("delete from student where ID=$id");
        $sql->execute();
        if ($sql->execute()) {
            echo "Record Deleted";
        } else {
            echo "Record not Deleted";
        }
    }

    if (!empty($_REQUEST['id'])) //inorder to edit data from current data also
    {
        $id = $_REQUEST['$id'];
        $sql = $conn->prepare("select * from student where ID=3");
        $sql->execute();
        $ro = $sql->fetchAll(PDO::FETCH_ASSOC);
        // foreach ($row as $ro) {
        //     echo
        // }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

//$conn = null;
?>

<html>

<head>
    <title></title>
</head>

<body>
    <form method="get" action="">
        <input type="hidden" value="<?php if (!empty($ro['ID'])) echo $ro['ID'] ?>" name="id" /><br />
        Name <input type="text" value="<?php if (!empty($ro['Name'])) echo $ro['Name'] ?>" name="n" /><br /><br />
        Class <input type="text" value="<?php if (!empty($ro['Class'])) echo $ro['Class'] ?>" name="c" /><br /><br />
        Marks1 <input type="text" value="<?php if (!empty($ro['Marks1'])) echo $ro['Marks1'] ?>" name="m1" /><br /><br />
        Marks2 <input type="text" value="<?php if (!empty($ro['Marks2'])) echo $ro['Marks2'] ?>" name="m2" /><br /><br />
        Marks3 <input type="text" value="<?php if (!empty($ro['Marks3'])) echo $ro['Marks3'] ?>" name="m3" /><br /><br />
        <input type="submit" name="save" value="Save" />
        <input type="submit" name="Cancel" value="Cancel" />
    </form>
    <table border="1" width="80%">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Class</th>
            <th>Marks1</th>
            <th>Marks2</th>
            <th>Marks3</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
        <?php

        $sql = $conn->prepare("select * from student");
        echo "$id";
        $sql->execute();

        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach ($row as $r) {
        ?>
            <tr>
                <td><?php echo $r['ID'] ?></td>
                <td><?php echo $r['Name'] ?></td>
                <td><?php echo $r['Class'] ?></td>
                <td><?php echo $r['Marks1'] ?></td>
                <td><?php echo $r['Marks2'] ?></td>
                <td><?php echo $r['Marks3'] ?></td>
                <td><a href="apirest.php?did=<?php echo $r['ID'] ?>">Delete</a></td>
                <td><a href="apirest.php?eidd=<?php echo $r['ID'] ?>">Edit</a></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <br /><br />
    <br />

</body>

</html>