<?php

    include 'databaseModule.php';
    
    header("Content-Type: text/csv; charset=utf-8");
    header("Content-Disposition: attachment; filename=kanoExport.csv");
    
    $output = fopen("php://output", "w");
    
    fputcsv($output,array('Catagory', 'Language', 'Functional Question', 'Functional Weight', 'Functional Answers','Functional Normalized', 'Disfunctional Question', 'Disfunctional Weight', 'Disfunctional Answers', 'Disfunctional Normalized','Importance','Importance Nomalized'));
    
    connect();
    $kano = getKano();
    $category = getCategoryArray();
    $language = getLanguageArray();
    closeConnection();

    foreach ($category as $cat){
        foreach($language as $lang){
            for($i=0; $i < sizeof($kano[$cat][$lang]); $i++){
                $data_row=[];
                array_push($data_row,$cat);
                array_push($data_row,$lang);
                array_push($data_row,$kano[$cat][$lang][$i]['funzionale']['descrizione']);
                array_push($data_row,$kano[$cat][$lang][$i]['funzionale']['peso_totale']);
                array_push($data_row,$kano[$cat][$lang][$i]['funzionale']['numero_risposte']);
                if($kano[$cat][$lang][$i]['funzionale']['numero_risposte'] != 0){
                    array_push($data_row,($kano[$cat][$lang][$i]['funzionale']['peso_totale']/$kano[$cat][$lang][$i]['funzionale']['numero_risposte']));
                }else{
                    array_push($data_row,"");
                }
                array_push($data_row,$kano[$cat][$lang][$i]['disfunzionale']['descrizione']);
                array_push($data_row,$kano[$cat][$lang][$i]['disfunzionale']['peso_totale']);
                array_push($data_row,$kano[$cat][$lang][$i]['disfunzionale']['numero_risposte']);
                if($kano[$cat][$lang][$i]['disfunzionale']['numero_risposte'] != 0){
                    array_push($data_row,($kano[$cat][$lang][$i]['disfunzionale']['peso_totale']/$kano[$cat][$lang][$i]['disfunzionale']['numero_risposte']));
                }else{
                    array_push($data_row,"");
                }
                array_push($data_row,$kano[$cat][$lang][$i]['importanza']['valore_totale']);
                 if($kano[$cat][$lang][$i]['importanza']['numero_risposte'] != 0){
                    array_push($data_row,($kano[$cat][$lang][$i]['importanza']['valore_totale']/$kano[$cat][$lang][$i]['importanza']['numero_risposte']));
                }else{
                    array_push($data_row,"");
                }
                fputcsv($output, $data_row);
            }
        }
    }
    
    fflush($output);
    fclose($output);
?>