<?php
require_once 'mylib.php';

// dataフォルダにある.txtファイルの一覧を取得
$files = glob('data/*.txt');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>部活動紹介</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; }
        .container { max-width: 800px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; }
        h1 { border-bottom: 2px solid #007bff; padding-bottom: 10px; }
        ul { list-style: none; padding: 0; }
        li { margin: 10px 0; }
        a { text-decoration: none; color: #007bff; font-size: 1.2em; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="container">
    <h1>部活動紹介</h1>
    <p>見たい部活動をクリックしてください。</p>
    <ul>
        <?php foreach ($files as $file) : ?>
            <?php
            // ファイル名から拡張子(.txt)を除いた部分を取得 (例: programming)
            $club_id = basename($file, '.txt');
            // ファイル名から部活動名を作成 (例: Programming)
            $club_name = ucfirst($club_id);
            ?>
            <li>
                <a href="detail.php?club=<?php echo h($club_id); ?>">
                    <?php echo h($club_name); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

</body>
</html>