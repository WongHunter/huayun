<?php

require_once '../static/function.php';

xiu_get_current_user();

// 接收筛选参数
// ==================================

$where = '1 = 1';
$search = '';

// 分类筛选
if (isset($_GET['category']) && $_GET['category'] !== 'all') {
  $where .= ' and posts.category_id = ' . $_GET['category'];
  $search .= '&category=' . $_GET['category'];
}

if (isset($_GET['status']) && $_GET['status'] !== 'all') {
  $where .= " and posts.status = '{$_GET['status']}'";
  $search .= '&status=' . $_GET['status'];
}

// $where => "1 = 1 and posts.category_id = 1 and posts.status = 'published'"
// $search => "&category=1&status=published"

// 处理分页参数
// =========================================

$size = 10;
$page = empty($_GET['page']) ? 1 : (int)$_GET['page'];
// 必须 >= 1 && <= 总页数

// $page = $page < 1 ? 1 : $page;
// if ($page < 1) {
//   // 跳转到第一页
//   header('Location: /admin/posts.php?page=1' . $search);
// }

// 只要是处理分页功能一定会用到最大的页码数
$total_count =(int)xiu_fetch_one('select count(1) as count from posts;');

var_dump($total_count);
 
$total_pages = (int)ceil($total_count/$size);

// var_dump($total_pages);

// $page = $page > $total_pages ? $total_pages : $page;
// if ($page > $total_pages) {
//   // 跳转到第最后页
//   header('Location: /admin/posts.php?page=' . $total_pages . $search);
// }

// 获取全部数据
// ===================================

// 计算出越过多少条
$offset = ($page - 1) * $size;

$posts = xiu_fetch_all("select
  posts.id,
  posts.title,
  users.nickname as user_name,
  categories.name as category_name,
  posts.created,
  posts.status
from posts
inner join categories on posts.category_id = categories.id
inner join users on posts.user_id = users.id
where {$where}
order by posts.created desc
limit {$offset}, {$size};");

// 查询全部的分类数据
$categories = xiu_fetch_all('select * from categories;');

// 处理分页页码
// ===============================

$visiables = 3;

// 计算最大和最小展示的页码
$begin = $page - ($visiables - 1) / 2;
$end = $begin + $visiables - 1;

// 重点考虑合理性的问题
// begin > 0  end <= total_pages
$begin = $begin < 1 ? 1 : $begin; // 确保了 begin 不会小于 1
$end = $begin + $visiables - 1; // 因为 50 行可能导致 begin 变化，这里同步两者关系
$end = $end > $total_pages ? $total_pages : $end; // 确保了 end 不会大于 total_pages
$begin = $end - $visiables + 1; // 因为 52 可能改变了 end，也就有可能打破 begin 和 end 的关系
$begin = $begin < 1 ? 1 : $begin; // 确保不能小于 1 // 确保不能小于 1

// 处理数据格式转换
// ===========================================

/**
 * 转换状态显示
 * @param  string $status 英文状态
 * @return string         中文状态
 */
function convert_status ($status) {
  $dict = array(
    'published' => '已发布',
    'drafted' => '草稿',
    'trashed' => '回收站'
  );
  return isset($dict[$status]) ? $dict[$status] : '未知';
}

/**
 * 转换时间格式
 * @param  [type] $created [description]
 * @return [type]          [description]
 */
function convert_date ($created) {
  // => '2017-07-01 08:08:00'
  // 如果配置文件没有配置时区
  // date_default_timezone_set('PRC');
  $timestamp = strtotime($created);
  return date('Y年m月d日<b\r>H:i:s', $timestamp);
}

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <script src="../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include 'inc/navbar.php'; ?>

    <div class="container-fluid">
      <div class="page-title">
        <h1>用户组</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
        <form class="form-inline" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <select name="category" class="form-control input-sm">
            <option value="all">所有分类</option>
            <?php foreach ($categories as $item): ?>
            <option value="<?php echo $item['id']; ?>"<?php echo isset($_GET['category']) && $_GET['category'] == $item['id'] ? ' selected' : '' ?>>
              <?php echo $item['name']; ?>
            </option>
            <?php endforeach ?>
          </select>
          <select name="status" class="form-control input-sm">
            <option value="all">所有状态</option>
            <option value="drafted"<?php echo isset($_GET['status']) && $_GET['status'] == 'drafted' ? ' selected' : '' ?>>运行</option>
            <option value="published"<?php echo isset($_GET['status']) && $_GET['status'] == 'published' ? ' selected' : '' ?>>关机</option>
            <option value="trashed"<?php echo isset($_GET['status']) && $_GET['status'] == 'trashed' ? ' selected' : '' ?>>回收站</option>
          </select>
          <button class="btn btn-default btn-sm">筛选</button>
        </form>
        <ul class="pagination pagination-sm pull-right">
          <li><a href="#">上一页</a></li>
          <?php for ($i = $begin; $i <= $end; $i++): ?>
          <li <?php echo $i === $page ? ' class="active"' : '' ?>><a href="?page=<?php echo $i . $search; ?>"><?php echo $i; ?></a></li>
          <?php endfor ?>
          <li><a href="#">下一页</a></li>
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>虚拟机名称</th>
            <th>用户</th>
            <th>分类</th>
            <th class="text-center">添加时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($posts as $item): ?>
          <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td><?php echo $item['title']; ?></td>
            <!-- <td><?php // echo get_user($item['user_id']); ?></td>
            <td><?php // echo get_category($item['category_id']); ?></td> -->
            <td><?php echo $item['user_name']; ?></td>
            <td><?php echo $item['category_name']; ?></td>
            <td class="text-center"><?php echo convert_date($item['created']); ?></td>
            <!-- 一旦当输出的判断或者转换逻辑过于复杂，不建议直接写在混编位置 -->
            <td class="text-center"><?php echo convert_status($item['status']); ?></td>
            <td class="text-center">
              <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
              <a href="post-delete.php?id=<?php echo $item['id']; ?>" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>

  <?php $current_page = 'posts'; ?>
  <?php include 'inc/sidebar.php'; ?>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
