<?php
session_start();
require_once 'function.php';

try{
    $pdo = connectDB();
    $stmt = $pdo->prepare('SELECT * FROM form_content');
    $stmt->execute();
    $data = $stmt->fetchAll();
    
    $addressArray = array_column($data, 'address'); // 'address'のみの配列作成



?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <title>Home</title>
        <link rel="stylesheet" href="index.css" type="text/css" />
        <link rel="stylesheet" href="index_slide.css" type="text/css" />
        <!--<link rel="stylesheet" href="accordionslide.css" type="text/css" />-->
        <link rel="stylesheet" href="map.css" type="text/css" />
        <link rel="stylesheet" href="index_button.css" type="text/css" />
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    </head>
    
    <body>
        <div id="index">
            <header>
                <div id="header">
                    <div id="title_photo">
                        <a href="index.php"><img src="images2/FOOD TRIP-logo.png" alt="FOOD_TRIP" title="タイトル画像" width="600" height="150"></img></a>
                    </div>
                    <div id="mokuji">
                        <a id="link1" href="#photos">写真を見てみる</a>
                        <a id="link1" href="#post">写真を投稿する</a>
                    </div>
                </div>
            </header>
            <main>
                <div class="slide-item">
                    <div class="slideshow">
                        <div class="main-copy1">
                            <h1>
                                <span>F</span>
                                <span>O</span>
                                <span>O</span>
                                <span>D</span>
                                <span>T</span>
                                <span>R</span>
                                <span>I</span>
                                <span>P</span>
                                <span>へ</span>
                                <span>よ</span>
                                <span>う</span>
                                <span>こ</span>
                                <span>そ。</span>
                            </h1>
                            <p>
                                食べることが好きな人のためのガイドブック
                                <br>
                                好きなものを共有する場
                            </p>
                        </div>
                    </div>
                    <div class="slideshow">
                        <div class="main-copy2">
                            <h1>
                                <span>投</span>
                                <span>稿</span>
                                <span>し</span>
                                <span>よ</span>
                                <span>う。</span>
                            </h1>
                            <p>
                                あなたのオススメを共有しよう
                                <br>
                                撮影した写真を投稿しよう
                            </p>
                        </div>
                    </div>
                    <div class="slideshow">
                        <div class="main-copy3">
                            <h1>
                                <span>検</span>
                                <span>索</span>
                                <span>し</span>
                                <span>よ</span>
                                <span>う。</span>
                            </h1>
                            <p>
                                おいしいを見つけよう
                                <br>
                                お気に入りを探そう
                            </p>
                        </div>
                    </div>
                </div>

                <!--Map-->
                <div id="map">
                    <h4>Map</h4>
                    <h5>～投稿された場所～</h5>
                    <p id="setumei">地図に表示されてるアイコンは、ユーザーが投稿したポイントです。<br>あなたの近くにポイントはありますか？<br>ぜひ旅行やデートの参考にしてみてください。</p>
                    <!--googlemapの挿入-->
                    <div id="googleMap"></div>
                </div>
                
                <!--photos-->
                <div id="photos">
                    <a name="photos"></a>
                    <h4>Photos</h4>
                    <h5>～投稿された写真～</h5>
                    <p id="setumei">ユーザーが投稿した写真です。<br>興味を惹くものはありますか？<br>クリックしてチェックしてみましょう！</p>
                    <!--photos.phpへ遷移-->
                    <div id="button">
                        <input type="button" id="shasin" onclick="location.href='./photos.php'" value="Photos">
                    </div>
                </div>
                
                <!--search-->
                <div id="search">
                    <h4>Search</h4>
                    <h5>～地域から選択する～</h5>
                    <p id="setumei">探したい場所の都道府県から検索してみましょう。<br>下のフォームから興味がある場所を選択して検索ボタンを押してみよう！</p>
                    <!--検索フォーム-->
                    <div id="search_button">
                        <form method="post" action="search.php">
                            <div class="selectdiv cp_s">
                                <select name="prefecture" id="selecttag">
                                <option value="">都道府県をお選びください。</option>
                                    <optgroup label="北海道・東北">
                                    	<option value="北海道">北海道</option>
                                    	<option value="青森県">青森県</option>
                                    	<option value="秋田県">秋田県</option>
                                    	<option value="岩手県">岩手県</option>
                                    	<option value="山形県">山形県</option>
                                    	<option value="宮城県">宮城県</option>
                                    	<option value="福島県">福島県</option>
                                    </optgroup>
                                    <optgroup label="甲信越・北陸">
                                    	<option value="山梨県">山梨県</option>
                                    	<option value="長野県">長野県</option>
                                    	<option value="新潟県">新潟県</option>
                                    	<option value="富山県">富山県</option>
                                    	<option value="石川県">石川県</option>
                                    	<option value="福井県">福井県</option>
                                    </optgroup>
                                    <optgroup label="関東">
                                    	<option value="茨城県">茨城県</option>
                                    	<option value="栃木県">栃木県</option>
                                    	<option value="群馬県">群馬県</option>
                                    	<option value="埼玉県">埼玉県</option>
                                    	<option value="千葉県">千葉県</option>
                                    	<option value="東京都">東京都</option>
                                    	<option value="神奈川県">神奈川県</option>
                                    </optgroup>
                                    <optgroup label="東海">
                                    	<option value="愛知県">愛知県</option>
                                    	<option value="静岡県">静岡県</option>
                                    	<option value="岐阜県">岐阜県</option>
                                    	<option value="三重県">三重県</option>
                                    </optgroup>
                                    <optgroup label="関西">
                                    	<option value="大阪府">大阪府</option>
                                    	<option value="兵庫県">兵庫県</option>
                                    	<option value="京都府">京都府</option>
                                    	<option value="滋賀県">滋賀県</option>
                                    	<option value="奈良県">奈良県</option>
                                    	<option value="和歌山県">和歌山県</option>
                                    </optgroup>
                                    <optgroup label="中国">
                                    	<option value="岡山県">岡山県</option>
                                    	<option value="広島県">広島県</option>
                                    	<option value="鳥取県">鳥取県</option>
                                    	<option value="島根県">島根県</option>
                                    	<option value="山口県">山口県</option>
                                    </optgroup>
                                    <optgroup label="四国">
                                    	<option value="徳島県">徳島県</option>
                                    	<option value="香川県">香川県</option>
                                    	<option value="愛媛県">愛媛県</option>
                                    	<option value="高知県">高知県</option>
                                    </optgroup>
                                    <optgroup label="九州・沖縄">
                                    	<option value="福岡県">福岡県</option>
                                    	<option value="佐賀県">佐賀県</option>
                                    	<option value="長崎県">長崎県</option>
                                    	<option value="熊本県">熊本県</option>
                                    	<option value="大分県">大分県</option>
                                    	<option value="宮崎県">宮崎県</option>
                                    	<option value="鹿児島県">鹿児島県</option>
                                    	<option value="沖縄県">沖縄県</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div id="inputdiv">
                                <input type="submit" id="kennsaku" name="submit" value="検索"/>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!--post-->
                <div id="post">
                    <a name="post"></a>
                    <h4>Post</h4>
                    <h5>～気に入った場所を投稿しよう～</h5>
                    <p id="setumei">オススメを投稿して共有しよう。<br>下記フォームボタンから簡単に登録できます。</p>
                    <div id="button">
                        <input type="button" name="post_btn" id="toukoufomu" value="投稿フォームへ移動" onclick="location.href='./post.php'"/>
                    </div>
                </div>
            </main>
            <footer>
                
            </footer>
            
        </div>
        
        <script>
            var map;
            var marker;
            var geocoder;
            var addressArray = [
            <?php
                foreach($addressArray as $address) {
                    echo "'". $address ."',";
                }
            ?>
            ];
            function initMap(){
                map = new google.maps.Map(document.getElementById('googleMap'), {
                    center: {lat: 35.712074, lng: 139.79843},
                    zoom: 7
                });
                geocoder = new google.maps.Geocoder();
                for (var i = 0; i < addressArray.length; i++ ) {
                    geocoder.geocode({
                        'address': addressArray[i]
                    }, function(results, status){
                        if(status === google.maps.GeocoderStatus.OK){
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
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCex_E5qGi9_d7jNQJUu0gG2x5UoZ7l940&callback=initMap"></script>
<?php 
} catch(PDOException $e){
    print "接続エラー: {$e->getMessage()}";
}

?>
    
    </body>
</html>