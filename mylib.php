<?php
function getClubInfo($filename) {
    $content = @file_get_contents($filename);
    if ($content === false) {
        return "情報なし（ファイルの読み込みに失敗しました）";
    }
    return $content;
}
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
?>