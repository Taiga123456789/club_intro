<?php
require_once 'mylib.php';

// URLパラメータから部活動IDを取得
$club_id = isset($_GET['club']) ? $_GET['club'] : '';


// --- セキュリティチェック ---
// 1. IDが英数字とアンダースコアのみで構成されているかチェック
if (!preg_match('/^[a-zA-Z0-9_]+$/', $club_id)) {
    die('不正なIDです。');
}
// 2. ファイルパスを安全に構築
$filename = 'data/' . basename($club_id) . '.txt';
// 3. ファイルが存在するかチェック
if (!file_exists($filename)) {
    die('指定された部活動の情報は見つかりませんでした。');
}
// --- セキュリティチェックここまで ---

// === 画像ファイルを探す処理を追加 ===
$image_path = null;
$extensions = ['jpg', 'jpeg', 'png', 'gif']; // 対応する拡張子リスト

foreach ($extensions as $ext) {
    $potential_image = 'images/' . $club_id . '.' . $ext;
    if (file_exists($potential_image)) {
        $image_path = $potential_image;
        break; // 画像が見つかったらループを抜ける
    }
}
// ===================================


// ファイルの内容を取得
$club_info = getClubInfo($filename);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>部活動詳細</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; }
        .container { max-width: 800px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; }
        h1 { border-bottom: 2px solid #28a745; padding-bottom: 10px; }
        
        /* 画像用のスタイルを追加 */
        .club-image {
            max-width: 100%; /* コンテナの幅に合わせて縮小 */
            height: auto;
            display: block;
            margin-bottom: 20px; /* 画像とテキストの間に余白 */
            border-radius: 8px;
        }

        .output { background-color: #f9f9f9; border: 1px solid #ddd; padding: 15px; margin-top: 10px; white-space: pre-wrap; }
        .back-link { display: inline-block; margin-top: 20px; }
    </style>
</head>
<body>

<div class="container">
    <h1>部活動詳細</h1>

    <?php if ($image_path) : // 画像が見つかった場合のみ表示 ?>
        <img src="<?php echo h($image_path); ?>" alt="<?php echo h($club_id); ?>の画像" class="club-image">
    <?php endif; ?>

    <div class="output">
        <?php
        // h()で安全にエスケープし、nl2br()で改行を<br>タグに変換して表示
        echo nl2br(h($club_info));
        ?>
    </div>

    <a href="index.php" class="back-link">&laquo; 一覧に戻る</a>
</div>

</body>
</html>