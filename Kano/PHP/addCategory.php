<?php
    include 'databaseModule.php';
    $categoryName = $_GET['name'];
    $categoryDescription = $_GET['description'];

    connect();
    $res = insertCategory($categoryName,$categoryDescription);
    closeConnection();

    if($res){
        echo "Correct";
    }else{
        echo "Incorrect";
    }
?>

