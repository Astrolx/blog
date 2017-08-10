<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>博客后台管理</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Binary admin</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">  &nbsp; <a href="index.php" class="btn btn-danger square-btn-adjust">返回首页</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
                    </li>
                
                    
                    <li>
                        <a   href="index.php?m=admin&c=admin&a=index"><i class="fa fa-dashboard fa-3x"></i> 站点信息</a>
                    </li>
                     <li>
                        <a  href="index.php?m=admin&c=ui&a=ui"><i class="fa fa-desktop fa-3x"></i> 用户管理</a>
                    </li>
                    <li>
                        <a  href="index.php?m=admin&c=category&a=category"><i class="fa fa-qrcode fa-3x"></i> 版块管理</a>
                    </li>
                          <!--  <li  >
                                                  <a   href="chart.html"><i class="fa fa-bar-chart-o fa-3x"></i> Morris Charts</a>
                                              </li>    -->
                      <li  >
                        <a class="active-menu" href="index.php?m=admin&c=blogs&a=blogs"><i class="fa fa-table fa-3x"></i> 博文管理</a>
                    </li>
                     <li  >
                        <a  href="index.php?m=admin&c=comment&a=comment"><i class="fa fa-edit fa-3x"></i> 评论管理</a>
                    </li> 
                    <li  >
                                            <a   href="index.php?m=admin&c=about&a=about"><i class="fa fa-bolt fa-3x"></i> &nbsp;&nbsp;个人信息</a>
                                        </li>               
                     <!-- <li  >
                        <a   href="login.html"><i class="fa fa-bolt fa-3x"></i> Login</a>
                                         </li>   
                     <li  >
                        <a   href="registeration.html"><i class="fa fa-laptop fa-3x"></i> Registeration</a>
                                         </li>   
                                       
                                         <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                     
                                </ul>
                               
                            </li> -->
                        </ul>
                      </li>  
                 <!--  <li  >
                        <a  href="blank.html"><i class="fa fa-square-o fa-3x"></i> Blank Page</a>
                    </li>   --> 
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">

<html>
    <head>
        <meta charset='utf-8'>
        <link rel="stylesheet" href="public/editor/css/editormd.css" />
        <script src="public/editor/js/jquery.min.js"></script>
        <script src="public/editor/editormd.min.js"></script>
        <script type="text/javascript">
            $(function() {
                testEditor = editormd("test-editormd", {
                        width   : "85%",
                        height  : 600,
                        syncScrolling : "single",
                        path    : "public/editor/lib/"
                    });

            });
        </script>
    </head>
    <body >
        <form action="index.php?m=admin&c=blogs&a=blogs&bid=<?=$articalInfo['id']; ?>" method='post'>
            <div style="margin-left:500px;color:red;">标题：<input type='text' name='title' value="<?=$articalInfo['title']; ?>"> &nbsp;&nbsp;&nbsp;
               <!--  <a href="index.php" style="text-decoration: none;">返回首页</a> -->
            </div>
            
                <div class="editormd" id="test-editormd" >
                    <textarea style="display:none;" name="content"><?=$articalInfo['content']; ?></textarea>
                </div>
            
            <div style="margin-left:840px;">
                版块选择：<select name="choice">
                            <?php foreach ($category as $value): ?>
                                <option value="<?=$value['category']; ?>"><?=$value['category']; ?></option>                            
                           <?php endforeach; ?>
                        </select>
                <input type="submit" value="提交">
            </div>
        </form>
    </body>
</html>
                    </div>
                </div>  
            </div>
        </div>            
                 
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
