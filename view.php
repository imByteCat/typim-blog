<?php
// 调用文章信息
require_once('get_info.php');

// 获取文章名
$post_file_name = $_GET["name"];

// 只读方式打开文章
$post_text_open = fopen($config['posts_dir'] . '/' . $post_file_name . ".md", "r");

// 读取内容
$post_text = fread($post_text_open,filesize($config['posts_dir'] . '/' . $post_file_name . ".md"));

// 关闭文件
fclose($post_text_open);




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




// 以 "\n\n" 作为分隔符分割字符串到数组
$content_cut = explode("\n\n", $post_text);

// 删除数组中的第一个项目，也就是文章属性
array_splice($content_cut, 0, 1);

// 合并除属性外的内容
$post_content = implode("\n\n", $content_cut);

// 多行文本转换为单行文本
// 已弃用，Markdown 解析器从 Remarkable.js 换成 Parsedown.php
//$post_content = str_replace("\n", '\n', $post_content);

// 载入 Markdown 解析器 Parsedown.php
include('3rdparty/parsedown.php');
$markdown = new Parsedown();

// 载入模板
require_once($template_root . 'post.html');

?>