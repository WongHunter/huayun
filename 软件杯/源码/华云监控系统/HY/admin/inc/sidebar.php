<?php

// 因为这个 sidebar.php 是被 index.php 载入执行，所以 这里的相对路径 是相对于 index.php
// 如果希望根治这个问题，可以采用物理路径解决
require_once '../static/function.php';
// $current_page = isset($current_page) ? $current_page : '';
$current_user = xiu_get_current_user();

?>
  <div class="aside">
    <div class="profile"> 
      <img class="avatar" src="<?php echo $current_user['avatar']; ?>">
      <h3 class="name"><?php echo $current_user['nickname']; ?></h3>
    </div>
    <ul class="nav">
      <li <?php echo $current_page == 'index' ? 'class ="active"' : '' ?>>
        <a href="index.php"><i class="fa fa-dashboard"></i>总览</a>
      </li>
      <?php $menu_posts = array('posts','categories');?>
      <li <?php echo in_array($current_page, $menu_posts) ? 'class ="active"' : '' ?>>
        <a href="#menu-posts" data-toggle="collapse">
          <i class="fa fa-thumb-tack"></i>资源类型<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-posts" class="collapse <?php echo in_array($current_page, $menu_posts) ? ' in' : ''  ?>">
          <li <?php echo $current_page == 'posts' ? 'class ="active"' : '' ?>><a href="host.php">用户组</a></li>
          <li <?php echo $current_page == 'categories' ? 'class ="active"' : '' ?>><a href="cloudHost.php">云主机</a></li>
        </ul>
      </li>
      <li <?php echo $current_page == 'comments' ? 'class ="active"' : '' ?>>
        <a href="journalMsg.php"><i class="fa fa-comments"></i>日志信息</a>
      </li>
      <li <?php echo $current_page == 'users' ? 'class ="active"' : '' ?>>
        <a href="users.php"><i class="fa fa-users"></i>访问控制</a>
      </li>
      <?php $menu_settings = array('nav-menus','slides','settings','net'); ?>
      <li <?php echo in_array($current_page, $menu_settings) ? 'class ="active"' : '' ?>>
        <a href="#menu-settings" class="collapsed" data-toggle="collapse">
          <i class="fa fa-cogs"></i>性能监控<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-settings" class="collapse <?php echo in_array($current_page, $menu_settings) ? ' in' : ''  ?>">
          <li <?php echo $current_page == 'nav-menus' ? 'class ="active"' : '' ?>><a href="cpu.php">CPU</a></li>
          <li <?php echo $current_page == 'slides' ? 'class ="active"' : '' ?>><a href="storage.php">内存</a></li>
          <li <?php echo $current_page == 'settings' ? 'class ="active"' : '' ?>><a href="disk.php">磁盘</a></li>
          <li <?php echo $current_page == 'net' ? 'class ="active"' : '' ?>><a href="net.php">公网IP</a></li>
        </ul>
      </li>
      <?php $menu_settings1 = array('nav-menus1','slides1','settings1','people'); ?>
      <li <?php echo in_array($current_page, $menu_settings1) ? 'class ="active"' : '' ?>>
        <a href="#menu-settings1" class="collapsed" data-toggle="collapse">
          <i class="fa fa-cogs"></i>监控报警<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-settings1" class="collapse <?php echo in_array($current_page, $menu_settings1) ? ' in' : ''  ?>">
          <li <?php echo $current_page == 'nav-menus1' ? 'class ="active"' : '' ?>><a href="#">监控列表</a></li>
          <li <?php echo $current_page == 'slides1' ? 'class ="active"' : '' ?>><a href="#">监控规则</a></li>
          <li <?php echo $current_page == 'settings1' ? 'class ="active"' : '' ?>><a href="#">监控历史</a></li>
          <li <?php echo $current_page == 'people' ? 'class ="active"' : '' ?>><a href="#">监控联系人</a></li>
        </ul>
      </li>
    </ul>
  </div>