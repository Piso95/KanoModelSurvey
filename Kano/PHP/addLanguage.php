<?php
    include 'databaseModule.php';
    $languageAcronym = $_GET['acronym'];
    $languageName = $_GET['name'];
    
    connect();
    $res = insertLanguage($languageAcronym, $languageName);
    closeConnection();

    if($res){
        echo "Correct";
    }else{
        echo "Incorrect";
    }
?>    