<?php

require_once '../static/function.php';

xiu_get_current_user();
  
$posts_count = xiu_fetch_one('select count(1) as num from posts;');

// var_dump($posts_count);
$categories_count = xiu_fetch_one('select count(1) as num from categories;');

$comments_count = xiu_fetch_one('select count(1) as num from comments;');

?>



<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Dashboard &laquo; Admin</title>
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
      <div class="jumbotron text-center">
        <h1>华云监控系统</h1>
        <p>Site name, hua youyun.</p>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">统计：</h3>
            </div>
            <ul class="list-group">
              <li class="list-group-item"><strong><?php echo $posts_count['num']; ?></strong>虚拟机（<strong>20</strong>台云主机）</li>
              <li class="list-group-item"><strong><?php echo $categories_count['num']; ?></strong>个资源</li>
              <li class="list-group-item"><strong><?php echo $comments_count['num'] ; ?></strong>条监控信息（<strong>1</strong>条待检查）</li>
            </ul>
          </div>
        </div>
        <div class="col-md-4">
          <canvas id="chart"></canvas>
        </div>
        <div class="col-md-4"></div>
      </div>
    </div>
  </div>
   <?php $current_page = 'index'; ?>
   <?php include 'inc/sidebar.php'; ?>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="../assets/vendors/chart/Chart.js"></script>
  <script>NProgress.done()</script>
  <script>
    var ctx = document.getElementById('chart').getContext('2d');
    var myChart = new Chart(ctx, {
      type:'pie',
      data: {
        datasets: [
          {
            data: [20,10,10],
            // data: [<?php echo $posts_count; ?>, <?php echo $categories_count; ?>, <?php echo $comments_count; ?>],
            backgroundColor: [
              'hotpink',
              'pink',
              'deeppink',
            ]
          }
        
        ],

        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: [
          'CPU',
          '内存',
          '硬盘'
        ]
      }
    });
  </script>
  <script>NProgress.done()</script>
</body>
</html>
