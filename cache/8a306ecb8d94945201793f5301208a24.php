<!DOCTYPE html>
<html lang="zh-cmn-Hans" prefix="og: http://ogp.me/ns#" class="han-init">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>博客-详情页</title>
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
    <link rel="stylesheet" href="public/css/iconfont.css">
    <link rel="stylesheet" href="public/css/prism.css"></script>

</head>
<body class="">
    <header class="site-header">
        <div class="container">
            <h1><a href="javascript:;"></a></h1>
            <nav class="site-header-nav" role="navigation">
                
                <a href="javascript:;"></a>
                
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
        <div class="columns">
            <div class="column three-fourths">
                <div class="collection-title">
                    <h1 class="collection-header"><?=$artical[0]['title']; ?></h1>
                    <div class="collection-info">
                        <span class="meta-info">
                            <span class="octicon octicon-calendar"></span> <?=$artical[0]['posttime']; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / .banner -->
 <section class="container content">
    <div class="columns">
        <div class="column three-fourths">
            <article class="article-content markdown-body">
                <p><a href="javascript:;"></a></p>

<div id="markdown">
  <!--【注1】在textarea里面，显示内容前面不能出现空格，否则显示样式不对-->
  <!--【注2】存放markdown格式的时候，如果有特殊字符，可以使用htmlentities和addcslashs进行转化-->
    <textarea style="display:none;" name="test-editormd-markdown-doc"><?=$artical[0]['content']; ?>
        </textarea>
  </div><blockquote>
<!--   <p>Trait 是为类似 PHP 的单继承语言而准备的一种代码复用机制。Trait 为了减少单继承语言的限制，使开发人员能够自由地在不同层次结构内独立的类中复用 method。Trait 和 Class 组合的语义定义了一种减少复杂性的方式，避免传统多继承和 Mixin 类相关典型问题。</p>

<p>Trait 和 Class 相似，但仅仅旨在用细粒度和一致的方式来组合功能。 无法通过 trait 自身来实例化。它为传统继承增加了水平特性的组合；也就是说，应用的几个 Class 之间不需要继承。</p>
</blockquote>

<h2 id="trait-">什么是 Trait ?</h2>

<p>其实说通俗一点，就是能把重复的<strong>方法</strong>拆分到一个文件，通过 <code class="highlighter-rouge">use</code>  引入以达到代码复用的目的。</p>

<p>那么，我们应该怎么样去拆分我们的代码才是合适的呢？我的看法是这样的：</p>

<p>Trait，译作 <strong>“特性”、“特征”、“特点”</strong> 。那么问题就来了：什么才是特性？</p>

<p>一个销售公司有很多种产品：电视，电脑与鼠标垫，卡通手办等。其中鼠标垫与卡通手办是非卖品，只用于赠送。</p>

<p>那么这里的 “可卖性” 就是一个特性，非卖品是没有价格的。我们便可以抽象出 “可卖性”  这个 Trait 来：</p>

<div class="language-php highlighter-rouge">
<pre class="highlight language-php"><code class=" language-php"><span class="token keyword">trait</span> <span class="token class-name">Sellable</span>
<span class="token punctuation">{</span>
  <span class="token keyword">protected</span> <span class="token variable">$price</span> <span class="token operator">=</span> <span class="token number">0</span><span class="token punctuation">;</span>

  <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">getPrice<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
  <span class="token punctuation">{</span>
      <span class="token keyword">return</span> <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">price</span><span class="token punctuation">;</span>
  <span class="token punctuation">}</span>

  <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">setPrice<span class="token punctuation">(</span></span>int <span class="token variable">$price</span><span class="token punctuation">)</span>
  <span class="token punctuation">{</span>
      <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">price</span> <span class="token operator">=</span> <span class="token variable">$price</span><span class="token punctuation">;</span>
  <span class="token punctuation">}</span>
<span class="token punctuation">}</span>
</code></pre>
</div>

<p>当然我们所有的产品都会有品牌与其它基本属性，所以我们通常会定义一个产品类：</p>

