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
        .output { background-color: #f9f9f9; border: 1px solid #ddd; padding: 15px; margin-top: 10px; white-space: pre-wrap; }
        .back-link { display: inline-block; margin-top: 20px; }
    </style>
</head>
<body>

<div class="container">
    <h1>部活動詳細</h1>

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