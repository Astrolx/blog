<!DOCTYPE html>
<html lang="zh-cmn-Hans" prefix="og: http://ogp.me/ns#" class="han-init">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>博客-关于我们</title>
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
<body class="">
    <header class="site-header">
        <div class="container">
            <h1><a href="javascript:;"></a></h1>
            <nav class="site-header-nav" role="navigation">
                
                <a href="index.php">首页</a>
                
                <a href="javascript:;"></a>
                
                <a href="javascript:;"></a>
                
                <a href="javascript:;"></a>
                
                <a href="javascript:;"></a>
                
                <a href="javascript:;"></a>
                
            </nav>
        </div>
    </header>
    <!-- / header -->
    <div class="container">
        <div class="collection-title">
            <h1 class="collection-header">关于</h1>
            
        </div>
    </div>
</section>
<!-- / .banner -->
 <section class="container content">
        <div class="columns">
            <div class="column three-fourths">
                <article class="article-content markdown-body">
                    
<h1 id="section"><?=$about[0]['name']; ?></h1>
<p><?=$about[0]['sex']; ?> <?=$about[0]['age']; ?></p>

<h2 id="section-1">概况</h2>

<ul>
  <li>邮箱：<?=$about[0]['email']; ?></li>
  <!-- <li>主页：<a href="javascript:;"></a></li> -->
  <li>微博：<?=$about[0]['microBlog']; ?><a href="javascript:;"></a></li>
</ul>

<p><?=$about[0]['detail']; ?></p>

<h2 id="section-2">教育</h2>
<ul>
  <li><?=$about[0]['education']; ?></li>
</ul>

<h2 id="keywords">keywords</h2> 
<div class="btn-inline">
<!-- <?php foreach ($keyword as $value): ?>
    <button class="btn btn-outline" type="button"><a href="index.php?c=index&a=index&b=<?=$value['cid']; ?>"><?=$value['category']; ?></a></button> 
<?php endforeach; ?> -->
<?php foreach ($keyword as $value): ?>
    <a class="btn btn-outline" href="index.php?c=index&a=index&b=<?=$value['cid']; ?>"><?=$value['category']; ?></a>
<?php endforeach; ?>
  <!-- <button class="btn btn-outline" type="button">Javascript</button>  <button class="btn btn-outline" type="button">HTML+CSS</button>  <button class="btn btn-outline" type="button">Swift</button>  <button class="btn btn-outline" type="button">Linux</button>  <button class="btn btn-outline" type="button">Laravel</button>  <button class="btn btn-outline" type="button">Git</button>  <button class="btn btn-outline" type="button">Mac</button>  <button class="btn btn-outline" type="button">RESTful</button>  <button class="btn btn-outline" type="button">Stackoverflow</button>  <button class="btn btn-outline" type="button">Sublime Text</button>  <button class="btn btn-outline" type="button">OmniGaffale</button>  <button class="btn btn-outline" type="button">OmniPlan</button>  -->

</div>

<h3 id="section-3">综合技能</h3>

<table>
  <thead>
    <tr>
      <th style="text-align: right">名称</th>
      <th style="text-align: left">熟悉程度</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($detail as $value): ?>
        <tr>
          <td style="text-align: right"><?=$value['keywords']; ?></td>
          <td style="text-align: left"><?=$value['grade']; ?></td>
        </tr>
    <?php endforeach; ?>
   <!--  <tr>
     <td style="text-align: right">javascript</td>
     <td style="text-align: left">★★★★☆</td>
   </tr>
   <tr>
     <td style="text-align: right">Linux</td>
     <td style="text-align: left">★★★★☆</td>
   </tr>
   <tr>
     <td style="text-align: right">Swift</td>
     <td style="text-align: left">★★★☆☆</td>
   </tr>
   <tr>
     <td style="text-align: right">Nodejs</td>
     <td style="text-align: left">★★★★☆</td>
   </tr>
   <tr>
     <td style="text-align: right">Markdown</td>
     <td style="text-align: left">★★★★★</td>
   </tr>
   <tr>
     <td style="text-align: right">C</td>
     <td style="text-align: left">★★☆☆☆</td>
   </tr>
   <tr>
     <td style="text-align: right">Photoshop</td>
     <td style="text-align: left">★★★★☆</td>
   </tr> -->
  </tbody>
</table>

                </article>
                <div class="share">
                    <div class="share-component"><a href="javascript:;"></a><a href="javascript:;"></a><a href="javascript:;"></a><a href="javascript:;"></a><a href="javascript:;"></a><a href="javascript:;"></a><a href="javascript:;"></a><a href="javascript:;"></a><a href="javascript:;"></a><a href="javascript:;"></a><a href="javascript:;"></a></div>
                </div>
                <div class="comment">
                    <div class="comments">
    <div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'overtrueme'; // required: replace example with your forum shortname
        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the &lt;a href="http://disqus.com/?ref_noscript"&gt;comments powered by Disqus.&lt;/a&gt;</noscript>
</div>

                </div>
            </div>
            <div class="column one-fourth">
                
<!-- <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> -->
<!-- overtrue.me-sidebar1 -->
<!-- <ins class="adsbygoogle"
     style="display:inline-block;width:250px;height:250px"
     data-ad-client="ca-pub-2163469583563094"
     data-ad-slot="6214833545"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script> -->
                <!-- <h3><a href="index.php">首页</a></h3> -->

<!-- 
                <div class="boxed-group flush" role="navigation">
    <h3>Repositories contribute to</h3>
    <ul class="boxed-group-inner mini-repo-list">
        
        <li class="public source ">
            <a href="https://github.com/overtrue/wechat" target="_blank" title="overtrue/wechat" class="mini-repo-list-item css-truncate">
                <span class="repo-icon octicon octicon-repo"></span>
                <span class="repo-and-owner css-truncate-target">
                    overtrue/wechat
                </span>
            </a>
        </li>
        
        <li class="public source ">
            <a href="https://github.com/EasyWeChat/site" target="_blank" title="EasyWeChat/site" class="mini-repo-list-item css-truncate">
                <span class="repo-icon octicon octicon-repo"></span>
                <span class="repo-and-owner css-truncate-target">
                    EasyWeChat/site
                </span>
            </a>
        </li>
        
        <li class="public source ">
            <a href="https://github.com/laravel/framework" target="_blank" title="laravel/framework" class="mini-repo-list-item css-truncate">
                <span class="repo-icon octicon octicon-repo"></span>
                <span class="repo-and-owner css-truncate-target">
                    laravel/framework
                </span>
            </a>
        </li>
        
        <li class="public source ">
            <a href="https://github.com/caouecs/Laravel-lang" target="_blank" title="caouecs/Laravel-lang" class="mini-repo-list-item css-truncate">
                <span class="repo-icon octicon octicon-repo"></span>
                <span class="repo-and-owner css-truncate-target">
                    caouecs/Laravel-lang
                </span>
            </a>
        </li>
        
    </ul>
</div>
 -->
                <!-- <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> -->
<!-- overtrue.me-sidebar -->
<!-- <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-2163469583563094"
     data-ad-slot="1784633948"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script> -->

            </div>
        </div>
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
</body></html>