<?php
require_once 'function.php';

try{
    $pdo = connectDB();
    
    if(isset($_POST['prefecture'])){
    
        $prefecture = $_POST['prefecture'];
        
        $stmt = $pdo->prepare("SELECT * FROM form_content WHERE todoufuken = '".$prefecture."'");
        $stmt->execute();
    

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width-device-width, initial-scale=1">
        <title>都道府県から検索</title>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="search.css" type="text/css" />
    </head>
    
    <body>
        <div id="search_index">
            <header>
                <div id="title_photo">
                    <a href="index.php"><img src="images2/FOOD TRIP-logo.png" alt="FOOD_TRIP" title="タイトル画像" width="600" height="150"></img></a>
                </div>
            </header>
            
            <main>
                <p id='main_p'><?php echo $prefecture ;?>にある店舗です。気になる店舗名をクリックしてみましょう。</p>
                <ul>
                    
                    <?php
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        // $_SESSION['access_store'] = $row['store'];
                        echo "<li>";
                        echo "<p id='list_p'><a href='detail.php?store_from_search=".$row['store']."'>" .$row['store']. "</a></p>";
                        echo "</li>\n";
                    }
                    
                    ?>
                </ul>
                
            </main>
        </div>
    </body>
    
<?php 
}
} catch(PDOException $e){
    print "エラーメッセージ:{$e->getMessage()}";
}
?>

</html>