<!DOCTYPE html>
<html lang="zh-cmn-Hans" prefix="og: http://ogp.me/ns#" class="han-init">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?=$siteInfo[0]['sitename']; ?></title>
    <link rel="stylesheet" href="public/css/primer.css">
    <link rel="stylesheet" href="public/css/user-content.min.css">
    <link rel="stylesheet" href="public/css/octicons.css">
    <link rel="stylesheet" href="public/css/collection.css">
    <link rel="stylesheet" href="public/css/repo-card.css">
    <link rel="stylesheet" href="public/css/repo-list.css">
    <link rel="stylesheet" href="public/css/mini-repo-list.css">
    <link rel="stylesheet" href="public/css/boxed-group.css">
    <link rel="stylesheet" href="public/css/common.css">
    <link rel="stylesheet" href="public/css/share.min.css">
    <link rel="stylesheet" href="public/css/responsive.css">
    <link rel="stylesheet" href="public/css/index.css">
    <link rel="stylesheet" href="public/css/prism.css">
</head>
<body class="home" >
    <header class="site-header" style="background:url(public/images/123.jpg) repeat-x 0px -810px">
        <div class="container">
            <h1><a href="javascript:;"></a></h1>
            <nav class="site-header-nav" role="navigation">
                <?php if (empty($_SESSION['name'])): ?>
					<a href="index.php?c=user&a=login" style="color:yellow;">登录</a>
					|
					<a href="index.php?c=user&a=register" style="color:yellow;">注册</a>
				<?php else: ?>
                    <a href="" style="color:yellow;"><?=$_SESSION['name']; ?></a>
                    |
					
                    <?php if (!empty($_SESSION['type'])): ?>
                        <a href="index.php?c=artical&a=send" style="color:yellow;">发表博文</a>
                        |
    					<a href="index.php?m=admin&c=admin&a=index" style="color:yellow;">后台管理</a>
    					|                        
                    <?php endif; ?>
					<a href="index.php?c=user&a=logout" style="color:yellow;">退出</a>
				<?php endif; ?>
                
            </nav>
        </div>
    </header>
    <!-- / header -->
    <section class="banner" style="background:url(public/images/123.jpg) repeat-x 0px -860px">
    <div class="collection-head">
        <div class="container">
            <div class="collection-title">
                <h1 class="collection-header" style="font-family:AR BONNIE;">Nice To Meet You</h1>
                <div class="collection-info">
                    <span class="meta-info" id="text1"> 
                        <span class="octicon octicon-location" > </span>
                        <a href="http://map.baidu.com/"  target="_blank">
                        </a>
                    </span>
                    <span class="tooltipped tooltipped-s tooltipped-multiline meta-info" aria-label="PHP, JavaScript, HTML+CSS, C/C++">
                        <span class="octicon octicon-code"></span>
                        后端研发
                    </span>
                    <span class="meta-info">
                        <span class="octicon octicon-organization" > </span>
                        <a href="index.php?c=abouts&a=abouts">个人资料</a>
                    </span>
                    <span class="meta-info last-updated">
                        <span class="octicon octicon-mark-github"></span>
                        <a href="http://www.xiexiaoliang.top/mybbs">我的论坛</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.banner -->
<section class="container content">
    <div class="columns">
        <div class="column two-thirds">
            <ol class="repo-list">
                <?php foreach ($re as $value): ?>
                    <?php if ($value['istop'] == 1): ?>
                        <li class="repo-list-item">
                            <h5 class="repo-list-name">
                                <a href="javascript:;"></a>置顶文章
                            </h5>
                            <p class="repo-list-description">
                               <a href="index.php?c=detail&a=detail&id=<?=$value['id']; ?>">
                                <?=$value['title']; ?>
                               </a>
                            </p>
                            <p class="repo-list-meta">
                                <span class="octicon octicon-calendar"></span><?=$value['postname']; ?> 发表于 <?=$value['posttime']; ?>
                            </p>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
                <li class="repo-list-item">
                    <h3 class="repo-list-name">
                        <a href="javascript:;"></a>最新文章
                    </h3>
                    <!-- <p class="repo-list-description">
                        文章总数：
                    </p> -->
                    
                    <p class="repo-list-meta">
                        <!-- <span class="octicon octicon-calendar"></span> --> 文章总数：<?=$articalNumber; ?>
                    </p> 
                </li>
                <?php foreach ($result as $value): ?>
                    <?php if (!empty($value['tid'])): ?>
                            <li class="repo-list-item">
                                <h6 class="repo-list-name">
                                    <a href="javascript:;"></a><?=$value['category']; ?>
                                </h6>
                                <p class="repo-list-description">
                                   <a href="index.php?c=detail&a=detail&id=<?=$value['id']; ?>">
                                    <?=$value['title']; ?>
                                   </a>
                                </p>
                                <p class="repo-list-meta">
                                    <span class="octicon octicon-calendar"></span><?=$value['postname']; ?> 发表于 <?=$value['posttime']; ?>
                                </p>
                            </li>
                        <?php endif; ?>
                <?php endforeach; ?>
            </ol>
        </div>
        <div class="column one-third"><iframe width="420" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=1"></iframe>
            <h3><a href="index.php">首页</a></h3>
            <div class="boxed-group flush" role="navigation">
                <h3>标签分类</h3>
                <ul class="boxed-group-inner mini-repo-list">
                    <?php foreach ($res as $value): ?>
                        <?php if (($value['cid'] !=0)): ?>
                            <li class="public source ">
                                <a href="index.php?c=index&a=index&b=<?=$value['cid']; ?>" title="overtrue/wechat" class="mini-repo-list-item css-truncate">
                                    <span class="repo-icon octicon octicon-repo"></span>
                                    <span class="repo-and-owner css-truncate-target">
                                        <?=$value['category']; ?>
                                    </span>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>
    </div>
    <div class="pagination text-align">
      <div class="btn-group">
        
           <!--  <button disabled="disabled" href="javascript:;" class="btn btn-outline">«</button> -->
        
        
            <!-- <a href="javascript:;" class="active btn btn-outline">首页</a> -->

            <a href="<?=$page['first']; ?>" class="btn btn-outline">首页</a>
        
          
              <a href="<?=$page['prev']; ?>" class="btn btn-outline">上一页</a>
          
        
          
              <a href="<?=$page['next']; ?>" class="btn btn-outline">下一页</a>
          
        
        
            <a href="<?=$page['end']; ?>" class="btn btn-outline">尾页</a>
        
        </div>
    </div>
    <!-- /pagination -->
