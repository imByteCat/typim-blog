<?php
// 标记主页面
$isHome = True;

// 调用函数
require_once('functions.php');

// 调用用户设置
require_once('settings.php');

// 调用文章信息
require_once('get_info.php');

// 获取文章数量
$posts_num = count($item['time_stamp']);

// 引入页眉模板
require_once($template_root . 'index.html');

?>