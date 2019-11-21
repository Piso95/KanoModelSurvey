<?php

    include 'config/DBParams.php';
    
    global $connection;

    function getConnection(){
        return $connection;
    }

    function connect(){
        global $connection;
        $connection= mysql_connect(DBSERVER, DBUSER, DBPASSWORD);
        if(!$connection){
            die ('Could no connect: ' . mysql_error());
        }
        mysql_select_db(DBNAME);
    }

    function getCategoryTableBody(){
        $returnData = "";
        $categorie = "SELECT id, nome, descrizione FROM categorie";
        $result_categorie = mysql_query($categorie);
        if(!$result_categorie){
            $returnData = "Error: " . mysql_error();
        }else{
            
            while( $row = mysql_fetch_assoc($result_categorie)){
                $returnData = $returnData. "<tr>\n" . "<td>" . $row['id'] . "</td>\n" . "<td>" . $row['nome'] . "</td>\n" .  "<td>" . $row['descrizione'] ."</td>\n" .  "</tr>\n";
            }
            
        }
        
        return $returnData;        
    }

    function getLanguageTableBody(){
        $returnData = "";
        $lingue = "SELECT id, sigla, nome FROM lingue";
        $result_lingue = mysql_query($lingue);
        if(!$result_lingue){
            $returnData = "Error: " . mysql_error();
        }else{
                       
            while( $row = mysql_fetch_assoc($result_lingue)){
                $returnData=$returnData. "<tr>\n" . "<td>" . $row['id'] . "</td>\n" . "<td>" . $row['sigla'] . "</td>\n" .  "<td>" . $row['nome'] ."</td>\n" .  "</tr>\n";
            }

        }
        
        return $returnData;       
    }

    function getResponseTableBody(){
        $returnData = "";
        $risposte = "SELECT risposte.id, risposte.descrizione AS testo_risposta, peso_funzionale, peso_disfunzionale, lingue.nome AS lingua, categorie.nome AS categoria FROM risposte INNER JOIN lingue on id_lingua = lingue.id INNER JOIN categorie ON id_categoria = categorie.id";
        $result_risposte = mysql_query($risposte);
        if(!$result_risposte){
            $returnData = "Error: " . mysql_error();
        }else{
            while ($row = mysql_fetch_assoc($result_risposte)){
                $returnData = $returnData . "<tr>\n" . "<td>" . $row['id'] . "</td>\n<td>" . $row['testo_risposta'] . "</td>\n<td>" . $row['peso_funzionale'] . "</td>\n<td>" . $row['peso_disfunzionale'] . "</td>\n<td>" . $row['lingua'] . "</td>\n<td>" . $row['categoria']. "</td>\n</tr>"; 
            }
        }
        return $returnData;
    }
    
    function getQuestionTableBody(){
        $returnData = "";
        $domande = "SELECT d.id AS id, d.descrizione AS descrizione, IF(d.funzionale = 1, 'YES','NO')  AS funzionale, d.id_funzionale AS functional_id, lingue.nome AS lingua, categorie.nome AS categoria, sottocategorie.nome AS sottocategoria, d.suggerimento AS suggerimento  FROM domande AS d LEFT JOIN domande AS dd ON d.id_funzionale = dd.id INNER JOIN categorie ON d.id_categoria = categorie.id INNER JOIN lingue ON d.id_lingua = lingue.id LEFT JOIN sottocategorie ON d.id_sottocategoria = sottocategorie.id ORDER BY d.id";
        $result_domande = mysql_query($domande);
        if(!$result_domande){
            $returnData = "Error: " . mysql_error();
        }else{
            while($row = mysql_fetch_assoc($result_domande)){
                $returnData = $returnData. "<tr>\n<td>" . $row['id'] . "</td>\n<td>" . $row['descrizione'] . "</td>\n<td>" . $row['funzionale'] . "</td>\n<td>" . $row['functional_id'] . "</td>\n<td>" . $row['lingua'] . "</td>\n<td>" . $row['categoria'] . "</td>\n<td>" . $row['sottocategoria'] . "</td>\n<td>" . $row['suggerimento'] . "</td>\n</tr>";
            }
        }
        return $returnData;
        
    }

    function getSubcategoryTableBody(){
        $returnData = "";
        $subcategory = "SELECT * FROM sottocategorie";
        $result_sottocategorie = mysql_query($subcategory);
        if(!$result_sottocategorie){
            $returnData = "Error: " . mysql_error();
        }else{
            while($row = mysql_fetch_assoc($result_sottocategorie)){
                $returnData = $returnData . "<tr>\n<td>" . $row['id'] . "</td>\n<td>" . $row['nome'] . "</td>\n<td>" . $row['descrizione'] . "</td>\n</tr>";
            }
        }
        return $returnData;
    }

    function insertCategory($name, $description){
        $res = mysql_query("INSERT INTO categorie (nome,descrizione) VALUES ('" . $name . "','" . $description . "')" );
        if($res){
            return true;
        }else{
            return false;
        }
    }

     function insertSubcategory($name, $description){
        $res = mysql_query("INSERT INTO sottocategorie (nome,descrizione) VALUES ('" . $name . "','" . $description . "')" );
        if($res){
            return true;
        }else{
            return false;
        }
    }


    function insertLanguage($sigla, $name){
        $res = mysql_query("INSERT INTO lingue (sigla,nome) VALUES ('" . $sigla . "','" . $name . "')" );
        if($res){
            return true;
        }else{
            return false;
        }
    }

    
    function getLanguageArray(){
        $returnData = [];
        $res = mysql_query("SELECT nome FROM lingue");
        if($res){
            while($row = mysql_fetch_assoc($res)){
                array_push($returnData, $row['nome']);
            }
        }else{
            $returnData = "Error: " + mysql_error();
        }
        return $returnData;
    }

    function getCategoryArray(){
        $returnData = [];
        $res = mysql_query("SELECT nome FROM categorie");
        if($res){
            while($row = mysql_fetch_assoc($res)){
                array_push($returnData, $row['nome']);
            }
        }else{
            $returnData = "Error: " + mysql_error();
        }
        return $returnData;
    }
    
    function getSubcategoryArray(){
        $returnData = [];
        $res = mysql_query("SELECT nome FROM sottocategorie");
        if($res){
            while($row = mysql_fetch_assoc($res)){
                array_push($returnData, $row['nome']);
            }
        }else{
            $returnData = "Error: " + mysql_error();
        }
        return $returnData;
    }
    
    function insertResponse($description, $fweight, $dweight, $language,$category){        
        $res = mysql_query("SELECT id FROM lingue WHERE nome = '" . $language . "'");
        $res = mysql_fetch_assoc($res);
        $id_language = $res['id'];
        
        $res = mysql_query("SELECT id FROM categorie WHERE nome ='" . $category . "'");
        $res = mysql_fetch_assoc($res);
        $id_category = $res['id'];
        
        $res = mysql_query("INSERT INTO risposte (descrizione, peso_funzionale, peso_disfunzionale, id_lingua, id_categoria) VALUES (\"". $description . "\", " . $fweight . "," . $dweight . "," . $id_language . ", " . $id_category . ")");
        
        if($res){
            return true;
        }else{
            return false;
        }
    }

    function insertQuestion($functional, $f_hint, $disfunctional, $d_hint, $lang, $cat, $subcat){
        mysql_query("SET AUTOCOMMIT = 0");
        mysql_query("START TRANSACTION");
        
        $id_lang = mysql_fetch_assoc(mysql_query("SELECT id FROM lingue WHERE nome = '" . $lang . "'"));
        $id_lang = $id_lang['id'];
        
        $id_cat = mysql_fetch_assoc(mysql_query("SELECT id FROM categorie WHERE nome = '" . $cat . "'"));
        $id_cat = $id_cat['id'];
        
        $id_subcat = mysql_fetch_assoc(mysql_query("SELECT id FROM sottocategorie WHERE nome = '" . $subcat . "'"));
        $id_subcat = $id_subcat['id'];
        
        $func_insert = "INSERT INTO domande (descrizione,funzionale,id_lingua,id_categoria,id_sottocategoria,suggerimento) VALUES ('" . $functional . "', TRUE, " . $id_lang . ", " . $id_cat . ", " .$id_subcat .", '" . $f_hint . "')";
        $func_insert = mysql_query($func_insert);
        
        if($func_insert){
            $func_id = "SELECT id FROM domande WHERE descrizione = '" . $functional . "'";
            $func_id = mysql_fetch_assoc(mysql_query($func_id));
            $func_id = $func_id['id'];
            
            $dis_insert = "INSERT INTO domande (descrizione,funzionale, id_funzionale, id_lingua, id_categoria, id_sottocategoria, suggerimento) VALUES ('" . $disfunctional . "', FALSE, " . $func_id . ", " . $id_lang . ", " . $id_cat . "," . $id_subcat . ", '" . $d_hint . "')";
            $dis_insert = mysql_query($dis_insert);
            if($dis_insert){
                mysql_query("COMMIT");
                return true;
            }else{
                mysql_query("ROLLBACK");
                return false;
            }
        }else{
            mysql_query("ROLLBACK");
            return false;
        }
        
    }

    function insertImportanceResponse($id_functional, $importance_value){
        $query = "INSERT INTO importanza (id_domanda, valore) VALUES (" . $id_functional . ", " . $importance_value . ")";
        
        $query = mysql_query($query);
        
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function removeCategory($id){
        $res = mysql_query("DELETE FROM categorie WHERE id = " . $id);
        if($res){
            return true;
        }else{
            return false;
        }
    }

    function removeSubcategory($id){
        $res = mysql_query("DELETE FROM sottocategorie WHERE id = " . $id);
        if($res){
            return true;
        }else{
            return false;
        }
    }

    function removeLanguage($id){
        $res = mysql_query("DELETE FROM lingue WHERE id = " . $id);
        if($res){
            return true;
        }else{
            return false;
        }
    }

    function removeQuestion($id){
        $res = mysql_query("DELETE FROM domande WHERE id = " . $id);
        if($res){
            return true;
        }else{
            return false;
        }
    }

    function removeAnswer($id){
        $res = mysql_query("DELETE FROM risposte WHERE id = " . $id);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    
    function getFunctionalAnswer($language, $category){
        $returnData = [];
        $res = mysql_query("SELECT id FROM lingue WHERE nome = '" . $language . "'");
        $res = mysql_fetch_assoc($res);
        $id_language = $res['id'];
        
        $res = mysql_query("SELECT id FROM categorie WHERE nome ='" . $category . "'");
        $res = mysql_fetch_assoc($res);
        $id_category = $res['id'];
        
        $answer_query = "SELECT id, descrizione, suggerimento FROM domande WHERE funzionale = TRUE AND id_lingua = " . $id_language . " AND id_categoria = " . $id_category;
        $answer_query = mysql_query($answer_query);
        
        if(!$answer_query){
            $returnData = "Error: " . mysql_error();
        }else{
            while($row = mysql_fetch_assoc($answer_query)){
                $data = array();
                $data['id'] = $row['id'];
                $data['description'] = $row['descrizione'];
                $data['hint'] = $row['suggerimento'];
                array_push($returnData, $data);
            }
        }
        
        return $returnData;        
    }

    function getDisfunctionalFromFunctional($id_functional){
        $returnData = [];
        $query = "SELECT id, descrizione, suggerimento FROM domande WHERE funzionale = FALSE AND id_funzionale = " . $id_functional;
        
        $query = mysql_query($query);
        if($query){
            $query = mysql_fetch_assoc($query);
            $returnData['id'] = $query['id'];
            $returnData['description'] = $query['descrizione'];
            $returnData['hint'] = $query['suggerimento'];
        }else{
            $returnData = "Error: " . mysql_error();
        }
        return $returnData;
    }

    function getAnswerForCategory($language, $category){
        $returnData = [];
        $res = mysql_query("SELECT id FROM lingue WHERE nome = '" . $language . "'");
        $res = mysql_fetch_assoc($res);
        $id_language = $res['id'];
        
        $res = mysql_query("SELECT id FROM categorie WHERE nome ='" . $category . "'");
        $res = mysql_fetch_assoc($res);
        $id_category = $res['id'];
        
        $query = "SELECT id, descrizione FROM risposte WHERE id_lingua=" . $id_language . " AND id_categoria=" . $id_category;
        $query = mysql_query($query);
        
        if($query){
            while($row = mysql_fetch_assoc($query)){
                $data = [];
                $data['id'] = $row['id'];
                $data['description'] = $row['descrizione'];
                array_push($returnData, $data);
            }
        }else{
            $returnData = "Error: " . mysql_error();
        }
        return $returnData;
    }
    
    function insertDataFromSurvey($id_question, $id_response){
        $query = "INSERT INTO risp_questionario (id_domanda,id_risposta) VALUES ( ". $id_question . ", " . $id_response . ")";
        $query = mysql_query($query);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function getQuestionAndResponse(){
        $returnData=[];
        $query="SELECT risp_questionario.id, id_domanda, domande.descrizione AS desc_domanda, IF(ISNULL(id_funzionale),'',id_funzionale) AS id_funzionale,categorie.nome AS categoria, lingue.nome AS lingua, id_risposta, risposte.descrizione as desc_risp, IF(funzionale=1, peso_funzionale,peso_disfunzionale) AS peso, sottocategorie.nome AS nome_sottocategoria FROM risp_questionario INNER JOIN domande ON id_domanda = domande.id INNER JOIN risposte ON id_risposta = risposte.id INNER JOIN categorie ON domande.id_categoria = categorie.id INNER JOIN lingue ON domande.id_lingua = lingue.id LEFT JOIN sottocategorie ON domande.id_sottocategoria = sottocategorie.id ORDER BY risp_questionario.id";
        
        $res = mysql_query($query);
        if($res){
            while($row = mysql_fetch_assoc($res)){
             
                array_push($returnData,$row);
                
            }
            
        }else{
            $returnData = "Error: " + mysql_error();
        }
        
        return $returnData;
    }

   function getCategoryIdAndName(){
        $returnData = [];
        
        $query = "SELECT id, nome FROM categorie";
        $query = mysql_query($query);
        
        if($query){
            while($row = mysql_fetch_assoc($query)){
                array_push($returnData, $row);
            }
        }else{
            $returnData = "Error: " + mysql_error();
        }
        
        return $returnData;
        
    }

    function getLanguageIdAndName(){
        $returnData = [];
        
        $query = "SELECT id, nome FROM lingue";
        $query = mysql_query($query);
        
        if($query){
            while($row = mysql_fetch_assoc($query)){
                array_push($returnData, $row);
            }
        }else{
            $returnData = "Error: " + mysql_error();
        }
        
        return $returnData;
    }

    
    

    function getKano(){
        $returnData = [];
        
        $categorie = getCategoryIdAndName();
        $lingue = getLanguageIdAndName();
        
        if(!is_array($categorie)){
            return "Error category: " . $categorie; 
        }
        
        if(!is_array($lingue)){
            return "Error language: " . $lingue;
        }
        
        foreach($categorie as $cat){
            foreach($lingue as $lang){
                $query_dom = "SELECT id, descrizione FROM domande WHERE funzionale AND id_categoria = " . $cat['id'] . " AND id_lingua = " . $lang['id'];
                $query_dom = mysql_query($query_dom);
                
                if(!$query_dom){
                    return "Error questions query: " . mysql_error();
                }
                
                $returnData[$cat['nome']][$lang['nome']] = [];
                
                while($row = mysql_fetch_assoc($query_dom)){                                        
                    $disf = "SELECT id, descrizione FROM domande WHERE id_funzionale = " . $row['id'];
                    $disf = mysql_query($disf);
                    if(!$disf){
                        return "Error questio query -> Disfunctional retrive: " . mysql_error();
                    }
                    $disf = mysql_fetch_assoc($disf);
                    
                    $singleQuestion['funzionale'] = $row;
                    $singleQuestion['disfunzionale'] = $disf;
                    
                    $num_sum_func = "SELECT COUNT(risp_questionario.id) AS numero, SUM(peso_funzionale) AS peso FROM risp_questionario INNER JOIN risposte ON id_risposta = risposte.id WHERE id_domanda = " . $singleQuestion['funzionale']['id'];
                    
                    $num_sum_disf = "SELECT COUNT(risp_questionario.id) AS numero, SUM(peso_disfunzionale) AS peso FROM risp_questionario INNER JOIN risposte ON id_risposta = risposte.id WHERE id_domanda = " . $singleQuestion['disfunzionale']['id'];
                    
                    $sum_importance = "SELECT SUM(valore) AS importance FROM importanza WHERE id_domanda = " . $singleQuestion['funzionale']['id'];
                    
                    $num_sum_func = mysql_query($num_sum_func);
                    $num_sum_disf = mysql_query($num_sum_disf);
                    $sum_importance = mysql_query($sum_importance);
                    
                    $num_sum_func = mysql_fetch_assoc($num_sum_func);
                    $num_sum_disf = mysql_fetch_assoc($num_sum_disf);
                    $sum_importance = mysql_fetch_assoc($sum_importance);
                    
                    $singleQuestion['funzionale']['numero_risposte'] = $num_sum_func['numero'];
                    $singleQuestion['funzionale']['peso_totale'] = $num_sum_func['peso'];
                    $singleQuestion['disfunzionale']['numero_risposte'] = $num_sum_disf['numero'];
                    $singleQuestion['disfunzionale']['peso_totale'] = $num_sum_disf['peso'];
                    $singleQuestion['importanza']['valore_totale'] = $sum_importance['importance'];
                    $singleQuestion['importanza']['numero_risposte'] = $num_sum_func['numero'];
                    
                    array_push($returnData[$cat['nome']][$lang['nome']], $singleQuestion);
                } 
            }
        }
        
        $total_answer = "SELECT count(id) AS totale FROM risp_questionario";
        $total_answer = mysql_query($total_answer);
        $total_answer = mysql_fetch_assoc($total_answer);
        
        $returnData['risposte_totali'] = $total_answer['totale'];
        return $returnData;  
    }

    function getLanguageNameByAcronym($acronym){
        $returnData = false;
        
        $query = "SELECT nome FROM lingue WHERE sigla=\"" . $acronym . "\"";
        $query = mysql_query($query);
        if($query){
            $query = mysql_fetch_array($query);
            $returnData = $query['nome'];
        }
        
        return $returnData;
    }

    function closeConnection(){
        global $connection;
        mysql_close($connection);
    }
    

?>