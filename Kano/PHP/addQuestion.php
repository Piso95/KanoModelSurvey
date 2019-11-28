<?php
    include 'databaseModule.php';
    $functional = $_GET['functional'];
    $disfunctional = $_GET['disfunctional'];
    $language = $_GET['lang'];
    $category = $_GET['cat'];
    $subcategory = $_GET['subcat'];
    $fhint = $_GET['fhint'];
    $dhint = $_GET['dhint'];
    
    connect();
    $exec = insertQuestion($functional, $fhint, $disfunctional, $dhint,$language, $category, $subcategory);
    closeConnection();


    if($exec){
        echo "Correct";
    }else{
        echo "Incorrect";
    }
?>