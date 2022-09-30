<?php
$servername = "localhost";
$username = "root";
$dbname = "mydb1";

$conn = new PDO("mysql:host=$servername;dbname=mydb1", $username);
echo "connected";
if (isset($_REQUEST['id'])) //save have value then put in bracket with dollar
{
    $id = $_REQUEST['id'];
    echo "$id";
    $getname = $_REQUEST['n'];
    $getclass = $_REQUEST['c'];
    $getmarks1 = $_REQUEST['m1'];
    $getmarks2 = $_REQUEST['m2'];
    $getmarks3 = $_REQUEST['m3'];


    $sql = $conn->prepare("update student set Name='$getname',Class='$getclass', Marks1=$getmarks1, Marks2=$getmarks2, Marks3=$getmarks3 where ID=$id");
    $result = $sql->execute();
    if ($result) {
        echo "Record updated successfully";
    } else {
        echo "Record Not Updated";
    }
    // Get the contact from the contacts table
    $stmt = $conn->prepare('SELECT * FROM student');
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<br>";
    print_r($record);
    if (!$record) {
        exit('doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
