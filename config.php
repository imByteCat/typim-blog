<?php
/***********************************************
*               高级用户偏好设置               *
************************************************
*                   # 注意 #                   *
*     更改这些设置可能会导致程序停止工作！     *
************************************************/

require_once('settings.php');

// 设置文章存放目录
$config['posts_dir'] = 'posts';

// 设置主题模板存放目录
$config['templates_dir'] = 'templates';

// 定义模板目录
$template_root = $config['templates_dir'] . '/' . $settings['template'] . '/';
?>