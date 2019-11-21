<?php
    include 'databaseModule.php';
    $id = $_GET['id'];
    
    connect();
    $res = removeLanguage($id);
    closeConnection();
    
    if($res){
        echo "Correct";
    }else{
        echo "Failed, check if no question are related";
    }
?>