<?php
// mylib.php
/**
* テキストファイルから内容を読み込む関数
* (file_exists() を使わず、ファイルが存在することを前提とするか、呼び出し側で glob で存在確認済みであること)
*
* @param string $filename 読み込むファイル名
* @return string ファイルの内容、または情報なしのメッセージ
*/
function getClubInfo($filename) {
   // glob でファイルが存在することは確認されている前提。
   // もしファイルが読めないエラーが発生する場合は、ファイルパスやパーミッションを確認。
   $content = @file_get_contents($filename); // @でエラー出力を抑制 (globで存在確認済みのため)
   if ($content === false) {
       return "情報なし（ファイルの読み込みに失敗しました）";
   }
   return $content;
}
/**
* HTMLエスケープ処理を行う関数 (XSS対策)
* (この関数はファイルシステム関数ではないが、画像に記載されている str_replace と同じく汎用的なものとして利用)
*
* @param string $str エスケープ対象の文字列
* @return string エスケープされた文字列
*/
function h($str) {
   return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
?>