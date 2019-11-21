<?php
    
    include 'databaseModule.php';
    
    header("Content-Type: text/csv; charset=utf-8");
    header("Content-Disposition: attachment; filename=completeResult.csv");
    
    $output = fopen("php://output", "w");
    
    fputcsv($output, array('ID','QUESTION ID', 'DESCRIPTION', 'CATEGORY', 'SUBCATEGORY', 'LANGUAGE', 'FUNCTIONAL ID', 'ANSWER ID', 'ANSWER DESCRITPION', 'WEIGHT'));
    
    connect();
    $result = getQuestionAndResponse();
    closeConnection();
    
    foreach ($result as $res){
        $data_row = [];
        array_push($data_row, $res['id']);
        array_push($data_row, $res['id_domanda']);
        array_push($data_row, $res['desc_domanda']);
        array_push($data_row, $res['categoria']);
        array_push($data_row, $res['nome_sottocategoria']);
        array_push($data_row, $res['lingua']);
        array_push($data_row, $res['id_funzionale']);
        array_push($data_row, $res['id_risposta']);
        array_push($data_row, $res['desc_risp']);
        array_push($data_row, $res['peso']);
        fputcsv($output, $data_row);
    }

    fflush($output);
    fclose($output);
    
?>