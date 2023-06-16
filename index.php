<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quoter</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./styles/style.css">
    <script src="./script.js" defer></script>
</head>
<body>
    <header class="fill-available">
        <div class="header-left fill-available">
            <button class="header-btn">Report</button>
        </div>  
        <div class="header-middle fill-available">
            <h1 class="header-name">Quoter</h1>
        </div>
        <div class="header-right fill-available">
            <button class="header-btn" id="submit-btn">Submit a quote</button>
        </div>
    </header>
    <div class="container">
        <form action="./search/" method="get" class="search-form">
            <input class="search-inp" placeholder="Search for authors or quotes..." name="q" autocomplete="off" required>
            <button type="submit" class="search-btn"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></button>
        </form>
        <div class="quotes fill-available">
            <?php
            require './vendor/autoload.php';
            $conn = new MongoDB\Client('mongodb://localhost:27017');
            $table = $conn->Quoter->quotes;
            $match = $table->find([], ['sort' => ['_id' => -1]]);
            foreach($match as $quote){
                ?>
            <a class="quote_box" href="./quote/?id=<?php echo urlencode($quote['id'])?>">
                <div class="text_box">
                    <span class="quote_text">"<?php echo htmlspecialchars($quote['text'])?>"</span>
                </div>
                <div class="author_box">
                    <span class="quote_author"> - <?php echo htmlspecialchars($quote['author'])?></span>
                </div>
            </a> 
                <?php
            }
            ?>
        </div>
        <div class="submit-box no-display">
            <div class="submit-top">
                <h2 style="margin: 0">Submit a quote</h2>
                <span id="submit-close">&#10005;</span>
            </div>
            <div class="submit-content">
                <form>
                    <textarea id="quote_text_submit" placeholder="Quote..." style="resize: none; font-size: 1.2rem; font-family: sans-serif" rows="3"></textarea>
                    <input id="quote_author" placeholder="Author..." style="font-size: 1.2rem" autocomplete="off">
                    <button type="submit" id="quote_submit_btn">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>