
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <link rel="stylesheet" href="../assets/css/cloud.css">
  <script src="../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
  <?php include 'inc/navbar.php';?>
  <div>

<!-- Nav tabs -->
<ul class="nav nav-pills" role="tablist">
  <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">云主机</a></li>
  <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">镜像</a></li>
  <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">SSH密钥</a></li>
  <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">云硬盘</a></li>
  <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">快照</a></li>
  <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">防火墙</a></li>
  <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">公网IP</a></li>

</ul>
<hr>

<!-- Tab panes -->
<div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="home">
    <div class="place-btn">
      <button type="button" class="btn btn-default">苏州(1)</button>
      <button type="button" class="btn btn-primary">淮安(1)</button>
      <button type="button" class="btn btn-default">北京(1)</button>
      <button type="button" class="btn btn-default">广州(1)</button>
      <button type="button" class="btn btn-default">成都(1)</button>
      <button type="button" class="btn btn-default">厦门(1)</button>
    </div>
     <hr>
    <div class="page-title">
        <h3>云主机</h3>
      </div>
      <hr>
    <div class="btn-group">
      <button type="button" class="btn btn-primary">新建</button>
      <button type="button" class="btn btn-default">开机</button>
      <button type="button" class="btn btn-default">关机</button>
      <button type="button" class="btn btn-default">重启</button>
      <button type="button" class="btn btn-default">续费</button>
      <button type="button" class="btn btn-default">重置密码</button>
      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        更多操作
        <span class="caret"></span>
      </button>
      <!-- <ul class="dropdown-menu dropdown-menu-left">
        <li>
          <a href="#">删除</a>
        </li>
        <li>
          <a href="#">业务组</a>
        </li>
      </ul> -->
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for...">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">
            <span class="fa fa-arrow-circle-right"></span>
          </button>
        </span>
      </div>
      <hr>
    </div>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>云主机名称</th>
            <th>IP地址</th>
            <th>主机系列</th>
            <th>配置</th>
            <th>运行状态</th>
            <th>付费方式</th>
            <th>产品状态</th>
            <th>到期时间</th>
            <th>操作</th>
          </tr>
        </thead>
         <tbody class="cloud-msg">
        </tbody>
      </table>
    </div>
  
  </div>
  <div role="tabpanel" class="tab-pane" id="profile">
  <div class="place-btn" role="group" aria-label="...">
      <button type="button" class="btn btn-default">苏州(0)</button>
      <button type="button" class="btn btn-default">淮安(0)</button>
      <button type="button" class="btn btn-default">北京(0)</button>
      <button type="button" class="btn btn-default">广州(0)</button>
      <button type="button" class="btn btn-default">成都(0)</button>
      <button type="button" class="btn btn-default">厦门(0)</button>
    </div>
    <hr>
    <div class="page-title">
      <h3>镜像</h3>
    </div>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>名称</th>
            <th>状态</th>
            <th>云硬盘名称</th>
            <th>云硬盘状态</th>
            <th>主机类型</th>
            <th>锁定类型</th>
            <th>备注</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Lorem</td>
            <td>ipsum</td>
            <td>dolor</td>
            <td>sit</td>
            <td>1,001</td>
            <td>Lorem</td>
            <td>ipsum</td>
            <td>dolor</td>
            <td>sit</td>
          </tr>
          <tr>
            <td>Lorem</td>
            <td>ipsum</td>
            <td>dolor</td>
            <td>sit</td>
            <td>1,001</td>
            <td>Lorem</td>
            <td>ipsum</td>
            <td>dolor</td>
            <td>sit</td>
          </tr>
          <tr>
            <td>Lorem</td>
            <td>ipsum</td>
            <td>dolor</td>
            <td>sit</td>
            <td>1,001</td>
            <td>Lorem</td>
            <td>ipsum</td>
            <td>dolor</td>
            <td>sit</td>
          </tr>
          <tr>
            <td>Lorem</td>
            <td>ipsum</td>
            <td>dolor</td>
            <td>sit</td>
            <td>1,001</td>
            <td>Lorem</td>
            <td>ipsum</td>
            <td>dolor</td>
            <td>sit</td>
          </tr>
          <tr>
            <td>Lorem</td>
            <td>ipsum</td>
            <td>dolor</td>
            <td>sit</td>
            <td>1,001</td>
            <td>Lorem</td>
            <td>ipsum</td>
            <td>dolor</td>
            <td>sit</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div role="tabpanel" class="tab-pane" id="messages">
  <div class="place-btn" role="group" aria-label="...">
      <button type="button" class="btn btn-default">苏州(0)</button>
      <button type="button" class="btn btn-default">淮安(0)</button>
      <button type="button" class="btn btn-default">北京(0)</button>
      <button type="button" class="btn btn-default">广州(0)</button>
      <button type="button" class="btn btn-default">成都(0)</button>
      <button type="button" class="btn btn-default">厦门(0)</button>
    </div>
    <hr>
    <div class="page-title">
      <h3>SSH密钥</h3>
    </div>

    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>名称</th>
            <th>创建时间"</th>
            <th>描述</th>

            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1,001</td>
            <td>Lorem</td>
            <td>ipsum</td>
            <td>dolor</td>
            <td>dolor</td>
          </tr>
          <tr>
            <td>1,001</td>
            <td>Lorem</td>
            <td>ipsum</td>
            <td>dolor</td>
            <td>dolor</td>
          </tr>
          <tr>
            <td>1,001</td>
            <td>Lorem</td>
            <td>ipsum</td>
            <td>dolor</td>
            <td>dolor</td>
          </tr>
          <tr>
            <td>1,001</td>
            <td>Lorem</td>
            <td>ipsum</td>
            <td>dolor</td>
            <td>dolor</td>
          </tr>
          <tr>
            <td>1,001</td>
            <td>Lorem</td>
            <td>ipsum</td>
            <td>dolor</td>
            <td>dolor</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div role="tabpanel" class="tab-pane" id="settings">
  <div class="place-btn" role="group" aria-label="...">
      <button type="button" class="btn btn-default">苏州(0)</button>
      <button type="button" class="btn btn-default">淮安(0)</button>
      <button type="button" class="btn btn-default">北京(0)</button>
      <button type="button" class="btn btn-default">广州(0)</button>
      <button type="button" class="btn btn-default">成都(0)</button>
      <button type="button" class="btn btn-default">厦门(0)</button>
    </div>
    <hr>
    <div class="page-title">
      <h3>云硬盘</h3>
    </div>

    <div class="btn-group" role="group" aria-label="...">
      <button type="button" class="btn btn-primary">型号</button>
      <button type="button" class="btn btn-default">容量</button>
      <button type="button" class="btn btn-default">所属主机</button>
      <button type="button" class="btn btn-default">使用状态</button>
      <button type="button" class="btn btn-default">付费方式</button>
      <button type="button" class="btn btn-default">产品状态</button>
      <button type="button" class="btn btn-default">到期时间</button>
      <button type="button" class="btn btn-default">操作</button>
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for...">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>云主机名称</th>
            <th>所属监听器</th>
            <th>优先级</th>
            <th>优先级</th>
            <th>主机类型</th>
            <th>匹配方式</th>
            <th>转发条件"</th>
            <th>创建时间</th>
            <th>操作"</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
  <div role="tabpanel" class="tab-pane active" id="home">

  </div>
  <div role="tabpanel" class="tab-pane" id="profile">

  </div>
  <div role="tabpanel" class="tab-pane" id="messages">

  </div>
  <div role="tabpanel" class="tab-pane" id="settings">
    
  </div>
