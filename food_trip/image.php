// トップページに画像出力
<?php
require_once 'function.php';
$pdo = connectDB();

$sql = 'SELECT image_content FROM form_content WHERE image_id = :image_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':image_id', (int)$_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$image = $stmt->fetch();

header('Content-type:' . $image['image_type']);
echo $image['image_content'];

unset($pdo);
exit();

?>