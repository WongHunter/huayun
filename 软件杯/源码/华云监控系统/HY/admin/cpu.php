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
     <div class="show-table">
      <div id="main" style="width: 600px;height:400px;"></div>
      <div id="myChart" style="width: 600px;height:400px;"></div>
    </div>
    <hr>
    <div class="btn-group">
      <button type="button" class="btn btn-primary" id = "sixHour" onclick="getData()">6小时</button>
      <button type="button" class="btn btn-default" id = "oneDay" onclick="getData()">1天</button>
      <button type="button" class="btn btn-default" id = "sevenDay"  onclick="getData()">7天</button>
      <button type="button" class="btn btn-default" id = "thirtyDay" onclick="getData()">30天</button>
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
      function getCpu(times,datas){
          var myChart = echarts.init(document.getElementById('myChart'));
            var Option = {
                title: {
                  text: "CPU利用率",
                // subtext: "统计周期:一分钟",
              },
                tooltip: {},
                xAxis: {
                  data:times
                },
                yAxis: {
                  // data:[0,50,100]
                },
              series: [
                {
                  data:datas,
                  type:"line",
                  smooth: true
                }]
            };
            myChart.setOption(Option);
      }
     function getData(){
           var times = [];
           var datas = [];
        $.ajax({
        url:"http://192.168.25.120:5000/InstanceCpuMonitor",
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
          getCpu(times,datas);
          getbBpis(times,datas);
        },
      error:function(error){
        console.log(error);
       }
    }); 
  }
  setInterval(function(){
    getData();
  },60)
  function getbBpis(times,datas){
    var main = echarts.init(document.getElementById("main"));
        option = {
           title: {
            text: 'CPU使用率',
            subtext: '统计周期 :5分钟'
         },
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c}%"
          },
        legend: {
            data: ['100%','80%','60%','40%','20%']
         },
        toolbox: {
            feature: {
                dataView: {readOnly: false},
                restore: {},
                saveAsImage: {}
            }
        },
        calculable: true,
        color: ['#2ed1a1', '#2ed1a1', '#ddeda1', '#2ed1a1', '#2ed1a1', ],
        series: [
            {
                name:'CPU使用率',
                type:'funnel',
                left: '10%',
                top: 60,
                //x2: 80,
                bottom: 60,
                width: '80%',
                // height: {totalHeight} - y - y2,
                min: 0,
                max: 100,
                minSize: '0%',
                maxSize: '100%',
                sort: 'descending',
                gap: 2,
                label: {
                    show: true,
                    position: 'inside'
                },
                labelLine: {
                    length: 10,
                    lineStyle: {
                        width: 1,
                        type: 'solid'
                    }
                },
                itemStyle: {
                    borderColor: '#fff',
                    borderWidth: 1
                },
                emphasis: {
                    label: {
                        fontSize: 20
                    }
                },
                data: [
                    {value: 60, name: '60%'},
                    {value: 40, name: '40%'},
                    {value: datas[0], name: '20%'},
                    {value: 80, name: '80%'},
                    {value: 100,name: '100%'}
                ]
            }
        ]
    };
 // 使用刚指定的配置项和数据显示图表。
    main.setOption(option);
  }
   

    // function getData() {
    //     var start = $('#start').val();
    //     var end = $('#end').val();
    //     //异步请求
    //     $.post(
    //         "http://192.168.25.120:5000/InstanceCpuMonitor",//访问地址
    //         {start:start, end: end},//携带的参数
    //         function (data) {
    //             generateChart(data);
    //         },
    //         "json"
    //     );
    // }
  </script>
</body>
</html>
