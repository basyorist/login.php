<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型ログイン画面（入力画面）</title>
</head>

<body>
  <form action="todo_create.php" method="POST">
    <fieldset>
      <legend>DB連携型ログイン画面（入力画面）</legend>
      <a href="todo_read.php">一覧画面</a>
      <div>
        username: <input type="text" name="username">
      </div>
      <div>
        password: <input type="text" name="password">
      </div>
      <div>
        is_admin : <input type="text" name="is_admin">
      </div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>

</body>

</html>