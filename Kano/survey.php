<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Kano - Survey</title>
        <link rel="stylesheet" href="CSS/survey.css">
        <meta charset="utf-8" />
    </head>
    <body>
         <?php
            function createAnswerRadio($num,$func,$language,$category){
                $returnData = "";
            
                $answer = getAnswerForCategory($language, $category);
                
                
                $num_of_answer = sizeof($answer);
                
                $type = "";
                if($func){
                    $type="func";
                }else{
                    $type="disf";
                }
                                
                for($i=0; $i< $num_of_answer; $i++){
                    if($i==0){
                        $returnData = $returnData . "<input type=\"radio\" name=\"q".$num."_".$type."_id_ans\" value=\"". $answer[$i]['id'] ."\"checked/>" . $answer[$i]['description'];
                    }else{
                        $returnData = $returnData . "<input type=\"radio\" name=\"q".$num."_".$type."_id_ans\" value=\"". $answer[$i]['id'] ."\"/>" . $answer[$i]['description'];
                    }
                }
                return $returnData;
            }
        
            function createImportanceRadio($num){
                $returnData = "";
                for($i=1; $i<= 5; $i++){
                    if($i==5){
                        $returnData = $returnData . "<input type=\"radio\" name=\"q".$num."_importance_value\" value=\"". $i ."\" checked/>" .$i;
                    }else{
                        $returnData = $returnData . "<input type=\"radio\" name=\"q".$num."_importance_value\" value=\"". $i ."\"/>" .$i;
                    }
                }
                return $returnData;
            }
        ?>
        <form action="PHP/survey_finish.php" method="post" id="survey">
             <?php
                    include 'PHP/databaseModule.php';
                
                    $lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
                    $lang = strtok($lang,'-');
                    
                    connect();
                    $language = getLanguageNameByAcronym($lang);
                    echo $languge;
                    
                    if(!$language){
                        $language = "English";
                    }
                        
                    $functional = getFunctionalAnswer($language, $_GET['category']);
                    
                    $num_of_questions = sizeof($functional);
            
                    echo "<input type=\"hidden\" name=\"number_of_questions\" value=\"". $num_of_questions ."\"/>";
                    
                    for($i=0; $i < $num_of_questions; $i++){
                        echo "<section class=\"question_block\" id=\"q".$i."\">";
                        echo "<h2>Question " . $i ."</h2>";
                        echo "<article id=\"q".$i."_func\">";
                        echo "<input type=\"hidden\" name=\"q".$i."_func_id\" value = \"" .  $functional[$i]['id'] . "\"/>";
                        echo "<p class=\"question\">" . $functional[$i]['description'] . "</p>";
                        if(strcmp($functional[$i]['hint'],"") != 0){
                            echo "<p class=\"hint\">Hint: " . $functional[$i]['hint'] . "</p>";
                        }
                        echo createAnswerRadio($i,TRUE, $language, $_GET['category']);
                        echo "</article>";
                        echo "<article id=\"q" . $i. "_disf\">";
                        $disf = getDisfunctionalFromFunctional($functional[$i]['id']);
                        echo "<input type=\"hidden\" value = \"". $disf['id']."\" class=\"invisible\" name=\"q" . $i . "_disf_id\"/>";
                        echo "<p class = \"question\">" . $disf['description'] . "</p>";
                        if(strcmp($disf['hint'],"") != 0){
                            echo "<p class=\"hint\">Hint: " . $disf['hint'] . "</p>";
                        }
                        echo createAnswerRadio($i,FALSE,$language,$_GET['category']);
                        echo "</article>";
                        echo "<article id=\"q". $i . "_importance\">";
                        echo "<p>How much importance has this aspect for you?</p>";
                        echo createImportanceRadio($i);
                        echo "</article>";
                        echo "</section>";
                        echo "<br>";
                    }
                
                    closeConnection();
                ?>
            <button class="send_survey" type="submit" form="survey" value="Submit">Submit</button>
        </form>
    </body>
</html>