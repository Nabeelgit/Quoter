<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../styles/quote.css">
</head>
<body>
    <div class="container">
        <?php
        if(!isset($_GET['id'])){
            header('Location: ../');
        }
        $id = $_GET['id'];
        require '../vendor/autoload.php';
        $conn = new MongoDB\Client('mongodb://localhost:27017');
        $table = $conn->Quoter->quotes;
        $match = $table->findOne(['id' => $id]);
        if($match !== null){
            $text = $match['text'];
            $author = $match['author'];
            ?>
            <div class="quote-box">
                <div class="quote">
                    <h1>
                        "<?php echo htmlspecialchars($text)?>"
                    </h1>
                </div>
                <div class="author">
                    <h2>
                        - <?php echo htmlspecialchars($author)?>
                    </h2>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</body>
</html>