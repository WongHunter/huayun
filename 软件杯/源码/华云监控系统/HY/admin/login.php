<?php  
   session_start();
  require_once '../static/config.php';
  
function login(){
  
  if (empty($_POST['email'])) {
       $GLOBALS['message'] = '请输入邮箱';
       return;
  }
   if (empty($_POST['password'])) {
       $GLOBALS['message'] = '请输入密码';
       return;
  }
    $email = $_POST['email'];
    $password = $_POST['password'];
    //数据库连接
  $conn =  mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
   if (!$conn) {
     exit('连接数据库失败');
   }
   $conn->query("SET NAMES utf8");
   //返回一个结果集
   $query = mysqli_query($conn,"select * from users where email = '{$email}' limit 1;");
   if (!$query) {
      $GLOBALS['message'] = '登录失败，请重试';
       return;
   }
   //获取当前用户
   $user = mysqli_fetch_assoc($query);
   if (!$user) {
    //用户名不存在
      $GLOBALS['message'] = '邮箱与密码不匹配，请重试';
       return;
   }
   if ($user['password']!==$password) {

      $GLOBALS['message'] = '邮箱与密码不匹配，请重试';
       return;
   }
   //为了后端可以直接获取当前登录用户的信息，这里直接将用户在信息放到session中
     $_SESSION['current_login_user']  = $user;

  // if ($email !== 'admin@123') {  
  //   $GLOBALS['message'] = '请输入邮箱';
  //   return;
  // }
  // if ($password !== 'admin') {  
  //   $GLOBALS['message'] = '请输入密码';
  //   return;
  // }
    header('Location: http://localhost/baixiu-pages-master/admin/index.php');
}

if($_SERVER['REQUEST_METHOD'] =='POST'){
   login();
}
 if ($_SERVER['REQUEST_METHOD'] =='GET' && isset($_GET['action']) && $_GET['action'] === 'logout') {
     unset($_SESSION['current_login_user']);
 }
?>


<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Sign in &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
  <div class="login">
    <form class="login-wrap" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <img class="avatar" src="../assets/img/default.png">
      <?php if (isset($message)): ?>
      <div class="alert alert-danger">
        <strong>错误！</strong> <?php echo $message; ?>
      </div>
      <?php endif ?>
      <div class="form-group">
        <label for="email" class="sr-only">邮箱</label>
        <input id="email"  name = "email" type="email" class="form-control" placeholder="邮箱" autofocus>
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <input id="password"  name = "password" type="password" class="form-control" placeholder="密码">
      </div>
      <button class="btn btn-primary btn-block">登 录</button>
    </form>
  </div>
  <script src="../assets/vendors/jquery/jquery.min.js"></script>
  <script type="text/javascript">
   $(function ($) {
      // 1. 单独作用域
      // 2. 确保页面加载过后执行

      // 目标：在用户输入自己的邮箱过后，页面上展示这个邮箱对应的头像
      // 实现：
      // - 时机：邮箱文本框失去焦点，并且能够拿到文本框中填写的邮箱时
      // - 事情：获取这个文本框中填写的邮箱对应的头像地址，展示到上面的 img 元素上

      var emailFormat = /^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]+$/

      $('#email').on('blur', function () {
        var value = $(this).val()

        

        // 忽略掉文本框为空或者不是一个邮箱
        if (!value || !emailFormat.test(value)) return
        
        // 用户输入了一个合理的邮箱地址
        // 获取这个邮箱对应的头像地址
        // 因为客户端的 JS 无法直接操作数据库，应该通过 JS 发送 AJAX 请求 告诉服务端的某个接口，
        // 让这个接口帮助客户端获取头像地址
           
        $.get('http://localhost/baixiu-pages-master/admin/api/avatar.php', {email: value }, function (res) {
          // 希望 res => 这个邮箱对应的头像地址
          if (!res) return
          // 展示到上面的 img 元素上
          // $('.avatar').fadeOut().attr('src', res).fadeIn()
          // console.log('哈哈')
          $('.avatar').attr('src',res);
        })
      })
    })
  </script>
</body>
</html>
