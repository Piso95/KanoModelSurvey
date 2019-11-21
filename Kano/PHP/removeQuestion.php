<?php
    include 'databaseModule.php';
    $id = $_GET['id'];
    
    connect();
    $res = removeQuestion($id);
    closeConnection();
    
    if($res){
        echo "Correct";
    }else{
        echo "Failed, check if no functional question are related and the related dysfunctional (first remove dysfunctional and then the related functional)";
    }
?>