</div>

</div>
  </div>
    <?php $current_page = 'categories' ?>
    <?php include 'inc/sidebar.php'; ?>
  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="https://unpkg.com/art-template@4.13.2/lib/template-web.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>

  <script>NProgress.done()</script>
  <script id = "cloudMsg_tml" type= "text/template">

   
        <tr>
            
            <td><input type="checkbox">&nbsp;{{ HostName }}</td>

            {{each Internet as v index}}
            <td>{{v. IpAddress}}</td>
            {{/each}}
            <td>{{ SeriesName }}</td>
            <td>{{ ProductType }}</td>
            <td>{{ Status }}</td>
            <td>{{ PayType }}</td>
            <td>{{ ProductStatus }}</td>
            <td>{{ CloseTime }}</td>
            <td><a herf = "#">配置变更</a></td>
        </tr>
  </script>
  <script >
    function getMessage(){
      $.ajax({
         url:"http://192.168.25.120:5000/DescribeInstance/",
           async:false,
           dataType: "json",
           success:function(res){
             console.log(res[0]);
            //  var html = $('cloudMsg_tml').render({cloudMsg:res});
            var cloud = template("cloudMsg_tml",res[0])
               console.log(cloud);
               $(".cloud-msg").html(cloud);
           }
        });
    }
   getMessage();

   
   function putMessage(){
    $.ajax({
         url:"192.168.25.120:5000/Stop_Instance/",
         type: 'post',
           async:false,
           data: {id:i-q66rj5bmd648j},
           dataType: "json",
           success: function (data) {
              console.log(data)
              },
              error: function (err) {
              console.log(err)
              },
              complete: function () {
              console.log('request completed')
              }
        });
   }
   putMessage()
  </script>
</body>
</html>
