<?php
    include 'databaseModule.php';

    $id = $_GET['id'];

     connect();
    $res = removeAnswer($id);
    closeConnection();
    
    if($res){
        echo "Correct";
    }else{
        echo "Incorrect";
    }
    
?>