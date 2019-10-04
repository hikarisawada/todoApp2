<?php


// require_once('config.php');


// // 新規登録ボタン押したら
// if (isset($_POST['signup'])) {
//   if (empty($_POST['email'])) {
//     echo 'emailが未入力です。';
//   }
//   if (empty($_POST['password'])) {
//     echo 'パスワードが未入力です。';
//   }
// // メアドもパスワードも入ってたら
//   if (!empty($_POST['email']) && !empty($_POST['password'])) {
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//
//     // DBに繋いで、
//     $dbh = db_connect();
//
//     $query = $dbh->prepare('SELECT * FROM users WHERE email = :email');
//     $query->bindValue(':email', $email, PDO::PARAM_STR);
//     $query->execute();
//     $result = $query->fetch();
//
//     if ($result > 0) {
//       echo 'このメールアドレスは既に登録されています';
//
//     } else {
//       // sql、「:email」の部分？で書くこともできるらしい
//       $sql = 'insert into users (email, password) values(:email, :password)';
//       $stmt = $dbh->prepare($sql);
//       $password = password_hash($password, PASSWORD_DEFAULT);
//       $stmt->bindValue(':email', $email, PDO::PARAM_STR);
//       $stmt->bindValue(':password', $password, PDO::PARAM_STR);
//       $stmt->execute();
//       // $stmt->execute(array($email, password_hash($password, PASSWORD_DEFAULT)));
//       $userid = $dbh->lastinsertid();
//       // 新規登録からログインページにリダイレクト
//       header('Location:  login.php');
//       echo '登録しました！';
//     }
//
//


//   }
// }


 ?>

 <!DOCTYPE html>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <title>Sign Up!</title>
     <link rel="stylesheet" href="styles3.css">
   </head>

   <body>
     <header>
       <nav>
         <ul>
           <li class="top"><a href="top2.php">todoApp</a></li>
           <li class="menu"><a href="login2.php">loginはこちら</a></li>
         </ul>
       </nav>

     </header>
     <h2>新規登録ページ</h2>
     <form class="signup-form" action="" method="post">
       <div>
         <label>メールアドレス</label>
         <input type="email" name="email" value="" id="email"  placeholder="info@sample.com">
       </div>
       <div>
         <label>パスワード</label>
         <input type="password" name="password" id="password"  value="">
       </div>
       <div>
         <input type="submit" name="signup" id="signup" value="新規登録する">
       </div>
       <!-- <a href="/login.php">ログイン</a> -->
     </form>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
     <script type="text/javascript">
     $('#signup').on('click', function() {
       $.post("signuptest.php", {
         email: $('#email').val(),
         password: $('#password').val()
       },
         function(data){
           let login_data = JSON.parse(data);
           // function set() {
           //   localStorage.setItem('id', login_data['id']);
           // }
           alert("Data Loaded: " + login_data['email'] + login_data['password']);
           // if (login_data['id'] === undefined) {
           //   alert("メールアドレスかパスワードが間違っています");
           //
           // } else {
             window.location.href = 'login2.php';
           // }

         });
     });

     </script>
   </body>
 </html>
