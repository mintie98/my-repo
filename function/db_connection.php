<?php

function connection()
{
  // ?table connect
  $server_name = "localhost";
  $user_name = "day_service";
  $db_name = "user_ds";
  $password = "day_pass";

  $options = [
    // PDOの例外エラーを詳細にする
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    // 結果を連想配列として返してくれる
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // エミュレートをオフにする
    PDO::ATTR_EMULATE_PREPARES => false,
  ];

  // データベースに接続
  try {
    return $db_conn = new PDO("mysql:host=$server_name;dbname=$user_name;charset=utf8mb4", $db_name, $password, $options);
    // 接続成功時の処理
  } catch (PDOException $e) {
    echo "データベース接続エラー: " . $e->getMessage();
  }
}