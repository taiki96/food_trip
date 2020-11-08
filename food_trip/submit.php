<?php
session_start();
require_once 'function.php';


try {
    $pdo = connectDB();
    
    $address = $_SESSION['address'];
    $store = $_SESSION['store'];
    $category = $_SESSION['category'];
    $todoufuken = $_SESSION['todoufuken'];

    

    // 写真の保存
    if(!empty($_SESSION['image_name'])){
        $name = $_SESSION['image_name'];
        $type = $_SESSION['image_type'];
        $data = $_SESSION['image_data'];
        $size = $_SESSION['image_size'];
        
        $sql = 'INSERT INTO form_content(image_name, image_type, image_content, image_size, created_at, address, store, category, todoufuken) VALUES (:image_name, :image_type, :image_content, :image_size, now(), :address, :store, :category, :todoufuken)';
        $stmt = $pdo->prepare($sql);
        // 画像データの値をセット
        $stmt->bindValue(':image_name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':image_type', $type, PDO::PARAM_STR);
        $stmt->bindValue(':image_content', $data, PDO::PARAM_LOB);
        $stmt->bindValue(':image_size', $size, PDO::PARAM_STR);
        // フォームの値をセット
        $stmt->bindValue(':address', $address);
        $stmt->bindValue(':store', $store);
        $stmt->bindValue(':category', $category);
        $stmt->bindValue(':todoufuken', $todoufuken);
        // INSERT命令の実行
        $stmt->execute();
    }
    
} catch(PDOException $e){
    print "接続エラー: {$e->getMessage()}";
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>登録完了ページ</title>
    </head>
    
    <body>
    </body>
    <script>
        alert('ご登録ありがとうございます。');
        location.href = "https://oota.naviiiva.work/food_trip/index.php";
        
    </script>
</html>