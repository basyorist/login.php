<?php
// 入力項目のチェック
// var_dump($_POST);
// exit();
include('functions.php');



if (
  !isset($_POST['username']) || $_POST['username'] === '' ||
  !isset($_POST['password']) || $_POST['password'] === '' ||
  !isset($_POST['is_admin']) || $_POST['is_admin'] === '' ||
  !is_numeric($_POST['is_admin']) ||
  !isset($_POST['id']) || $_POST['id'] === ''
) {
  exit('paramError');
}

$username = $_POST['username'];
$password = $_POST['password'];
$is_admin = $_POST['is_admin'];
$id = $_POST['id'];

// DB接続
$pdo = connect_to_db();


$sql = 'UPDATE users_table SET username=:username, password=:password, is_admin=:is_admin, updated_at=now() WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':is_admin', $is_admin, PDO::PARAM_INT);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header('Location:todo_read.php');
exit();


// SQL実行
