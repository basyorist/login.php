<?php
include('functions.php');
$pdo = connect_to_db();

// var_dump($GET);
// exit();

// id受け取り
$id = $_GET['id'];


// DB接続
$pdo = connect_to_db();

// SQL実行
$sql = 'SELECT * FROM users_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result = $stmt->fetch(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（編集画面）</title>
</head>

<body>
  <form action="todo_update.php" method="POST">
    <fieldset>
      <legend>DB連携型todoリスト（編集画面）</legend>
      <a href="todo_read.php">一覧画面</a>
      <div>
        username: <input type="text" name="username" value="<?= $result['username'] ?>">
      </div>
      <div>
        password: <input type="text" name="password" value="<?= $result['password'] ?>">
      </div>
      <div>
        is_admin : <input type="text" name="is_admin" value="<?= $result['is_admin'] ?>">
      <div>
      <input type="hidden" name="id" value="<?= $result['id'] ?>">
    </div>
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>

</body>

</html>