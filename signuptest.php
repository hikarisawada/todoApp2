<?php


require_once('config2.php');


$obj = [
  'email'     => $_POST['email'],
  'password'     => $_POST['password'],
  // 'id'     => $row['id'],
];


// 新規登録ボタン押したら
// if (isset($_POST['signup'])) {
  if (empty($obj['email'])) {
    echo 'emailが未入力です。';
    exit;
  }
  if (empty($obj['password'])) {
    echo 'パスワードが未入力です。';
    exit;
  }
// // メアドもパスワードも入ってたら
  if (!empty($obj['email']) && !empty($obj['password'])) {
    // $email = $_POST['email'];
    // $password = $_POST['password'];

    // DBに繋いで、
    $dbh = db_connect();

    $query = $dbh->prepare('SELECT * FROM users WHERE email = :email');
    $query->bindValue(':email', $obj['email'], PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch();

    if ($result > 0) {
      echo 'このメールアドレスは既に登録されています';
      exit;

    } else {
      // sql、「:email」の部分？で書くこともできるらしい
      $sql = 'insert into users (email, password) values(:email, :password)';
      $stmt = $dbh->prepare($sql);
      $password = password_hash($obj['password'], PASSWORD_DEFAULT);
      $stmt->bindValue(':email', $obj['email'], PDO::PARAM_STR);
      $stmt->bindValue(':password', $password, PDO::PARAM_STR);
      $stmt->execute();
      // $stmt->execute(array($email, password_hash($password, PASSWORD_DEFAULT)));
      $userid = $dbh->lastinsertid();
      // 新規登録からログインページにリダイレクト
      // header('Location:  login.php');
      // echo '登録しました！';
    }


    echo json_encode($obj);


  }
// }

// $obj = [
//   'email'     => $_POST['email'],
//   'password'     => $_POST['password'],
//   // 'id'     => $row['id'],
// ];

 ?>
