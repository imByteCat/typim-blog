<?php
// 调用扫描结果
require_once('scan.php');

// 调用配置
require_once('config.php');

$post_file_name_bak = $post_file_name;

foreach($post_file_name as $key => $current_post_file_name) {

	// 只读方式打开文章
	$post_text_open = fopen($config['posts_dir'] . '/' . $post_file[$key], "r");

	// 读取内容
	$post_text = fread($post_text_open,filesize($config['posts_dir'] . '/' . $post_file[$key]));

	// 装载正则表达式……
	$search_title = "/Title: (.*?)\n/i";
	$search_date = "/Date: (.*?)\n/i";
	$search_tags = "/Tags: (.*?)\n/i";
	$search_intro = "/Intro: (.*?)\n/i";

	// 匹配文章属性，然后存起来
	preg_match_all($search_title, $post_text, $title);
	preg_match_all($search_date, $post_text, $date);
	preg_match_all($search_tags, $post_text, $tags);
	preg_match_all($search_intro, $post_text, $intro);

	// 为了方便起见，咱重新起个名字
	$item['name'][$key] = $current_post_file_name;
	$item['title'][$key] = $title[1][0];
	$item['date'][$key] = $date[1][0];
	$item['intro'][$key] = $intro[1][0];

	// 要是没有标签，没关系，咱让它变成无，这样就不会报错
	if (empty($tags[1][0])) {
		$item['tags'][$key] = '无标签';
	} else {
		$item['tags'][$key] = $tags[1][0];
	}

	// 日期转时间戳
	$item['time_stamp'][$key] = strtotime($item['date'][$key]);

	// 关闭文件
	fclose($post_text_open);
}

// 按时间排序
arsort($item['time_stamp']);

// 获取重排后的键值
$ordered_posts = array_keys($item['time_stamp']);
?>