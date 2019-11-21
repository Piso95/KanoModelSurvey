<!DOCTYPE html>
<?php 
            include 'databaseModule.php';
            $dataPoints = [];
            
            connect();
            $kano = getKano();
            $category = getCategoryArray();
            $language = getLanguageArray();
            closeConnection();
            
            array_push($dataPoints, array('Question id','Dysfunctional','Functional','Importance'));
            foreach($category as $cat){
                foreach($language as $lang){
                    for($i = 0; $i < sizeof($kano[$cat][$lang]); $i++){
                        if($kano[$cat][$lang][$i]['funzionale']['numero_risposte'] != 0 && $kano[$cat][$lang][$i]['disfunzionale']['numero_risposte'] != 0){
                            $singleBubble = [];
                            $func_norm = $kano[$cat][$lang][$i]['funzionale']['peso_totale'] /  $kano[$cat][$lang][$i]['funzionale']['numero_risposte'];
                            $disf_norm = $kano[$cat][$lang][$i]['disfunzionale']['peso_totale'] / $kano[$cat][$lang][$i]['disfunzionale']['numero_risposte'];
                            $importance = $kano[$cat][$lang][$i]['importanza']['valore_totale'] /  $kano[$cat][$lang][$i]['importanza']['numero_risposte'];
                            
                            $singleBubble[0] = 'Q: ' . $kano[$cat][$lang][$i]['funzionale']['id'];
                            $singleBubble[1] = $disf_norm;
                            $singleBubble[2] = $func_norm;
                            $singleBubble[3] = $importance;
                            array_push($dataPoints,$singleBubble);
                        }
                    }
                }
            }
                        
        ?>
<html lang="en">
    <head>
        <title>Kano - Survey result</title>
        <link rel="stylesheet" href="../CSS/survey_result.css">
        <meta charset="utf-8" />
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script>
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(visualizeChart);
            
            function visualizeChart(){
                
                var data = google.visualization.arrayToDataTable(<?php echo json_encode($dataPoints); ?>);
                
                var options ={
                    title: 'Kano Analysis',
                    hAxis: {title: 'Dysfunctional'},
                    vAxis: {title: 'Functional'},
                    explorer: {}
                };
                
                var chart = new google.visualization.BubbleChart(document.getElementById('graph'));
                chart.draw(data,options);
                
                var cli = chart.getChartLayoutInterface();
                var container = document.getElementById('graph');
                
            }
           
        </script>
    </head>
    <body>
        <header>
            <nav class="sidenav" id="navbar">
                <a href="survey_result.php">Back</a>
            </nav>
        </header>
        <section class="result">
            <h2>Survey Results</h2>
        </section>
        <section class="answers">
            <article class="result">
                <h3>Questions list</h3>
                <table>
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>DESCRIPTION</td>
                            <td>FUNCTIONAL</td>
                            <td>ID FUNCTIONAL</td>
                            <td>LANGUAGE</td>
                            <td>CATEGORY</td>
                            <td>REQUIREMENT</td>
                            <td>HINT</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            connect();
                            echo getQuestionTableBody();
                            closeConnection();
                        ?>
                    </tbody>
                </table>
            </article>
        </section>
        <section id="chart_wrap">
            <article class="result">
                <article id="graph" style="height: 500px;">
                    
                </article>
            </article>
        </section>
    </body>
</html>