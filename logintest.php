<?php

require_once('config2.php');

$obj = [
  'email'     => $_POST['email'],
  'password'     => $_POST['password'],
  // 'id'     => $row['id'],
];

// var_dump($obj['email']);


// require_once('config2.php');
// セッションを持たせとく

// $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
// $token = $_SESSION['token'];


// 既にログインしている場合にはプロフィールに遷移
// if (!empty($_SESSION["id"])) {
// header('Location: top.php');
// exit;
// }

// エラーメッセージの初期化
// $error_message = "";

// ログインぽたんが押された時
  // 空だったらエラー出す
  if (empty($_POST['email'])) {
    echo 'メールアドレスが記入されていません。';
  }
  if (empty($_POST["password"])) {
    echo 'パスワードが記入されていません。';
  }
   // 空じゃなかったら
  // if (!empty($_POST['email']) && !empty($_POST['password'])) {
  // // DBに繋いで、
  //
  try {
    $dbh = db_connect();

    // sql、「:email」の部分？で書くこともできるらしい
    $sql = 'select * from users where email = :email';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    // $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($stmt->fetch(PDO::FETCH_ASSOC));
    // $stmt->execute(array($email, password_hash($password, PASSWORD_DEFAULT)));
    // $userid = $dbh->lastinsertid();

  } catch (\Exception $e) {
    echo $e->getMessage();
  }

    // $password = $_POST["password"];
    // var_dump($row['password']);

    if (!isset($row['email'])) {
      echo 'メールアドレスまたはパスワードが間違っています1';
      return false;
    }

    if (password_verify($_POST['password'], $row['password']))   {
      session_regenerate_id(true);

      $obj = [
        'email'     => $_POST['email'],
        'password'     => $_POST['password'],
        'id'     => $row['id'],
      ];
      // $_SESSION['id'] = $row['id'];
    //   // $_SESSION['password'] = $row['password'];
    //   // var_dump($_SESSION['id']);
    //
    //
    //   // header('Location: top.php');
    // } else {
    //   // var_dump($_POST['password']);
    //   echo 'メールアドレスまたはパスワードが間違っています2';
    //
    //   return false;
    }





// echo "id";





// 普通のPHPファイルで最後に
// json_encodeしてあげればよし
// debug方法は、login.phpを確認する
// echoで逐一取得できているか確認する
// 本来だったらここにemail, passwordが一緒だったらuser_idを返却するみたいな処理を書く

echo json_encode($obj);

?>
