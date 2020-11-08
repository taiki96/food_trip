<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width-device-width, initial-scale=1">
        <title>Photos</title>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="photos.css" type="text/css" />
    </head>
    
    <body>
        <div id="photos_index">
        <header>
            <div id="title_photo">
                <a href="index.php"><img src="images2/FOOD TRIP-logo.png" alt="FOOD_TRIP" title="タイトル画像" width="600" height="150"></img></a>
            </div>
        </header>
        
        <main>
            <p>投稿された写真です。気になる店舗名をクリックしてみましょう。</p>
            
            <?php
            session_start();
            require_once 'function.php';

            try{
                $pdo = connectDB();
                // 画像データを取得
                $stmt = $pdo->prepare('SELECT * FROM form_content ORDER BY created_at'); // すべてのデータを投稿された順番に抽出
                $stmt->execute();
            ?>    
            
            <ul>
                <?php
                require_once 'imagecopy.php';
                
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $base64 = base64_encode($row['image_content']);
                    $_SESSION['image_type'] = $row['image_type'];
                    $img = base64_resize($base64);

                    $base64 = base64_encode($img);

                    // $_SESSION['access_store'] = $row['store'];
                    echo "<li style='list-style: none;'>";
                    echo "<img src='data:".$row['image_type'].";base64, ".$base64."'>";
                    echo "<div class='list_photos'>店舗名:<a href='detail.php?store_from_photos=".$row['store']."'>".$row['store']."</a></div>";
                    echo "</li>\n";
                }
                ?>
            </ul>
            <?php   
            } catch(PDOException $e){
                print "エラーメッセージ:{$e->getMessage()}";
            }
            
            ?>
        </main>
    </body>
</html>