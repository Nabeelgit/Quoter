<?php
function generateRandomString($length = 9) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}
if(isset($_POST['submit'])){
    require './vendor/autoload.php';
    $conn = new MongoDB\Client('mongodb://localhost:27017');
    $table = $conn->Quoter->quotes;
    $text = $_POST['text'];
    $match = $table->findOne(['text' => $text]);
    if($match !== null) {
        echo 1;
        exit;
    }
    $id = generateRandomString();
    while($table->findOne(['id' => $id]) !== null){
        $id = generateRandomString();
    }
    $author = $_POST['author'];
    $table->insertOne(['text' => $text, 'author' => $author, 'id' => $id]);
    echo 0;
}   
?>