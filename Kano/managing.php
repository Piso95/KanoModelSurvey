<!DOCTYPE html>
<?php include 'PHP/databaseModule.php' ?>
<html lang="en">
    <head>
        <title>Kano - Managing page</title>
        <link rel="stylesheet" href="CSS/management.css">
        <meta charset="utf-8" />
        <script>
                    
            function newCategory(){
                var name = document.getElementById("name").value;
                var description = document.getElementById("description").value;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        alert(this.response);
                        location.reload();
                        activateCategory();
                    }
                };
                xmlhttp.open("GET","PHP/addCategory.php?name=" + name.replace(' ' , '+') + "&description=" + description.replace(' ', '+'),true);
                xmlhttp.send();
            }
            
            function newSubcategory(){
                var name = document.getElementById("subcategory_name").value;
                var description = document.getElementById("subcategory_description").value;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        alert(this.response);
                        location.reload();
                        activateSubcategory();
                    }
                };
                xmlhttp.open("GET","PHP/addSubcategory.php?name=" + name.replace(' ' , '+') + "&description=" + description.replace(' ', '+'),true);
                xmlhttp.send();
            }
            
            function newLanguage(){
                var acronym = document.getElementById("acronym").value;
                var name = document.getElementById("languageName").value;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        alert(this.response);
                        location.reload();
                        activateLanguage();
                    }
                };
                xmlhttp.open("GET","PHP/addLanguage.php?acronym=" + acronym.replace(' ' , '+') + "&name=" + name.replace(' ', '+'),true);
                xmlhttp.send();
            }
            
            
            function newQuestion(){
                var functional = document.getElementById("domanda_funzionale").value;
                var disfunctional = document.getElementById("domanda_disfunzionale").value;
                var lang = document.getElementById("language_selection").value;
                var cat = document.getElementById("category_selection").value;
                var subcat = document.getElementById("subcategory_selection").value;
                var fhint = document.getElementById("suggerimento_funzionale").value;
                var dhint = document.getElementById("suggerimento_disfunzionale").value;
             
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        alert(this.response);
                        location.reload();
                        activateQuestions();
                    }
                };
                
                
                xmlhttp.open("GET","PHP/addQuestion.php?functional=" + functional.replace(' ' , '+') + "&disfunctional=" + disfunctional.replace(' ', '+') + "&lang=" + lang.replace(' ', '+' ) + "&cat=" + cat.replace(' ', '+') + "&subcat=" + subcat.replace(' ','+') + "&fhint=" + fhint.replace(' ','+') + "&dhint=" + dhint.replace(' ', '+'),true);
                xmlhttp.send();
                
            }
            
            function newAnswer(){
                var description = document.getElementById("answer_description").value;
                var fweight = document.getElementById("functional_w").value;
                var dweigth = document.getElementById("disfunctional_w").value;
                var lang = document.getElementById("language_answer_selection").value;
                var cat = document.getElementById("category_answer_selection").value;
                
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        alert(this.response);
                        location.reload();
                        activateAnswer();
                    }
                };
                xmlhttp.open("GET","PHP/addAnswer.php?description=" + description.replace(' ', '+') + "&fweight=" + fweight + "&dweight=" + dweigth + "&lang=" + lang.replace(' ', '+') + "&cat=" + cat.replace(' ', '+') ,true);
                xmlhttp.send();
                
            }
            
            function removeCategory(){
                var id = document.getElementById("category_remove_id").value;
                
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        alert(this.response);
                        location.reload();
                        activateCategory();
                    }
                };
                xmlhttp.open("GET","PHP/removeCategory.php?id=" + id,true);
                xmlhttp.send();
            }
            
             function removeSubcategory(){
                var id = document.getElementById("subcategory_id").value;
                
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        alert(this.response);
                        location.reload();
                        activateSubcategory();
                    }
                };
                xmlhttp.open("GET","PHP/removeSubcategory.php?id=" + id,true);
                xmlhttp.send();
            }
            
             function removeLanguage(){
                var id = document.getElementById("language_remove_id").value;
                
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        alert(this.response);
                        location.reload();
                        activateLanguage();
                    }
                };
                xmlhttp.open("GET","PHP/removeLanguage.php?id=" + id,true);
                xmlhttp.send();
            }
            
             function removeQuestion(){
                var id = document.getElementById("question_remove_id").value;
                 
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        alert(this.response);
                        location.reload();
                        activateQuestions();
                    }
                };
                xmlhttp.open("GET","PHP/removeQuestion.php?id=" + id,true);
                xmlhttp.send();
            }
            
            function removeAnswer(){
                var id = document.getElementById("remove_answer_id").value;
                
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        alert(this.response);
                        location.reload();
                        activateAnswer();
                    }
                };
                xmlhttp.open("GET","PHP/removeAnswer.php?id=" + id,true);
                xmlhttp.send();
            }
            
            function activateCategory(){
                document.getElementById("category").style.display="block";
                document.getElementById("language").style.display="none";
                document.getElementById("questions").style.display="none";
                document.getElementById("answer").style.display="none";
                document.getElementById("subcategories").style.display="none";
                document.getElementById("categoryLink").classList.add("active");
                document.getElementById("languageLink").classList.remove("active");
                document.getElementById("questionsLink").classList.remove("active");
                document.getElementById("answerLink").classList.remove("active");
                document.getElementById("subcategoryLink").classList.remove("active");
            }
            
            function activateLanguage(){
                document.getElementById("category").style.display="none";
                document.getElementById("language").style.display="block";
                document.getElementById("questions").style.display="none";
                document.getElementById("answer").style.display="none";
                document.getElementById("subcategories").style.display="none";
                document.getElementById("categoryLink").classList.remove("active");
                document.getElementById("languageLink").classList.add("active");
                document.getElementById("questionsLink").classList.remove("active");
                document.getElementById("answerLink").classList.remove("active");
                document.getElementById("subcategoryLink").classList.remove("active");
            }
            
            function activateQuestions(){
                document.getElementById("category").style.display="none";
                document.getElementById("language").style.display="none";
                document.getElementById("questions").style.display="block";
                document.getElementById("answer").style.display="none";
                document.getElementById("subcategories").style.display="none";
                document.getElementById("categoryLink").classList.remove("active");
                document.getElementById("languageLink").classList.remove("active");
                document.getElementById("questionsLink").classList.add("active");
                document.getElementById("answerLink").classList.remove("active");
                document.getElementById("subcategoryLink").classList.remove("active");
            }
            
            function activateAnswer(){
                document.getElementById("category").style.display="none";
                document.getElementById("language").style.display="none";
                document.getElementById("questions").style.display="none";
                document.getElementById("answer").style.display="block";
                document.getElementById("subcategories").style.display="none";
                document.getElementById("categoryLink").classList.remove("active");
                document.getElementById("languageLink").classList.remove("active");
                document.getElementById("questionsLink").classList.remove("active");
                document.getElementById("answerLink").classList.add("active");
                document.getElementById("subcategoryLink").classList.remove("active");
            }
            
            function activateSubcategory(){
                document.getElementById("category").style.display="none";
                document.getElementById("language").style.display="none";
                document.getElementById("questions").style.display="none";
                document.getElementById("answer").style.display="none";
                document.getElementById("subcategories").style.display="block";
                document.getElementById("categoryLink").classList.remove("active");
                document.getElementById("languageLink").classList.remove("active");
                document.getElementById("questionsLink").classList.remove("active");
                document.getElementById("answerLink").classList.remove("active");
                document.getElementById("subcategoryLink").classList.add("active");
            }
            
        </script>
    </head>
    <body>
        <header>
            <nav class="sidenav" id="navbar">
                <a href="#" class="active" id="categoryLink" onclick="activateCategory()">Category</a>
                <a href="#" id="subcategoryLink" onclick="activateSubcategory()">Requirement</a>
                <a href="#" id="languageLink" onclick="activateLanguage()">Language</a>
                <a href="#" id="questionsLink" onclick="activateQuestions()">Question</a>
                <a href="#" id="answerLink" onclick="activateAnswer()">Answer</a>
                <a href="PHP/survey_result.php">Result</a>
            </nav>
        </header>
        <section class="managing" id="category">
            <h2>Categories</h2>
            <article>
                <h3>List of categories</h3>
                <table>
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>NAME</td>
                            <td>DESCRIPTION</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            connect();
                            echo getCategoryTableBody();
                            closeConnection();
                        ?>
                    </tbody>
                </table>
            </article>
            <article>
                <p>New category</p>
                <p>
                    Name:
                    <input type="text" id="name"/>
                </p>
                <p>
                    Description:
                    <input type="text" id="description"/>
                </p>
                <button type="button" onclick="newCategory()">Insert</button>
            </article>
            <article>
                <p>Drop category</p>
                <p>
                    ID:
                    <input type="text" id="category_remove_id"/>
                </p>
                <button type="button" onclick="removeCategory()">Drop</button>
            </article>
        </section>
        <section class="managing" id="language">
            <h2>Languages</h2>
            <article>
                <h3>Listo of languages</h3>
                <table>
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>ACRONYM</td>
                            <td>NAME</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            connect();
                            echo getLanguageTableBody();
                            closeConnection();
                        ?>
                    </tbody>
                </table>
            </article>
            <article>
                <p>New language</p>
                <p>
                    Acronym:
                    <input type="text" id="acronym"/>
                </p>
                <p>
                    Name:
                    <input type="text" id="languageName"/>
                </p>
                <button type="button" onclick="newLanguage()">Insert</button>
            </article>
            <article>
                <p>Drop language</p>
                <p>
                    ID:
                    <input type="text" id="language_remove_id"/>
                </p>
                <button type="button" onclick="removeLanguage()">Drop</button>
            </article>
        </section>
        <section class = "managing" id="subcategories">
            <h2>Requirements</h2>
            <article>
                <h3>List of requirements</h3>
                <table>
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>NAME</td>
                            <td>DESCRIPTION</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            connect();
                            echo getSubcategoryTableBody();
                            closeConnection();
                        ?>
                    </tbody>
                </table>
            </article>
            <article>
                <p>New requirement</p>
                <p>
                    Name:
                    <input type="text" id="subcategory_name"/>
                </p>
                <p>
                    Description:
                    <input type="text" id="subcategory_description" />
                </p>
                <input type="button" value="Insert" onclick="newSubcategory()"/>
            </article>
            <article>
                <p>Drop requirement</p>
                <p>
                    Id:
                    <input type="text" id="subcategory_id" />
                </p>
                <input type="button" value="Drop" onclick="removeSubcategory()"/>
            </article>
        </section>
        <section class="managing" id = "questions">
            <h2>Questions</h2>
            <article>
                <h3>List of questions</h3>
                <table>
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>DESCRIPTION</td>
                            <td>FUNCTIONAL</td>
                            <td>FUNCTIONAL ID</td>
                            <td>LANGUAGE</td>
                            <td>CATEGORY</td>
                            <td>REQUIRE</td>
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
            <article>
                <p>New question</p>
                <p>
                    Functional question:
                    <input type="textarea" id="domanda_funzionale">
                </p>
                <p>
                    Functional hint:
                    <input type="textarea" id="suggerimento_funzionale">
                </p>
                <p>
                    Dysfunctional question:
                    <input type="textarea" id="domanda_disfunzionale">
                </p>
                <p>
                    Dysfunctional hint:
                    <input type="textarea" id="suggerimento_disfunzionale">
                </p>
                <p>
                    Language:
                    <?php
                        connect();
                        $language = getLanguageArray();
                        closeConnection();
                        $num_of_lang = sizeof($language);
                        echo '<select id = "language_selection" size = "' . $num_of_lang . '">';
                        foreach ($language as $lang){
                            if(strcmp($lang,$language[0]) == 0)
                                echo '<option value = "' . $lang . '" selected>'.$lang."</option>";
                            else
                                echo '<option value = "' . $lang . '">'.$lang."</option>";
                        }
                        echo '</select>';
                    ?>
                </p>
                <p>
                    Category:
                    <?php
                        connect();
                        $category = getCategoryArray();
                        closeConnection();
                        $num_of_cat = sizeof($category);
                        echo '<select id = "category_selection" size = "' . $num_of_cat . '">';
                        foreach ($category as $cat){
                            if(strcmp($cat,$category[0]) == 0)
                                echo '<option value = "' . $cat . '" selected>'. $cat ."</option>";
                            else
                                echo '<option value = "' . $cat . '">'. $cat ."</option>";
                        }
                        echo '</select>';
                    ?>
                </p>
                 <p>
                    Requirement:
                    <?php
                        connect();
                        $subcategory = getSubcategoryArray();
                        closeConnection();
                        $num_of_subcat = sizeof($subcategory);
                        echo '<select id = "subcategory_selection" size = "' . $num_of_subcat . '">';
                        foreach ($subcategory as $subcat){
                            if(strcmp($subcat,$subcategory[0]) == 0)
                                echo '<option value = "' . $subcat . '" selected>'. $subcat ."</option>";
                            else
                                echo '<option value = "' . $subcat . '">'. $subcat ."</option>";
                        }
                        echo '</select>';
                    ?>
                </p>
                <button type="button" onclick="newQuestion()">Insert</button>
            </article>
            <article>
                <p>Drop question</p>
                <p>
                    ID:
                    <input type="text" id="question_remove_id"/>
                </p>
                <button type="button" onclick="removeQuestion()">Drop</button>
            </article>
        </section>
        <section class="managing" id="answer">
            <h2>Answers</h2>
            <article>
                <h2>List of answers</h2>
                <table>
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>DESCRIPTION</td>
                            <td>FUNCTIONAL WEIGHT</td>
                            <td>DYSFUNCTIONAL WEIGHT</td>
                            <td>LANGUAGE</td>
                            <td>CATEGORY</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            connect();
                            echo getResponseTableBody();
                            closeConnection();
                        ?>
                    </tbody>
                </table>
            </article>
            <article>
                <p>New answer</p>
                <p>
                    Description:
                    <input type="textArea" id="answer_description"/>
                </p>
                <p>
                    Functional weight:
                    <input type="text" id="functional_w"/>
                </p>
                <p>
                    Dysfunctional weight:
                    <input type="text" id ="disfunctional_w"/>
                </p>
                <p>
                    Language:
                    <?php
                        connect();
                        $language = getLanguageArray();
                        closeConnection();
                        $num_of_lang = sizeof($language);
                        echo '<select id = "language_answer_selection" size = "' . $num_of_lang . '">';
                        foreach ($language as $lang){
                            if(strcmp($lang,$language[0]) == 0)
                                echo '<option value = "' . $lang . '" selected>'.$lang."</option>";
                            else
                                echo '<option value = "' . $lang . '">'.$lang."</option>";
                        }
                        echo '</select>';
                    ?>
                </p>
                <p>
                    Category:
                    <?php
                        connect();
                        $category = getCategoryArray();
                        closeConnection();
                        $num_of_cat = sizeof($category);
                        echo '<select id = "category_answer_selection" size = "' . $num_of_cat . '">';
                        foreach ($category as $cat){
                            if(strcmp($cat,$category[0]) == 0)
                                echo '<option value = "' . $cat . '" <selected>'. $cat ."</option>";
                            else
                                echo '<option value = "' . $cat . '">'. $cat ."</option>";
                        }
                        echo '</select>';
                    ?>
                </p>
                <button type="button" onclick="newAnswer()">Insert</button>
            </article>
            <article>
                <p>Drop answer</p>
                <p>
                    ID:
                    <input type="text" id="remove_answer_id"/>
                </p>
                <button type="button" onclick="removeAnswer()">Drop</button>
            </article>
        </section>
    </body>
</html>