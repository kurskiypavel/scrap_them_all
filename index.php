
<?php

//http://simplehtmldom.sourceforge.net/manual.htm
require_once('simple_html_dom.php');

// Create DOM from URL or file
$html = file_get_html('https://news.ontario.ca/cabinet/en');
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scrap Web App by Paul Kurskii</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">

    <style>
        ul li {
            display: none;
        }

        .show {
            display: block;
        }
    </style>
</head>

<body>
<div class="container">
    <!-- Page Content goes here -->
    <header>
        <h3>Ontario Cabinet Ministers</h3>
    </header>
    <div class="row">
        <div class="col s3">
            <div class="collection">

                <?php
                foreach ($html->find('article[class=bioCard]') as $key=>$bioCard) {
                    foreach ($bioCard->find('.bioData p a') as $ministry) {
                        echo '<a class="collection-item" id="' .$key. '">' . $ministry->innertext . '</a>';
                    }
                }
                ?>
            </div>
        </div>
        <div class="col s7">
            <ul>
                <?php

                foreach ($html->find('article[class=bioCard]') as $key=>$bioCard) {

                    echo '<li class="'.$key.'">';

                    foreach ($bioCard->find('a img') as $avatar) {
                        echo '<img src="' . $avatar->src . '" alt="">';
                    }

                    foreach ($bioCard->find('.bioData p a') as $ministry) {
                        echo '<p>' . $ministry->innertext . '</p>';
                    }
                    echo '</li>';
                }
                ?>
            </ul>

        </div>
    </div>
</div>


<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script>
    // get clicked item id
    $('a').click(function (e) {
        const ministerId = e.target.id;
        //        active css
        $('.active').removeClass('active');
        $(this).addClass('active');
        //remove any show classes from all li
        $('.show').removeClass('show');
        // find list with this id
        // set class as show to clicked list item
//        $('.'+ministerId).addClass('show');
        $('.'+ministerId).addClass('show');

    })
</script>
</body>

</html>




