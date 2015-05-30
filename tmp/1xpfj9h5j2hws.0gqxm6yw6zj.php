<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>编辑学校详情</title>

    <!-- Bootstrap -->
    <link href="app/assets/css/bootstrap.css" rel="stylesheet">
    <link href="app/assets/css/app.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <nav class="navbar navbar-default navbar-fixed-top zcheader">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <img src="images/index-logo.png">
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          
          <ul class="nav navbar-nav navbar-right">
            <li><a href="" class="user-name">某某管理员</a></li>
            <li><span>|</span></li>
            <li><a href="#" class="logout-label">退出</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <section id="content" class="container-fluid">
      <div class="row">
        <div class="col-sm-4 col-md-3 sidebar">
          <ul class="nav nav-sidebar">
            <li class="index-item"><a href="brief-introduce.html">首页</a></li>
            <li class="publicity-item">
              <a href="#" class="menu-head  current-item">招生宣传</a>
              <ul class="sub-item" style="display: block">
                <li><a href="matriculate-number.html">各中学录取人数统计</a></li>
                <li><a href="matriculate-student.html">各中学录取学生情况查看</a></li>
                <li><a href="admissions-news.html">各中学学生喜报</a></li>
                <li><a href="student-direction.html">各中学学生毕业去向表</a></li>
                <li><a href="province-base.html">各省录取基本信息统计表</a></li>
                <li><a href="province-admit.html">各省录取位次统计表</a></li>
                <li><a href="#" class="selected-item">各省中学分布情况及基本情况</a></li>
              </ul>
            </li>
            <li class="evaluate-item">
              <a href="#" class="menu-head">生源质量评价</a>
              <ul class="sub-item" style="display: none;">
                <li><a href="">各中学录取人数统计</a></li>
                <li><a href="">各中学录取学生情况查看</a></li>
                <li><a href="">各中学学生喜报</a></li>
                <li><a href="">各中学学生就业去向表</a></li>
                <li><a href="">各省录取基本信息统计表</a></li>
                <li><a href="">各省录取位次统计表</a></li>
                <li><a href="">各省中学分布情况及基本情况</a></li>
              </ul>
            </li>
            <li class="analysis-item">
              <a href="#" class="menu-head">专业热度分析</a>
              <ul class="sub-item" style="display: none;">
                <li><a href="">各中学录取人数统计</a></li>
                <li><a href="">各中学录取学生情况查看</a></li>
                <li><a href="">各中学学生喜报</a></li>
                <li><a href="">各中学学生就业去向表</a></li>
                <li><a href="">各省录取基本信息统计表</a></li>
                <li><a href="">各省录取位次统计表</a></li>
                <li><a href="">各省中学分布情况及基本情况</a></li>
              </ul>
            </li>
            <li class="prediction-item">
              <a href="#" class="menu-head">生源预测</a>
              <ul class="sub-item" style="display: none;">
                <li><a href="">各中学录取人数统计</a></li>
                <li><a href="">各中学录取学生情况查看</a></li>
                <li><a href="">各中学学生喜报</a></li>
                <li><a href="">各中学学生就业去向表</a></li>
                <li><a href="">各省录取基本信息统计表</a></li>
                <li><a href="">各省录取位次统计表</a></li>
                <li><a href="">各省中学分布情况及基本情况</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="col-sm-8 col-sm-offset-4 col-md-9 col-md-offset-3" id="main">
          <div class="url-position">我的位置>招生宣传>各省中学分布情况及基本情况</div>
          <div id="table-cont">
            <form action="saveEditMiddleWor" id="school-form" method="post">
              
              <div class="form-group">
                <label for="headOffice"><?php echo $position; ?></label>
                <input type="text" class="form-control" id="headOffice" name="tel" placeholder="<?php echo $tel; ?>">
              </div>
             
              <input type="hidden" name="middlecode" value="<?php echo $code; ?>">
              <div class="submit-btn">
                <button type="submit" class="btn btn-primary">修改</button>
              </div>
            </form>
          </div>
        <footer class="copy-right">
          <p>西北工业大学本科招生办公室 版权所有</p>
          <p>Copyright © 2014-2015 zsb.nwpu.edu.cn All Rights Reserved</p>
        </footer> 
        </div>
      </div>
      <!-- <div class="row">
        heloooooo
      </div> -->
    </section>

   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="app/assets/javascripts/jquery-1.11.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="app/assets/javascripts/bootstrap.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {

        $('.sidebar .sub-item:eq(0)').show();
        $('.sidebar a.menu-head').click(function(event) {
          
          $(this).addClass('current-item').next('ul.sub-item').slideToggle("slow").next('ul.sub-item').slideUp("slow");
          $('.sidebar a.menu-head').not(this).removeClass('current-item');

          $('.sidebar a.menu-head').not(this).next().css('display', 'none');
          // $(this).siblings().remove('current-item');
        });  
      });

       $('#school-form').submit(function (event) {
        
        // alert('hell');
        event.preventDefault();
        var url = $(this).attr('action');
        var postdata = $(this).serialize();
        // alert(postdata);
        var request = $.post(
                url,
                postdata,
                formpostcompleted,
                "text"
        );
        function formpostcompleted(data, status) {
            // console.log(data);
            alert(data);
        }
    });
    </script>
  </body>
</html>