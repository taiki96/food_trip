<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <title>詳細情報</title>
        <link rel="stylesheet" href="detail.css" type="text/css" />
        <link rel="stylesheet" href="map.css" type="text/css" />
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    </head>
    
    <body>
        <div id="detail">
            <header>
                <div id="header">
                    <div id="title_photo">
                        <a href="index.php"><img src="images2/FOOD TRIP-logo.png" alt="FOOD_TRIP" title="タイトル画像" width="600" height="150"></img></a>
                    </div>
                </div>
            </header>
            
            <main>
                
                <?php
                session_start();
                require_once 'function.php';
                
                try{
                    $store = "";
                    $pdo = connectDB();
                    $sql = "SELECT address, todoufuken, category, store FROM form_content WHERE ";
                    if(@$_GET['store_from_search'] == null){
                        $sql .= "store = '".$_GET['store_from_photos']."'";
                    } else {
                        $sql .= "store = '".$_GET['store_from_search']."'";
                    }
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    
                    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                        
                
                ?>
                <!--店舗名-->
                <div>
                    <p>店舗名：<?php echo $result['store']; ?></p> <!--$_SESSION['photos_store']もしくは$_SESSION['photos_store']から値を取得-->
                </div>
                
                <!--カテゴリ-->
                <div>
                    <p>カテゴリ：<?php echo $result['category']; ?></p>
                </div>
                
                <!--登録してある写真-->
                <div>
                    
                </div>
                
                <!--住所-->
                <div>
                    <p>住所：<?php echo $result['todoufuken'] . $result['address']; ?></p>
                </div>
                
                <!--地図-->
                <div id="detail_googlemap"></div>
                
            </main>
            
            <footer>
                
            </footer>
        </div>
        <script>
            var map;
            var marker;
            var geocoder;
            var address = '<?php echo $result['todoufuken'].$result['address']; ?>';
            
            function initMap(){
                geocoder = new google.maps.Geocoder();
                
                var mapOptions = {
                    zoom: 15,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                
                map = new google.maps.Map(document.getElementById('detail_googlemap'), mapOptions);
                
                geocoder.geocode({
                    'address': address
                }, function (results, status){
                    if (status == google.maps.GeocoderStatus.OK){
                        map.setCenter(results[0].geometry.location);
                        
                        marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location
                        });
                    } else {
                        alert('Error: ' + status);
                    } 
                });
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCex_E5qGi9_d7jNQJUu0gG2x5UoZ7l940&callback=initMap"></script>
    <?php            
        }
    } catch(PDOException $e){
        print "エラーメッセージ:{$e->getMessage()}";
    }
    ?>
    </body>
</html>