</section>
<!-- /section.content -->
    <footer class="container">
        <div class="site-footer" role="contentinfo">
            <div class="copyright left mobile-block">
                    
                    <span title="overtrue.me"><?=$siteInfo[0]['icp']; ?></span>
                    <a href="javascript:;"></a>
            </div>

            <ul class="site-footer-links right mobile-hidden">
                <li>
                    <a href="javascript:;"></a>
                </li>
            </ul>
            <a href="javascript:;" target="_blank" aria-label="view source code">
                <span class="mega-octicon octicon-mark-github" title="GitHub"></span>
            </a>
            <ul class="site-footer-links mobile-hidden">
                
                <li>
                    Power by <a href="<?=$siteInfo[0]['weburl']; ?>"><?=$siteInfo[0]['webname']; ?></a>
                </li>
                
                <li>
                    <a href="javascript:;"></a>Time Now Is :<?php echo date('Y-m-d H:i:s') ?>
                </li>
                
                <li>
                    <a href="javascript:;"></a>
                </li>
                
                <li>
                    <a href="javascript:;"></a>
                </li>
                
                <li>
                    <a href="javascript:;"></a>
                </li>
                
                <li>
                    <a href="javascript:;"></a>
                </li>
                
            </ul>

        </div>
    </footer>
    <!-- / footer -->




</body>
   <script type="text/javascript" src="public/js/jquery-1.10.2.js"></script>>
   <script type="text/javascript" src="http://api.map.baidu.com/api?v=1.3"></script>
    <script type="text/javascript" src="http://developer.baidu.com/map/jsdemo/demo/convertor.js"></script>
    <script type="text/javascript">
        var map;
        var gpsPoint;
        var baiduPoint;
        var gpsAddress;
        var baiduAddress;

        function getLocation() {
            //根据IP获取城市
            var myCity = new BMap.LocalCity();
            myCity.get(getCityByIP);

            //获取GPS坐标
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showMap, handleError, { enableHighAccuracy: true, maximumAge: 1000 });
            } else {
                alert("您的浏览器不支持使用HTML 5来获取地理位置服务");
            }
        }
      
        function showMap(value) {
            var longitude = value.coords.longitude;
            var latitude = value.coords.latitude;
            map = new BMap.Map("map");
            //alert("坐标经度为：" + latitude + "， 纬度为：" + longitude );
            gpsPoint = new BMap.Point(longitude, latitude);    // 创建点坐标
            map.centerAndZoom(gpsPoint, 15);

            //根据坐标逆解析地址
            var geoc = new BMap.Geocoder();
            geoc.getLocation(gpsPoint, getCityByCoordinate);

            BMap.Convertor.translate(gpsPoint, 0, translateCallback);
        }

        translateCallback = function (point) {
            baiduPoint = point;
            var geoc = new BMap.Geocoder();
            geoc.getLocation(baiduPoint, getCityByBaiduCoordinate);
        }

        function getCityByCoordinate(rs) {
            gpsAddress = rs.addressComponents;
            var address = "GPS标注：" + gpsAddress.province + "," + gpsAddress.city + "," + gpsAddress.district + "," + gpsAddress.street + "," + gpsAddress.streetNumber;
            var marker = new BMap.Marker(gpsPoint);  // 创建标注
            map.addOverlay(marker);              // 将标注添加到地图中
            var labelgps = new BMap.Label(address, { offset: new BMap.Size(20, -10) });
            marker.setLabel(labelgps); //添加GPS标注    
        }

        function getCityByBaiduCoordinate(rs) {
            baiduAddress = rs.addressComponents;
            var address = "百度标注：" + baiduAddress.province + "," + baiduAddress.city + "," + baiduAddress.district + "," + baiduAddress.street + "," + baiduAddress.streetNumber;
            var marker = new BMap.Marker(baiduPoint);  // 创建标注
            map.addOverlay(marker);              // 将标注添加到地图中
            var labelbaidu = new BMap.Label(address, { offset: new BMap.Size(20, -10) });
            marker.setLabel(labelbaidu); //添加百度标注  
        }

        //根据IP获取城市
        function getCityByIP(rs) {
            var cityName = rs.name;
           // alert("根据IP定位您所在的城市为:" + cityName);
            　//document.getElementById("text1").value = cityName;
            $("#text1 a").html(cityName); 
        }

        /*function handleError(value) {
            switch (value.code) {
                case 1:
                    alert("位置服务被拒绝");
                    break;
                case 2:
                    alert("暂时获取不到位置信息");
                    break;
                case 3:
                    alert("获取信息超时");
                    break;
                case 4:
                    alert("未知错误");
                    break;
            }
        }*/

        function init() {
            getLocation();
        }

        window.onload = init;

    </script>
</html>