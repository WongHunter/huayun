<?php
require_once '../static/function.php';

function add_user(){

  if (empty($_POST['email']) || empty($_POST['slug']) || empty($_POST['nickname']) || empty($_POST['password'])) {
  
     $GLOBALS['message'] = '请完整填写表单';
            
            return;
      }
  $email = $_POST['email'];
  $slug = $_POST['slug'];
  $nickname = $_POST['nickname'];
  $password = $_POST['password'];

  xiu_execute(" insert into users values (null,'{$slug}','{$email}','{$password}','{$nickname}','../uploads/hots_5.jpg',null,'activated');");

}
function edit_users(){

  global $current_edit_users;
  
  $id = $current_edit_users['id'];
  $email = empty($_POST['email']) ? $current_edit_users['email'] : $_POST['email'] ;
  $slug = empty($_POST['slug']) ? $current_edit_users['slug'] : $_POST['slug'];

  $nickname = empty($_POST['nickname']) ? $current_edit_users['nickname'] : $_POST['nickname'];
  $password = empty($_POST['password']) ? $current_edit_users['password'] : $_POST['password'];
    xiu_execute("update users set slug ='{$slug}',email='{$email}',password = '{$password}',nickname = '{$nickname}' where id = {$id}");
}
if (empty($_GET['id'])) {
 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    add_user();
  }
}else{
     $current_edit_users =xiu_fetch_one('select * from users where id = '.$_GET['id']);

      if ($_SERVER['REQUEST_METHOD'] == 'POST'){

       edit_users(); 
     }
  }



$xiu_users = xiu_fetch_all("select * from users");
       
?> 

<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Users &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <script src="../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
<?php include 'inc/navbar.php';?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>用户</h1>
      </div>
      <?php if ($GLOBALS['message']): ?>
        <!-- 有错误信息时展示 -->
      <div class="alert alert-danger">
        <strong>错误！</strong><?php echo $GLOBALS['message']; ?>
      </div>
      <?php endif ?>

      <div class="row">
        <div class="col-md-4">
            <?php if (isset($current_edit_users)):?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $current_edit_users['id'];?>" method="post">
            <h2>编辑<?php echo $current_edit_users['nickname'];?></h2>
            <div class="form-group">
              <label for="email">邮箱</label>
              <input id="email" class="form-control" name="email" type="email" placeholder="邮箱" value="<?php echo $current_edit_users['email'];?>"readonly>
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug" value="<?php echo $current_edit_users['slug'];?>">
              <p class="help-block">https://zce.me/author/<strong>slug</strong></p>
            </div>
            <div class="form-group">
              <label for="nickname">昵称</label>
              <input id="nickname" class="form-control" name="nickname" type="text" placeholder="昵称" value="<?php echo $current_edit_users['nickname'];?>">
            </div>
            <div class="form-group">
              <label for="password">密码</label>
              <input id="password" class="form-control" name="password" type="text" placeholder="密码"<?php echo $current_edit_users['password'];?>>
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">保存</button>
            </div>
          </form>
            <?php else: ?>
          <form action= "<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
            <h2>添加子新用户</h2>
            <div class="form-group">
              <label for="email">邮箱</label>
              <input id="email" class="form-control" name="email" type="email" placeholder="邮箱">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
            </div>
            <div class="form-group">
              <label for="nickname">用户组</label>
              <input id="nickname" class="form-control" name="nickname" type="text" placeholder="昵称">
            </div>
            <div class="form-group">
              <label for="password">密码</label>
              <input id="password" class="form-control" name="password" type="text" placeholder="密码">
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">添加</button>
            </div>
          </form>
          <?php endif ?>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a id = "btn_delete" class="btn btn-danger btn-sm" href="users-delete.php" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
               <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th class="text-center" width="80">头像</th>
                <th>邮箱</th>
                <th>别名</th>
                <th>用户组</th>
                <th>状态</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
             <?php foreach ($xiu_users as $item): ?>
              <tr>
                <td class="text-center"><input type="checkbox" data-id = "<?php echo $item['id']
                 ?>"></td>
                <td class="text-center"><img class="avatar" src="<?php echo $item['avatar']?>"></td>
                <td><?php echo $item['email'] ?></td>
                <td><?php echo $item['slug']?></td>
                <td><?php echo $item['nickname']?></td>
                <td><?php echo $item['status']?></td>
                <td class="text-center">
                  <a href="users.php?id=<?php echo $item['id'];?>" class="btn btn-default btn-xs">编辑</a>
                  <a href="users-delete.php?id=<?php echo $item['id'];?>" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
             <?php endforeach ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
     <?php $current_page = 'users' ?>
    <?php include 'inc/sidebar.php'; ?>
    

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script >
    $(function ($) {
      // 在表格中的任意一个 checkbox 选中状态变化时
      var $tbodyCheckboxs = $('tbody input')
      var $btnDelete = $('#btn_delete')

      // 定义一个数组记录被选中的
      var allCheckeds = []
      $tbodyCheckboxs.on('click', function () {
        // this.dataset['id']
        // console.log($(this).attr('data-id'))
        // console.log($(this).data('id'))
        var id = $(this).data('id')

        // 根据有没有选中当前这个 checkbox 决定是添加还是移除
        if ($(this).prop('checked')) {
          allCheckeds.push(id)
        } else {
          allCheckeds.splice(allCheckeds.indexOf(id), 1)
        }
          console.log(allCheckeds)
        // 根据剩下多少选中的 checkbox 决定是否显示删除
        allCheckeds.length ? $btnDelete.fadeIn() : $btnDelete.fadeOut()
        $btnDelete.prop('search', '?id=' + allCheckeds)
      })
    })
 

  </script>
</body>
</html>
