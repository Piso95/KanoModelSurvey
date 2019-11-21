<?php
    include 'databaseModule.php';
    $name = $_GET['name'];
    $description = $_GET['description'];

    connect();
    $res = insertSubcategory($name, $description);
    closeConnection();

    if($res){
        echo "Correct";
    }else{
        echo "Incorrect";
    }
?>
