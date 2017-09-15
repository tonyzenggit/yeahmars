<?php
/*
Template Name: Home逼格页
*/
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title><?php bloginfo('name'); ?></title>
<meta name="keywords" content="<?php echo get_option('header_guanjianci'); ?>" />
<meta name="description" content="<?php bloginfo('description'); ?>" />
<?php wp_head();?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<style>
@font-face {font-family: "iconfont";
  src: url('<?php bloginfo('template_directory'); ?>/font/iconfont.eot?t=1490325857091'); /* IE9*/
  src: url('<?php bloginfo('template_directory'); ?>/font/iconfont.eot?t=1490325857091#iefix') format('embedded-opentype'), /* IE6-IE8 */
  url('<?php bloginfo('template_directory'); ?>/font/iconfont.woff?t=1490325857091') format('woff'), /* chrome, firefox */
  url('<?php bloginfo('template_directory'); ?>/font/iconfont.ttf?t=1490325857091') format('truetype'), /* chrome, firefox, opera, Safari, Android, iOS 4.2+*/
  url('<?php bloginfo('template_directory'); ?>/font/iconfont.svg?t=1490325857091#iconfont') format('svg'); /* iOS 4.1- */
}
.iconfont {
  font-family:"iconfont" !important;
  font-style:normal;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
.icon-guanbi:before { content: "\e600"; }
.icon-shang:before { content: "\e751"; }
.icon-fenlei:before { content: "\e611"; }
.icon-quotes-down:before { content: "\e60e"; }
.icon-quotes-up:before { content: "\e60f"; }
.icon-zuobiao:before { content: "\e61b"; }
.icon-zuobiao{margin-right: 10px;font-weight: 600;}
*{margin:0;padding:0}body{font:400 16px/1.62 "Microsoft JhengHei", sans-serif;color:#535353;overflow:hidden}.willerce{text-align:center;margin:100px auto auto auto;max-width:500px;padding:0 20px}.willerce a{color:#535353;text-decoration:underline}.willerce a:link,.willerce a:visited{text-decoration:underline}h1{font-size:26px;color:#424242;margin-bottom:20px}.avatar{border-radius:64px;}.nav a{padding:0 6px 0 6px}@keyframes fade-in{0%{opacity:0}40%{opacity:0}100%{opacity:1}}@-webkit-keyframes fade-in{0%{opacity:0}40%{opacity:0}100%{opacity:1}}.willerce{animation:fade-in;animation-duration:1s;-webkit-animation:fade-in 1s}
.sydlogo{position:relative;width:128px;height:128px;margin:0 auto;margin-bottom:35px;}
.zjgx {position:absolute;background:#f00;font-size:16px;height:40px;width:40px;line-height:40px;text-align:center;top:0px;right:0px;border-radius:20px;color:#fff;}
footer{position: absolute;bottom: 20px;right: 20px;font-size: 12px;}
</style>
</head>
<body class="custom-background">
<div class="willerce">
	<div class="sydlogo">
		<?php if ( !get_option('header_logo_image') ) {} else { echo '<img class="avatar" width="128" height="128" src="' . get_option('header_logo_image') .'">';} ?>
		<?php if (get_posts_count_from_last_24h() != '0') { ?>
			<!-- <div class="zjgx"><?php echo get_posts_count_from_last_24h(); ?></div> -->
		<?php } else { } ?>
	</div>
	<h1 class="indexcolor"><?php bloginfo('name'); ?></h1>
	<p class="indexcolor"><?php echo get_option('header_bzms'); ?> More <a href="/about">About Me</a> </p>
	<p class="indexcolor" style="height: 24px; line-height: 24px; margin: 15px 0;">
		<i class="iconfont icon-zuobiao"></i><?php echo get_option('header_dzzb'); ?>
	</p>
	<p class="nav">
	<?php   
	$menuParameters = array(  
	'container' => false,  
	'echo' => false,  
	'items_wrap' => '%3$s',  
	'depth' => 0,  
	'theme_location'=>'main',
	);  
	echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );  
	?> 
	</p>
</div>
<footer>©2017年摄于广西钦州</footer>
</body></html>