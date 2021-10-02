<?php

try {
  $db = new PDO('mysql:dbname=mini_bbs; host = 127.0.0.1; charset = utf-8', 'root', 'root');
} catch (PDOException $e) {
  print('DB接続エラー：' . $e->getMessage());
}
