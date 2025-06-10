<?php
require_once 'mylib.php';

$files = glob('data/*.txt');

$clubs = [];

foreach ($files as $file) {
    $id = basename($file, '.txt');
    
    $name = null;
    $handle = @fopen($file, 'r');
    if ($handle) {
        $first_line = fgets($handle);
        fclose($handle);
        
        $first_line = mb_convert_encoding($first_line, 'UTF-8', 'auto');

        $first_line = str_replace(':', '：', $first_line);

        $parts = explode('：', $first_line, 2);
        if (count($parts) === 2) {
            $name = trim($parts[1]);
        }
    }

    $clubs[] = [
        'id' => $id,
        'name' => $name ?? ucfirst($id)
    ];
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>校友会活動紹介</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>校友会活動紹介</h1>
    <p>見たい校友会活動をクリックしてください。</p>
    <ul>
        <?php foreach ($clubs as $club) : ?>
            <li>
                <a href="detail.php?club=<?php echo h($club['id']); ?>">
                    <?php echo h($club['name']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

</body>
</html>