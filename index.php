<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
include './coemFunctions.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">

    <head>
        <title>Just A Concept</title>
        <script src="async_call.js" type="text/javascript"></script>
        <meta name="description"
              content="Homepage of Just A Concept - open source group bringing new ideas for interactive media to life." />
        <meta name="keywords"
              content="Just A Concept, Games, Android, Interactive Media, Culture" />
        <link rel="shortcut icon" href="../../logo.ico" />
        <link rel="stylesheet" type="text/css" href="../../main.css" />
        <link rel="stylesheet" type="text/css" href="roommate.css" />
    </head>

    <body>
        <div class="logo">
            <img alt="logo" src="../../panel.png" />
        </div>
        <div class="buttons">
            <a class="button" href="../../index.html"><img class="button"
                                                           alt="news_button" src="../../news.png" /></a><a class="button"
                                                            href="../../games.html"><img class="button" alt="games_button"
                                         src="../../games.png" /></a><a class="button" href="../../people.html"><img
                    class="button" alt="people_button" src="../../people.png" /></a><a
                class="button" href="../../about.html"><img class="button"
                                                        alt="about_button" src="../../about.png" /></a>
        </div>
        <div class="page">
            <div id="content">
                <div class="description">
                    This is coetry. Here you can create coems - collaborative poems 
                    (or, in more standard terms <a href="http://en.wikipedia.org/wiki/Exquisite_corpse">Exquisite Corpse</a>).
                    You simply receive the last line of someone else and have to follow up with a line of pure letters and spaces of a length 10-80 characters.
                    Once 8 lines are done, the coem is listed down.
                    If no coem is available (all are finished), you get the option to start a new one with a line purely on your own.
                    Enjoy.     
                </div>

                <br />
                <button value="Open a coem" onclick="coemConnection('<?php echo session_id() ?>');" >Open a coem</button><br />
                <div id="coem_container"></div>
                <div id="user_input"></div>
                <div id="error"></div>
                <br />

                Finished Coems: <br />
                <?php
                include 'readCoems.php';
                ?>
            </div>
        </div>
        <p class="copyright">Copyright &copy; 2013 Just A Concept, Adam "PunyOne" Streck</p>
    </body>

</html>