<!DOCTYPE html>
<?php include 'databaseModule.php'; ?>
<html lang="en">
    <head>
        <title>Kano - Survey results</title>
        <link rel="stylesheet" href="../CSS/survey_result.css">
        <meta charset="utf-8" />
    </head>
    <body>
        <header>
            <h2>Survey results</h2>
            <nav class="sidenav" id="navbar">
                <a href="../managing.php">Back</a>
                <a href="graph.php">Graph</a>
            </nav>
        </header>
        <section class="result" id="allData">
            <article id="result_table">
                <table>
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>QUESTION ID</td>
                            <td>QUESTION DESCRIPTION</td>
                            <td>CATEGORY</td>
                            <td>REQUIRE</td>
                            <td>LANGUAGE</td>
                            <td>FUNCTIONAL ID</td>
                            <td>ANSWER ID</td>
                            <td>ANSWER DESCRIPTION</td>
                            <td>WEIGHT</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            connect();
                            $data = getQuestionAndResponse();
                            closeConnection();

                            if(is_array($data)){
                                foreach($data as $row){
                                    echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['id_domanda'] . "</td>";
                                    echo "<td>" . $row['desc_domanda'] . "</td>";
                                    echo "<td>" . $row['categoria'] . "</td>";
                                    echo "<td>" . $row['nome_sottocategoria'] . "</td>";
                                    echo "<td>" . $row['lingua'] . "</td>";
                                    echo "<td>" . $row['id_funzionale'] . "</td>";
                                    echo "<td>" . $row['id_risposta'] . "</td>";
                                    echo "<td>" . $row['desc_risp'] . "</td>";
                                    echo "<td>" . $row['peso'] . "</td>";
                                    echo "</tr>";
                                }
                            }else{
                                echo $data;
                            }
                        ?>
                    </tbody>
                </table>
                <a href="resultExport.php">Export</a>
            </article>
            <article id="kano_analysis">
                <?php
                    connect();
                    $kano = getKano();
                    $category = getCategoryArray();
                    $language = getLanguageArray();
                    closeConnection();
                    echo "<p>Risposte totali: " . $kano['risposte_totali'] . "</p>";
                    foreach ($language as $lang){
                        echo "<section>";
                        echo "<h2>" . $lang . "</h2>";
                        foreach ($category as $cat){
                            echo "<section>";
                            echo "<h3>" . $cat . "</h3>";
                            echo "<table><thead>";
                            echo "<tr>";
                            echo "<td>FUNCTIONAL QUESTION</td>";
                            echo "<td>FUNCTIONAL WEIGHT</td>";
                            echo "<td>FUNCTIONAL ANSWER</td>";
                            echo "<td>NORMALIZED WEIGHT</td>";
                            echo "<td>DYSFUNCTIONAL QUESTION</td>";
                            echo "<td>DYSFUNCTIONAL WEIGHT</td>";
                            echo "<td>DYSFUNCTIONAL ANSWER</td>";
                            echo "<td>NORMALIZED WEIGHT</td>";
                            echo "<td>IMPORTANCE</td>";
                            echo "<td>NORMALIZED IMPORTANCE</td>";
                            echo "</tr></thead><tbody>";
                            for($i = 0; $i < sizeof($kano[$cat][$lang]); $i++){
                                echo "<tr>";
                                echo "<td>" . $kano[$cat][$lang][$i]['funzionale']['descrizione'] . "</td>";
                                echo "<td>" . $kano[$cat][$lang][$i]['funzionale']['peso_totale'] . "</td>";
                                echo "<td>" . $kano[$cat][$lang][$i]['funzionale']['numero_risposte'] . "</td>";
                                if($kano[$cat][$lang][$i]['funzionale']['numero_risposte'] != 0){
                                    echo "<td>" . ($kano[$cat][$lang][$i]['funzionale']['peso_totale'] /  $kano[$cat][$lang][$i]['funzionale']['numero_risposte']) . "</td>";
                                }else{
                                    echo "<td></td>";
                                }
                                echo "<td>" . $kano[$cat][$lang][$i]['disfunzionale']['descrizione'] . "</td>";
                                echo "<td>" . $kano[$cat][$lang][$i]['disfunzionale']['peso_totale'] . "</td>";
                                echo "<td>" . $kano[$cat][$lang][$i]['disfunzionale']['numero_risposte'] . "</td>";
                                if($kano[$cat][$lang][$i]['disfunzionale']['numero_risposte'] != 0){
                                    echo "<td>" . ($kano[$cat][$lang][$i]['disfunzionale']['peso_totale'] / $kano[$cat][$lang][$i]['disfunzionale']['numero_risposte']) . "</td>";
                                }else{
                                    echo "<td></td>";
                                }
                                 echo "<td>" . $kano[$cat][$lang][$i]['importanza']['valore_totale'] . "</td>";
                                if($kano[$cat][$lang][$i]['importanza']['numero_risposte'] != 0){
                                    echo "<td>" . ($kano[$cat][$lang][$i]['importanza']['valore_totale'] /  $kano[$cat][$lang][$i]['importanza']['numero_risposte']) . "</td>";
                                }else{
                                    echo "<td></td>";
                                }
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            echo "</section>";
                        }
                        echo "</section>";
                    }
                                    
                ?>
            </article>
            <a href="kanoExport.php">Export</a>
        </section>
        
    </body>
</html>