<div class="language-php highlighter-rouge">
<pre class="highlight language-php"><code class=" language-php"><span class="token keyword">class</span> <span class="token class-name">Pruduct</span>
<span class="token punctuation">{</span>
  <span class="token keyword">protected</span> <span class="token variable">$brand</span><span class="token punctuation">;</span>
 <span class="token comment" spellcheck="true"> //...
</span>
  <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">__construct<span class="token punctuation">(</span></span><span class="token variable">$brand</span><span class="token punctuation">)</span>
  <span class="token punctuation">{</span>
      <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">brand</span> <span class="token operator">=</span> <span class="token variable">$brand</span><span class="token punctuation">;</span>
  <span class="token punctuation">}</span>

  <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">getBrand<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
  <span class="token punctuation">{</span>
      <span class="token keyword">return</span> <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">brand</span><span class="token punctuation">;</span>
  <span class="token punctuation">}</span>

 <span class="token comment" spellcheck="true"> //...
</span><span class="token punctuation">}</span>
</code></pre>
</div>

<p>我们的电视与电脑类：</p>

<div class="language-php highlighter-rouge">
<pre class="highlight language-php"><code class=" language-php"><span class="token keyword">class</span> <span class="token class-name">TV</span> <span class="token keyword">extends</span> <span class="token class-name">Pruduct</span>
<span class="token punctuation">{</span>
  <span class="token keyword">use</span> <span class="token package">Sellable</span><span class="token punctuation">;</span>
 <span class="token comment" spellcheck="true"> //...
</span>
  <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">play<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
  <span class="token punctuation">{</span>
      <span class="token keyword">echo</span> <span class="token string">"一台  电视在播放中..."</span><span class="token punctuation">;</span>
  <span class="token punctuation">}</span>

 <span class="token comment" spellcheck="true"> //...
</span><span class="token punctuation">}</span>

<span class="token keyword">class</span> <span class="token class-name">Computer</span> <span class="token keyword">extends</span> <span class="token class-name">Pruduct</span>
<span class="token punctuation">{</span>
  <span class="token keyword">use</span> <span class="token package">Sellable</span><span class="token punctuation">;</span>

  <span class="token keyword">protected</span> <span class="token variable">$cores</span> <span class="token operator">=</span> <span class="token number">8</span><span class="token punctuation">;</span>
 <span class="token comment" spellcheck="true"> //...
</span>
  <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">getNumberOfCores<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
  <span class="token punctuation">{</span>
      <span class="token keyword">return</span> <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">cores</span><span class="token punctuation">;</span>
  <span class="token punctuation">}</span>

 <span class="token comment" spellcheck="true"> //...
</span><span class="token punctuation">}</span>
</code></pre>
</div>

<p>而鼠标垫与手办等礼品是不可卖的：</p>

