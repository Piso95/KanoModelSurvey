<?php
    include 'databaseModule.php';
    
    $description = $_GET['description'];
    $functional_weight = $_GET['fweight'];
    $disfunctional_weight = $_GET['dweight'];
    $language = $_GET['lang'];
    $category = $_GET['cat'];
    
    connect();
    $res = insertResponse($description,$functional_weight,$disfunctional_weight,$language,$category);
    closeConnection();
    
    if($res){
        echo "Correct" ;
    }else{
        echo "Error";
    }

?>