<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width-device-width, initial-scale=1">
        <title>確認画面</title>
        <link rel="stylesheet" href="map.css" type="text/css" />
        <link rel="stylesheet" href="confirm.css" type="text/css" />
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    </head>
    
    <body>
        <header>
            <div id="title_photo">
                <a href="index.php"><img src="images2/FOOD TRIP-logo.png" alt="FOOD_TRIP" title="タイトル画像" width="500" height="150"></img></a>
            </div>
        </header>
        
        <main>
            <div id="kakuninbun">
                <p>登録内容をご確認ください。</p>
            </div>
            <?php
            session_start();
            
            // post.phpの値を取得
            $_SESSION['address'] = $_POST['address'];
            $_SESSION['store'] = $_POST['store'];
            $_SESSION['category'] = $_POST['category'];
            $_SESSION['todoufuken'] = $_POST['todoufuken'];

            /*$sql = "INSERT INTO contents (address, store, category,todoufuken) VALUES (:address, :store, :category, :todoufuken)";
            $stmt = $dbn->prepare($sql);
            $params = array(':address' => $address, ':store' => $store, ':category' => $category, ':todoufuken' => $todoufuken); // 挿入する値を配列に格納する
            $stmt->execute($params);
            
            // 画像の取得
            $stt = $pdo->prepare('SELECT * FROM images ORDER BY created_at DESC'); // 登録した時系列順
            $stt->execute();
            
            $stt->bindValue(':image_name', $name, PDO::PARAM_STR);
            $stt->bindValue(':image_type', $type, PDO::PARAM_STR);
            $stt->bindValue(':image_content', $content, PDO::PARAM_STR);
            $stt->bindValue(':image_size', $size, PDO::PARAM_STR);*/
                
            
            
            ?>
            

            <!--ピンが立ってるgooglemap-->
            <div id="map_pin">
                
            </div>
            <!--都道府県-->
            <div>
                <p>都道府県：<?php echo $_SESSION['todoufuken']; ?></p>
            </div>
            <!--住所-->
            <div>
                <p>住所：<?php echo $_SESSION['address']; ?></p>
            </div>
            <!--店名-->
            <div>
                <p>店名：<?php echo $_SESSION['store'];?></p>
            </div>
            <!--カテゴリ-->
            <div>
                <p>カテゴリ：<?php echo $_SESSION['category']; ?></p>
            </div>
            <!--登録写真-->
            <div>
                <?php
                $_SESSION['image_name'] = $_FILES['image']['name'];
                $_SESSION['image_type'] = $_FILES['image']['type'];
                $_SESSION['image_data'] = file_get_contents($_FILES['image']['tmp_name']);
                $_SESSION['image_size'] = $_FILES['image']['size'];
                
                require_once 'imagecopy.php'; // imagecopy.phpにて画像サイズの変更
                
                sample_resize($_FILES['image']['tmp_name']);
                
                $base64 = base64_encode($_SESSION['image_data']);
                
                echo "<img src='data:".$_SESSION['image_type'].";base64, ".$base64."'>"; // base64に変換したimage_dataを表示
                
                ?>
                
            </div>
            
            
            <input type="button" value="登録" onclick="location.href='./submit.php'"/>

            <div>
                <a href='post.php'>入力画面に戻る</a>
            </div>
        </main>
        
        <footer>
            
        </footer>
        <script>
            var jyusyo = '<?php echo $_SESSION["address"]; ?>'; // phpから住所取得

            var map;
            var marker;
            function initMap(){
                map = new google.maps.Map(document.getElementById('map_pin'), {
                    center: {lat: 35.712074, lng: 139.79843},
                    zoom: 10
                });
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    'address': jyusyo,
                    newForwardGeocoder:true
                }, function (results, status){
                    if(status === google.maps.GeocoderStatus.OK){
                        map = new google.maps.Map(document.getElementById('map_pin'), {
                            center: results[0].geometry.location,
                            zoom: 17
                        });
                        marker = new google.maps.Marker({
                            position: results[0].geometry.location,
                            map: map,
                            animation: google.maps.Animation.DROP
                        });
                    } else {
                        alert('Error: ' + status);
                    }
                });
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCex_E5qGi9_d7jNQJUu0gG2x5UoZ7l940&callback=initMap"></script>
    </body>
</html>
