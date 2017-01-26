<?php
require_once('get_info.php');


// 获取文章数量
$posts_num = count($item['time_stamp']);

// 输出重新排序后的文章
for ($i = 0; $i < $posts_num; $i++) {

	$key = current($ordered_posts);

	$item['year'][$key] = date('Y', $item['time_stamp'][$key]);

	// 下一项
	next($ordered_posts);
}
$test = array_count_values($item['year']);
print_r($test);