<?php

session_start();

require_once '../static/config.php';

function xiu_get_current_user () {
  if (empty($_SESSION['current_login_user'])) {
    // 没有当前登录用户信息，意味着没有登录
    // header('Location: http://localhost/baixiu-pages-master/admin/index.php');
    exit(); // 没有必要再执行之后的代码
  }
  return $_SESSION['current_login_user'];
}
//数据库封装
function xiu_fetch_all($sql){
	$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	if (!$conn) {
		exit('连接失败');
	}
	$conn->query("SET NAMES utf8");
	$query = mysqli_query($conn,$sql);
	if (!$query) {
		exit('查询失败');
		return false;
	}
	while ($row = mysqli_fetch_assoc($query)) {
       $result[] = $row;
  }
	   return $result;
	 mysqli_free_result($query);
     mysqli_close($conn);
}
function xiu_fetch_one ($sql) {
  $res = xiu_fetch_all($sql);
  return isset($res[0]) ? $res[0] : null;
}
function xiu_execute($sql){
	$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	if (!$conn) {
		exit('连接失败');
	}
	$conn->query("SET NAMES utf8");

	$query = mysqli_query($conn,$sql);

	if (!$query) {
		exit('查询失败');
		
		return false;
	}
  $affected_rows = mysqli_fetch_assoc($conn);
	 
       mysqli_close($conn);

       return $affected_rows;
}