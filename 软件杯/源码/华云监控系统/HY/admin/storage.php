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
   label{
     margin-left:20px;
   }
  </style>
</head>
<body>
  <script>NProgress.start()</script>
  <div class="main">
  <?php include 'inc/navbar.php';?> 
  <div id='myChart' style='width: 90%;height:400px;' class="center"></div> 
    <hr>
    <div class="btn-group">
      <button type="button" class="btn btn-primary">6小时</button>
      <button type="button" class="btn btn-default">1天</button>
      <button type="button" class="btn btn-default">7天</button>
      <button type="button" class="btn btn-default">30天</button>
        <label for="start">开始日期：</label>
        <input id="start" type="datetime-local"/>
        <label for="end">结束日期：</label>
        <input id="end" type="datetime-local" />
        <button onclick="getData()">查询</button>   
     </div>
  </div>
<?php $current_page = 'nav-menus';?>
<?php include 'inc/sidebar.php'; ?>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script src="http://echarts.baidu.com/gallery/vendors/echarts/echarts-all-3.js"></script>
  <script>  
      var myChart = echarts.init(document.getElementById('myChart'));
     function getStorage(times,datas){
        option = {
            xAxis: {
                type: 'category',
                data: times
            },
            yAxis: {
                type: 'value'
            },
            series: [{
                data:datas,
                type: 'line',
                symbol: 'triangle',
                symbolSize: 20,
                lineStyle: {
                    normal: {
                        color: 'green',
                        width: 4,
                        type: 'dashed'
                    }
                },
                itemStyle: {
                    normal: {
                        borderWidth: 3,
                        borderColor: 'yellow',
                        color: 'blue'
                    }
                }
            }]
        };
    myChart.setOption(option);
  } 
  function getData(){
           var times = [];
           var datas = [];
        $.ajax({
        url:"http://192.168.25.120:5000/InstanceRamMonitor/",
        async:false,
        dataType: "json",
        success:function(res){
            var data = res.slice(0,5);
              // console.log(data);
              for(var i = 0;i<data.length;i++){
                // console.log(data[i]);
                for(var j=0;j<data[i].length;j++){
                    var time =data[i][0];
                    var obj = time.slice(11,16);
                    var number =parseInt(data[i][1]);
                    var obj1 =  Math.floor(number)
                 } 
                    times.push(obj);
                    datas.push(obj1);
          }
          getStorage(times,datas);
        },
      error:function(error){
        console.log(error);
       }
    }); 
  }
  setInterval(function(){
    getData();
  },60)  

</script>
</body>
</html>
