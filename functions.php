<?php
/****************
 * 自定义函数页 *
 ****************/

// 文章列表函数 
function get_posts() {

	// 引入全局变量
	global $item, $settings, $config, $posts_num, $ordered_posts, $ordered_posts, $template_root;

	// 输出重新排序后的文章
	for ($i = 0; $i < $posts_num; $i++) {

		$key = current($ordered_posts);

		// 引入文章列表模板
		require($template_root . 'posts_list.html');

		// 下一项
		next($ordered_posts);
	}
}

// 判定首页函数
function show_title() {

	global $item, $key, $settings, $isHome;

	if ($isHome) {

		$header_title = $settings['title'];

	} else {

		$header_title = $item['title'][$key];

	}

	return($header_title);
}

// 第三方评论框（默认多说可以自己修改）
function show_comment() {

	global $settings, $item, $key, $post_file_name;

	if(isset($settings['duoshuo'])) {
		echo <<< COMMENT
		<!-- 多说评论框 -->
		<div class="ds-thread" data-thread-key="" data-title="{$item['title'][$key]}" data-url="{$settings['base_url']}{$post_file_name}.html"></div>
		<!-- 多说公共JS代码 start (一个网页只需插入一次) -->
		<script type="text/javascript">
		var duoshuoQuery = {short_name:"{$settings['duoshuo']}"};
			(function() {
				var ds = document.createElement('script');
				ds.type = 'text/javascript';ds.async = true;
				ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
				ds.charset = 'UTF-8';
				(document.getElementsByTagName('head')[0] 
				 || document.getElementsByTagName('body')[0]).appendChild(ds);
			})();
		</script>
		<!-- 多说公共JS代码 end -->

COMMENT;
	}

}












?>