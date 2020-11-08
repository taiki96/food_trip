<?php
// データベースに接続
function connectDB(){
    $parm = 'mysql:dbname=oota;host=localhost';
    try{
        $pdo = new PDO($parm, 'naviiiva_user', '!Samurai1234');
        return $pdo;
    } catch(PDOException $e){
        echo $e->getMessage();
        exit();
    }
}

?>