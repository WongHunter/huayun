<?php
require_once '../static/function.php';

$xiu_comments = xiu_fetch_all('select * from comments');
// var_dump($xiu_comments);

?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Comments &laquo; Admin</title>
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
        <h1>操作日志</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <div class="btn-batch" style="display: none">
          <button class="btn btn-info btn-sm">批量批准</button>
          <button class="btn btn-warning btn-sm">批量拒绝</button>
          <button class="btn btn-danger btn-sm">批量删除</button>
        </div>
        <ul class="pagination pagination-sm pull-right">
          <li><a href="#">上一页</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">下一页</a></li>
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>资源类型</th>
            <th>资源ID名称</th>
            <th>操作内容</th>
            <th>操作结果</th>
            <th>操作数据</th>
            <th class="text-center" width="100">操作时间</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($xiu_comments as $item): ?>
          <tr class="danger">
            <td class="text-center"><input type="checkbox"></td>
            <td><?php echo $item['sourceType'] ?></td>
            <td><?php echo $item['sourceName'] ?></td>
            <td><?php echo $item['actionMoment'] ?></td>
            <td><?php echo $item['actionResult'] ?></td>
            <td><?php echo $item['data'] ?></td>
            <td><?php echo $item['time'] ?></td>
          </tr>
            
          <?php endforeach ?>


        </tbody>
      </table>
    </div>
  </div>
   <?php $current_page = 'comments' ?>
   <?php include 'inc/sidebar.php'; ?>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
