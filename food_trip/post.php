<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width-device-width, initial-scale=1">
        <title>Post</title>
        <link rel="stylesheet" href="map.css" type="text/css" />
        <link rel="stylesheet" href="post.css" type="text/css" />
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    </head>
    
    <body>
        <div id="post_body">
            <header>
                <div id="post_header">
                    <div id="title_photo">
                        <a href="index.php"><img src="images2/FOOD TRIP-logo.png" alt="FOOD_TRIP" title="タイトル画像" width="600" height="150"></img></a>
                    </div>
                </div>
            </header>
            
            <main>
                <div id="post_index">
                    
                    <p>下記の項目に登録したいお店や写真の情報を入力しよう。</p>
                    <!--googlemapの埋め込み-->
                    <div id="map_post">
                    </div>
                    
                    <div id="latlng_now">
                        <input type="button" name="現在地" value="現在地周辺" id="latlng_btn"/>
                    </div>
                    
        　　　　　　<!--画像ファイルのアップロード-->
                    <?php
                    
                    /*require_once 'function.php';
                    
                    $pdo = connectDB();
                    
                    try{
                        
                        $file = fopen($_FILES['image']['tmp_name'], 'rb');
                        $stmt->bindValue(':image_name', $name, PDO::PARAM_STR);
                        $stmt->bindValue(':image_type', $type, PDO::PARAM_STR);
                        $stmt->bindValue(':image_content', $content, PDO::PARAM_STR);
                        $stmt->bindValue(':image_size', $size, PDO::PARAM_STR);
                        // INSERT命令を実行
                        $stmt->execute();
                    } catch(PDOException $e){
                        print "エラーメッセージ:{$e->getMessage()}";
                    }
                    
                    if($_SERVER['REQUEST_METHOD'] != 'POST'){
                        // 画像を取得
                        $sql = 'SELECT * FROM images ORDER BY created_at DESC';
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $images = $stmt->fetchAll();
                        
                    } else {
                        // 画像を保存
                        if(!empty($_FILES['image']['name'])){
                            $name = $_FILES['image']['name'];
                            $type = $_FILES['image']['type'];
                            $content = file_get_contents($_FILES['image']['tmp_name']);
                            $size = $_FILES['image']['size'];
                            
                            $sql = 'INSERT INTO images(image_name, image_type, image_content, image_size, created_at) VALUES (:image_name, :image_type, :image_content, :image_size, now())';
                            
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindValue(':image_name', $name, PDO::PARAM_STR);
                            $stmt->bindValue(':image_type', $type, PDO::PARAM_STR);
                            $stmt->bindValue(':image_content', $conten, PDO::PARAM_STR);
                            $stmt->bindValue(':image_size', $size, PDO::PARAM_STR);
                            $stmt->execute();
                        }
                        unset($pdo);
                        exit();
                    }
                    unset($pdo);*/
                    
                    
                    ?>
                    
                    <!--入力フォーム-->
                    <form method="post" action="confirm.php" enctype="multipart/form-data">
                        <!--都道府県選択-->
                        <div id="post_t">
                            <label for="都道府県" id="koumoku">都道府県：</label>
                            <select name="todoufuken" id="todoufuken">
                            <option value="">選択してください。</option>
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
                        <!--住所入力-->
                        <div id="post_a">
                            <input type="search" id="keyword" name="address" value="" placeholder="都道府県以下の住所入力してください"/>
                            <input type="button" id="search" value="ピンを立てる"/>
                            <button id="clear">ピンの削除</button>
                        </div>
                        <!--店名記入-->
                        <div id="post_s">
                            <label for="店名" id="koumoku">店名：</label>
                            <input type="text" name="store" id="store"/>
                        </div>
                        <!--カテゴリ選択-->
                        <div id="post_c">
                            <label for="カテゴリ" id="koumoku">カテゴリ：</label>
                            <select name="category" id="category">
                            <option value="">選択してください。</option>
                                <optgroup label="和食">
                                    <option value="すし・魚料理">すし・魚料理</option>
                                    <option value="和食・日本料理">和食・日本料理</option>
                                    <option value="ラーメン・麺類">ラーメン・麺類</option>
                                    <option value="丼もの・揚げ物">丼もの・揚げ物</option>
                                    <option value="お好み焼き・粉もの">お好み焼き・粉もの</option>
                                    <option value="郷土料理">郷土料理</option>
                                </optgroup>
                                <optgroup label="アジア料理">
                                    <option value="アジア・エスニック">アジア・エスニック</option>
                                    <option value="中華">中華</option>
                                    <option value="韓国料理">韓国料理</option>
                                </optgroup>
                                <optgroup label="ヨーロッパ料理">
                                    <option value="イタリアン">イタリアン</option>
                                    <option value="洋食・西洋料理">洋食・西洋料理</option>
                                    <option value="フレンチ">フレンチ</option>
                                    <option value="アメリカ料理">アメリカ料理</option>
                                    <option value="アフリカ料理">アフリカ料理</option>
                                    <option value="その他国の料理">その他国の料理</option>
                                </optgroup>
                                <optgroup label="肉料理">
                                    <option value="焼肉・ステーキ">焼肉・ステーキ</option>
                                    <option value="焼き鳥・串料理">焼き鳥・串料理</option>
                                    <option value="その他肉料理">その他肉料理</option>
                                </optgroup>
                                <optgroup label="鍋料理">
                                    <option value="鍋">鍋</option>
                                    <option value="しゃぶしゃぶ・すき焼き">しゃぶしゃぶ・すき焼き</option>
                                </optgroup>
                                <optgroup label="営業形態">
                                    <option value="居酒屋・バー">居酒屋・バー</option>
                                    <option value="カフェ・スイーツ">カフェ・スイーツ</option>
                                    <option value="ファミレス・ファーストフード">ファミレス・ファーストフード</option>
                                    <option value="ビュッフェ・バイキング">ビュッフェ・バイキング</option>
                                </optgroup>
                                <optgroup label="その他">
                                    <option value="その他">その他</option>
                                </optgroup>
                            </select>
                        </div>
                        <div id="post_p">
                            <label for="画像" id="koumoku">写真の登録</label>
                            <input type="file" name="image" required/>
                        </div>
                        
                        <div id="actions">
                            <input type="submit" name="datapost" value="確認画面へ"/>
                        </div>
                    </form>
                    
                    <div id="to_index">
                        <a href="index.php">TOP画面へ</a>
                    </div>
                </div>
            </main>
            
            <footer>
                
            </footer>
        </div>
        
        <script type="text/javascript" src="map_post.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCex_E5qGi9_d7jNQJUu0gG2x5UoZ7l940&callback=initMap"></script>
    </body>
</html>