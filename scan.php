<?php
// 装载配置文件
require_once('config.php');

// 扫描一下文章目录内有哪些东东
$scan = scandir($config['posts_dir']);

// 嗯，让我们剔除那些无卵用的东西
$scan = array_diff($scan, array('..','.'));

// 把数组转成字符串方便我们更好地用正则表达式匹配出来
$scan = ',' . implode(',', $scan) . ',';

// 装载正则表达式……
$search = ',(.*?).md,';

// 开始匹配……然后存起来
preg_match_all($search, $scan, $matches);

// 让我们去掉前面的 ","
foreach($matches[1] as $key => $current_post_file) {
	$post_file[$key] = ltrim($matches[0][$key],",");
	$post_file_name[$key] = rtrim($post_file[$key],".md");
}
