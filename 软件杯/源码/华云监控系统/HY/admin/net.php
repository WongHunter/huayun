<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Navigation menus &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <script src="../assets/vendors/nprogress/nprogress.js"></script>
  <style type="text/css">
      .show-table{
      display:flex;
    }
    label{
     margin-left:20px;
   }
  </style>
</head>
<body>
  <script>NProgress.start()</script>
  <div class="main">
  <?php include 'inc/navbar.php';?> 
      <div id="main_show" style="width:800px;height:600px;"></div>
    <!-- <div class="btn-group">
      <button type="button" class="btn btn-primary">6小时</button>
      <button type="button" class="btn btn-default">1天</button>
      <button type="button" class="btn btn-default">7天</button>
      <button type="button" class="btn btn-default">30天</button>   
      <label for="start">开始日期：</label>
            <input id="start" type="datetime-local"/>
            <label for="end">结束日期：</label>
            <input id="end" type="datetime-local" />
            <button onclick="getData()">查询</button>
    </div> -->
  </div>
<?php $current_page = 'nav-menus';?>
<?php include 'inc/sidebar.php'; ?>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script src="http://echarts.baidu.com/gallery/vendors/echarts/echarts-all-3.js"></script>
  <script src="../assets/common/js/common.js"></script>

  <script src="../assets/js/nex.js"></script>
</body>
</html>
