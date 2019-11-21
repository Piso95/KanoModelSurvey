<?php
    include 'databaseModule.php';
    $id = $_GET['id'];
    
    connect();
    $res = removeSubcategory($id);
    closeConnection();
    
    if($res){
        echo "Correct";
    }else{
        echo "Drop failed";
    }
?>