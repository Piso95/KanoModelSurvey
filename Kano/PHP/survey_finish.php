<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Kano - Survey</title>
        <meta charset="utf-8" />
    </head>
    <body>
        <h1>Thank you to submit the survey!</h1>
        <?php
            include 'databaseModule.php';
            $num = $_POST['number_of_questions'];
            for($i = 0; $i < $num; $i++){
                $re = "q".$i."_func_id";
                $func_question = $_POST[$re];
                
                $re = $re."_ans";
                $func_answer = $_POST[$re];
                
                $re = "q".$i."_disf_id";
                $disf_question = $_POST[$re];
                
                $re = $re."_ans";
                $disf_answer = $_POST[$re];
                
                $importance_value = "q".$i . "_importance_value";
                $importance_value = $_POST[$importance_value];
                
                connect();
                $res1 = insertDataFromSurvey($func_question, $func_answer);
                $res2 = insertDataFromSurvey($disf_question, $disf_answer);
                $res3 = insertImportanceResponse($func_question, $importance_value);
                
                if(!($res1 && $res2 && $res3)){
                    break;
                }
                closeConnection();
            }
        ?>
    </body>
</html>