<?php
if (
  !isset($_POST['username']) || $_POST['username'] === '' ||
  !isset($_POST['password']) || $_POST['password'] === '' ||
  !isset($_POST['is_admin']) || $_POST['is_admin'] === ''
) {
  exit('すべての項目を入力してください');
}

$username = $_POST['username'];
$password = $_POST['password'];
$is_admin = $_POST['is_admin'];

// DB接続
include('functions.php');
$pdo = connect_to_db();

$dbn = 'mysql:dbname=gs_dv13_00;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}

$sql = 'INSERT INTO users_table(id, username, password, is_admin, created_at, updated_at, deleted_at) VALUES(NULL, :username, :password,:is_admin,now(), now(),now())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':is_admin', $password, PDO::PARAM_INT);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:todo_input.php");
exit();
