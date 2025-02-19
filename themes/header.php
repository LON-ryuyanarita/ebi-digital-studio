<?php
$themeUri = get_template_directory_uri();
$pageName = 'top';
if (is_front_page()) {
	$pageName = 'top';
} elseif (is_singular('cpost')) {
	$pageName = 'article';
} elseif (is_archive()) {
	$pageName = 'archive';
} elseif (is_404()) {
	$pageName = 'notfound';
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
	<meta name="format-detection" content="telephone=no" />

	<?php get_template_part('include/c-meta'); ?>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@400;500;700&display=swap" rel="stylesheet">
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/yakuhanjp@4.1.1/dist/css/yakuhanjp.css"> -->

	<link href="<?php echo $themeUri; ?>/assets/css/style.css" rel="stylesheet" />
	<?php wp_head(); ?>
</head>

<body>
	<div class="wrapper -<?php echo $pageName; ?>" data-ebi-wrapper="<?php echo $pageName; ?>">
		<?php get_template_part('include/c-header'); ?>