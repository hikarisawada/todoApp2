<?php
//
// require_once('config2.php');
// // セッションを持たせとく
//
// // $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
// // $token = $_SESSION['token'];
//
//
// // 既にログインしている場合にはプロフィールに遷移
// if (!empty($_SESSION["id"])) {
// // header('Location: top.php');
// // exit;
// }
//
//
//
//
//
// // エラーメッセージの初期化
// $error_message = "";
//
// // ログインぽたんが押された時
// if (isset($_POST['login'])) {
//   // 空だったらエラー出す
//   if (empty($_POST['email'])) {
//     $error_message = 'メールアドレスが記入されていません。';
//   }
//   if (empty($_POST["password"])) {
//     $error_message = 'パスワードが記入されていません。';
//   }
//    // 空じゃなかったら
//   if (!empty($_POST['email']) && !empty($_POST['password'])) {
//     $email = $_POST['email'];
//
//   // DBに繋いで、
//   try {
//     $dbh = db_connect();
//
//     // sql、「:email」の部分？で書くこともできるらしい
//     $sql = 'select * from users where email = :email';
//     $stmt = $dbh->prepare($sql);
//     $stmt->bindParam(':email', $email, PDO::PARAM_STR);
//     // $stmt->bindValue(':password', $password, PDO::PARAM_STR);
//     $stmt->execute();
//     $row = $stmt->fetch(PDO::FETCH_ASSOC);
//     // var_dump($stmt->fetch(PDO::FETCH_ASSOC));
//     // $stmt->execute(array($email, password_hash($password, PASSWORD_DEFAULT)));
//     // $userid = $dbh->lastinsertid();
//
//   } catch (\Exception $e) {
//     echo $e->getMessage();
//   }
//
//     $password = $_POST["password"];
//     // var_dump($row['password']);
//
//     if (!isset($row['email'])) {
//       echo 'メールアドレスまたはパスワードが間違っています1';
//       return false;
//     }
//
//     if (password_verify($_POST['password'], $row['password']))   {
//       session_regenerate_id(true);
//       $_SESSION['id'] = $row['id'];
//       // $_SESSION['password'] = $row['password'];
//       // var_dump($_SESSION['id']);
//
//
//       header('Location: top.php');
//     } else {
//       // var_dump($_POST['password']);
//       echo 'メールアドレスまたはパスワードが間違っています2';
//
//       return false;
//     }
//
//   }
//
// }



 ?>




 <!DOCTYPE html>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <title>Log In!</title>
     <link rel="stylesheet" href="styles3.css">
   </head>
   <body>
     <header>
       <nav>
         <ul>
           <li class="top"><a href="top2.php">todoApp</a></li>
           <li class="menu"><a href="signup2.php">新規登録はこちら</a></li>
         </ul>
       </nav>

     </header>
     <h2>ログインページ</h2>
     <p></p>
     <form class="login-form" action="" method="post">
       <div>
         <label>メールアドレス</label>
         <input type="email" name="email" id="email" placeholder="info@sample.com" value="">
       </div>
       <div>
         <label>パスワード</label>
         <input type="password" name="password" id="password" value="">
       </div>
       <div>
         <input type="submit" name="login" id="login" value="ログイン！">
       </div>
       <!-- <a href="/login.php">ログイン</a> -->
     </form>


     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
     <script type="text/javascript">
     $('#login').on('click', function() {
       $.post("logintest.php", {
         email: $('#email').val(),
         password: $('#password').val()
       },
         function(data){
           let login_data = JSON.parse(data);
           // function set() {
             localStorage.setItem('userid', login_data['id']);
             var userid = localStorage.getItem('userid');
             // $.post("top2.php",{
             //   userid: localStorage.getItem('userid');
             // }

             // alert(userid);
           // }
           alert("Data Loaded: " + login_data['email'] + login_data['id']);
           if (login_data['id'] === undefined) {
             alert("メールアドレスかパスワードが間違っています");

           } else {
             window.location.href = 'top2.php';
           }

         });
     })

     </script>
   </body>
 </html>