<div class="language-php highlighter-rouge">
<pre class="highlight language-php"><code class=" language-php"><span class="token keyword">class</span> <span class="token class-name">Gift</span> <span class="token keyword">extends</span> <span class="token class-name">Pruduct</span>
<span class="token punctuation">{</span>
  <span class="token keyword">protected</span> <span class="token variable">$name</span><span class="token punctuation">;</span>

  <span class="token keyword">function</span> <span class="token function">__construct<span class="token punctuation">(</span></span><span class="token variable">$brand</span><span class="token punctuation">,</span> <span class="token variable">$name</span><span class="token punctuation">)</span>
  <span class="token punctuation">{</span>
      <span class="token scope"><span class="token keyword">parent</span><span class="token punctuation">::</span></span><span class="token function">__construct<span class="token punctuation">(</span></span><span class="token variable">$brand</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
      <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">name</span> <span class="token operator">=</span> <span class="token variable">$name</span><span class="token punctuation">;</span>
  <span class="token punctuation">}</span>

 <span class="token comment" spellcheck="true"> //...
</span><span class="token punctuation">}</span>
</code></pre>
</div>

<p>上面的这个例子中，“可卖性” 便是部分商品的一个特性，也可以理解为商品的一个归类。你也许会说，我也可以再添加一个 Goods 类来完成上面的例子啊，Goods 继承 Product，再让所有可卖的商品继承于 Goods 类，把价格属性与方法写到 Goods 里，同样可以代码复用啊。的确，这没啥问题。但是你会发现：你有多个需要区别的特性时，由于 PHP 只有单继承的原因，你不得不组合很多个基类出来，将他们层叠，最终得到的树状结构是很复杂的。这也是 Trait 所带来的优势：随意组合，代码清晰。</p>

<p>其实还有很多例子，比如<strong>可飞行的</strong>，那么把飞行这个特性所具有的属性（如：高度，距离）与方法（如：起飞，降落）放到一个 trait 就是一个合理的拆分。</p>

<h2 id="trait--">Trait 有什么优势 ?</h2>

<p>trait 有什么优势？来看一段代码：</p>

<div class="language-php highlighter-rouge">
<pre class="highlight language-php"><code class=" language-php"><span class="token keyword">class</span> <span class="token class-name">User</span> <span class="token keyword">extends</span> <span class="token class-name">Model</span>
<span class="token punctuation">{</span>
  <span class="token keyword">use</span> <span class="token package">Authenticate</span><span class="token punctuation">,</span> SoftDeletes<span class="token punctuation">,</span> Arrayable<span class="token punctuation">,</span> Cacheable<span class="token punctuation">;</span>

  <span class="token punctuation">.</span><span class="token punctuation">.</span><span class="token punctuation">.</span>
<span class="token punctuation">}</span>
</code></pre>
</div>

<p>这个用户模型类，我们引入了四个特性：注册与授权、软删除、数组式操作、可缓存。</p>

<p>我们看到代码的时候一眼便知道当前支持了哪些个特性。再看下面另外一种写法：</p>

<div class="language-php highlighter-rouge">
<pre class="highlight language-php"><code class=" language-php"><span class="token keyword">abstract</span> AdvansedUser <span class="token punctuation">{</span>
 <span class="token comment" spellcheck="true"> // ... 实现了 Authenticate, SoftDeletes, Arrayable, Cacheable 的所有方法
</span><span class="token punctuation">}</span>
<span class="token keyword">class</span> <span class="token class-name">User</span> <span class="token keyword">extends</span> <span class="token class-name">AdvansedUser</span>
<span class="token punctuation">{</span>
  <span class="token punctuation">.</span><span class="token punctuation">.</span><span class="token punctuation">.</span>
<span class="token punctuation">}</span>
</code></pre>
</div>

<p>你不得不再去阅读 <code class="highlighter-rouge">AdvansedUser</code> 的代码才能理解。你想说没有可读性是因为我基类的名称没起好？可是，这种各种特性组合的一个基类是根本无法起一个见名知义的名称的，不信你可以试一下。</p>

<p>就算你真的起了一个见名知义的名称：<code class="highlighter-rouge">AuthenticateCacheableAndArrayableSoftDeletesUser</code>需求变更，要求在 <code class="highlighter-rouge">FooUser</code>（同样继承了这个基类） 中去除缓存特性，而 <code class="highlighter-rouge">User</code> 类保留这个特性，怎么办？再创建一个基类么？</p>

<p>这就是我理解的 Trait：</p>

<p><strong>它不仅仅是可复用代码段的集合，它应该是一组描述了某个特性的的属性与方法的集合。它的优点再于随意组合，耦合性低，可读性高。</strong></p>

<p>平常写代码的时候也许怎么拆分才是大家的痛点，分享以下几个技巧：</p>

<ul>
<li>从需求或功能描述拆分，而不是写了两段代码发现代码一样就提到一起；</li>
<li>拆分时某些属性也一起带走，比如上面第一个例子里的价格，它是“可卖性”必备的属性；</li>
<li>拆分时如果给 Trait 起名困难时，请认真思考你是否真的拆分对了，因为正确的拆分是很容易描述 “它是一个具有什么功能的特性” 的；</li>
</ul>

<p>总之一定要记住：不要为了让两段相同的代码提到一起这样简单粗暴的方式来拆分。</p>

<p>以上是个人见解，欢迎各位讨论。​<img class="emoji" title=":smile:" alt=":smile:" src="public/images/1f604.png" height="20" width="20" align="absmiddle">​</p> -->

            </article>
            <div class="share">
                <div class="share-component">
                    <a href="javascript:;"></a>
                    <a href="javascript:;"></a>
                    <a href="javascript:;" class="iconfont icon-wechat" target="_blank">
                        <div class="wechat-qrcode">
                            <h4>微信扫一扫：分享</h4>
                            <div class="qrcode">
                                <canvas width="100" height="100"></canvas>
                            </div>
                            <div class="help">
                                <p>微信里点“发现”，扫一下</p>
                                <p>二维码便可将本文分享至朋友圈。</p>
                            </div>
                        </div>
                    </a>
                    <a href="javascript:;"></a>
                    <a href="javascript:;"></a><a href="javascript:;"></a>
                    <a href="javascript:;"></a>
                    <a href="javascript:;"></a>
                    <a href="javascript:;"></a>
                    <a href="javascript:;"></a>
                    <a href="javascript:;"></a>
                </div>
            </div><?php if ($replay): ?>评论区<?php endif; ?>
            <?php foreach ($replay as $value): ?>
            <div class="comment">评论人：<?=$value['postname']; ?>
                <div class="comments">时间：<?=$value['posttime']; ?>
    
      <div id="disqus_thread">内容：<?=$value['replay']; ?><HR style="border:1 dashed #987cb9" width="100%" color=#987cb9 SIZE=1></div>
    
    <noscript>Please enable JavaScript to view the &lt;a href="http://disqus.com/?ref_noscript"&gt;comments powered by Disqus.&lt;/a&gt;
</noscript>
</div>
</div>
<?php endforeach; ?>
<?php if (!empty($_SESSION['name'])): ?>
发表评论：
<form action="index.php?c=detail&a=detail&id=<?=$_GET['id']; ?>&replay=1" method="post">
<script type="text/javascript" src="public/ckeditor/ckeditor.js"></script>
                  <script src="ckeditor/sample.js" type="text/javascript"></script>
                  <textarea  class="ckeditor"  name="content"  id="editor1">
                
                  </textarea></p>
                  <input type="submit" name="" value="提交">
                  <input type="hidden" name="classid" value="">
</form>
<?php else: ?>
登录后可发表评论
<?php endif; ?>
</div>

        <div class="column one-fourth">
            <h3><a href="index.php">首页</a></h3>

            <div class="boxed-group flush" role="navigation">
            <h3>文章详情</h3>
            <ul class="boxed-group-inner mini-repo-list">
                
                <li class="public source ">
                    <div   title="overtrue/wechat" class="mini-repo-list-item css-truncate">
                       <!--  <span class="repo-icon octicon octicon-repo"></span> -->
                        <span class="repo-and-owner css-truncate-target">
                          
                        </span> 作者：<?=$artical[0]['postname']; ?>
                    </div>
                </li>
                
                <li class="public source ">
                    <div  title="EasyWeChat/site" class="mini-repo-list-item css-truncate">
                       <!--  <span class="repo-icon octicon octicon-repo"></span> -->
                        <span class="repo-and-owner css-truncate-target">
                            浏览数量：<?=$artical[0]['hit']; ?>
                        </span>
                   </div>
                </li>
                <li class="public source ">
                    <div  title="EasyWeChat/site" class="mini-repo-list-item css-truncate">
                       <!--  <span class="repo-icon octicon octicon-repo"></span> -->
                        <span class="repo-and-owner css-truncate-target">
                            评论数量：<?=$numberInfo; ?>
                        </span>
                   </div>
                </li>
                <?php if (@$user[0]['type'] == 1): ?>
                <li class="public source ">
                    <a href="index.php?c=detail&a=detail&id=<?=$_GET['id']; ?>&istop=1"  title="laravel/framework" class="mini-repo-list-item css-truncate">
                        <!-- <span class="repo-icon octicon octicon-repo"></span> -->
                        <span class="repo-and-owner css-truncate-target">
                            置顶
                        </span>
                    </a>
                </li>
               
                <li class="public source ">
                    <a href="index.php?c=detail&a=detail&id=<?=$_GET['id']; ?>&canceltop=1" title="caouecs/Laravel-lang" class="mini-repo-list-item css-truncate">
                        <!-- <span class="repo-icon octicon octicon-repo"></span> -->
                        <span class="repo-and-owner css-truncate-target">
                            取消置顶功能
                        </span>
                    </a>
                </li>
                 <?php endif; ?>
            </ul>
</div>

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
</body>
<script src="public/editor/js/jquery.min.js"></script>
<script src="public/editor/lib/marked.min.js"></script>
<script src="public/editor/lib/prettify.min.js"></script>
<script src="public/editor/lib/raphael.min.js"></script>
<script src="public/editor/lib/underscore.min.js"></script>
<script src="public/editor/lib/sequence-diagram.min.js"></script>
<script src="public/editor/lib/flowchart.min.js"></script>
<script src="public/editor/lib/jquery.flowchart.min.js"></script>
<script src="public/editor/editormd.js"></script>
<script type="text/javascript">
    $(function() {
        var testEditormdView;
        testEditormdView = editormd.markdownToHTML("markdown", {
            htmlDecode      : "style,script,iframe",
            emoji           : true,
            taskList        : true,
            tex             : true,  // 默认不解析
            flowChart       : true,  // 默认不解析
            sequenceDiagram : true,  // 默认不解析
        });
    });
</script>
</html>