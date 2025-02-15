<?php
$themeUri = get_template_directory_uri();

$title = "TBD_EBI";
$description = "TBD_EBI";
$url = home_url();

$_base_title = " | TBD_EBI";

if (is_404()) {
	$title = $_base_title . "404";
	// $description = "xxx";
} elseif (is_singular("cpost")) {
	$post_title = get_the_title($post->ID);
	$title = $post_title . $_base_title;
	// $description = "xxx";
}
?>

<title><?php echo $title ?></title>
<meta name="description" content="<?php echo $description; ?>">
<meta property="og:title" content="<?php echo $title; ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php the_permalink(); ?>">
<meta property="og:image" content="<?php echo $themeUri; ?>/assets/img/ogp.png">
<meta property="og:site_name" content="<?php echo $title; ?>">
<meta property="og:description" content="<?php echo $description; ?>">
<meta property="og:locale" content="ja_JP">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo $title; ?>">
<meta name="twitter:description" content="<?php echo $description; ?>">
<meta name="twitter:image" content="<?php echo $themeUri; ?>/assets/img/ogp.png">

<link rel="icon" href="<?php echo $themeUri; ?>/assets/icons/favicon.ico">
<link rel="apple-touch-icon" href="<?php echo $themeUri; ?>/assets/icons/apple-touch-icon.png">
<link rel="manifest" href="<?php echo $themeUri; ?>/assets/icons/manifest.webmanifest">