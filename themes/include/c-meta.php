<?php
$themeUri = get_template_directory_uri();

$title = "EBI DIGITAL STUDIO｜ポルシェ正規ディーラー EBI GROUP";
$description = "EBI DIGITAL STUDIOは日本最大のポルシェ正規ディーラー EBI GROUP が提供する、ポルシェに惹かれるすべての人たちへ向けたWEBスタジオです。EBI DIGITAL STUDIOはWEBメディアの枠を超え、ポルシェの魅力を心から楽しめる“ポルシェ・エンターテイメント空間”として、より本質的なポルシェブランドの真髄を、正規ディーラーグループの目線で、わかりやすく、そして心躍る形で発信します。";
$url = home_url();
$ogimage = $themeUri . "/assets/img/ogp/ogp.png";

$_base_title = "｜EBI DIGITAL STUDIO｜ポルシェ正規ディーラー EBI GROUP";
// タクソノミー名と日本語名のマッピング
$term_ja_names = array(
	'REVIEWS'   => 'レビュー',
	'CUSTOMIZE' => 'カスタマイズ',
	'HERITAGE'  => 'ヘリテージ',
	'RACE'      => 'レース',
	'LIFESTYLE' => 'ライフスタイル',
	'EVENT'     => 'イベント',
	'LOVE'      => 'ラブポルシェ',
	'NEWS'      => 'ニュース',
);

function get_article_description($post_id)
{
	$description = '';
	if (have_rows('body', $post_id)) {
		while (have_rows('body', $post_id)) {
			the_row();
			$type = get_sub_field('type');
			if ($type === 'h2') {
				$description .= str_replace(["\r", "\n"], '', strip_tags(get_sub_field('h2'))) . ' ';
			} elseif ($type === 'h3') {
				$description .= str_replace(["\r", "\n"], '', strip_tags(get_sub_field('h3'))) . ' ';
			} elseif ($type === 'h4') {
				$description .= str_replace(["\r", "\n"], '', strip_tags(get_sub_field('h4'))) . ' ';
			} elseif ($type === 'p') {
				$description .= str_replace(["\r", "\n"], '', strip_tags(get_sub_field('p'))) . ' ';
			} elseif ($type === 'note') {
				$description .= str_replace(["\r", "\n"], '', strip_tags(get_sub_field('note'))) . ' ';
			} elseif ($type === 'box') {
				$box = get_sub_field('box');
				$description .= str_replace(["\r", "\n"], '', strip_tags($box['body'])) . ' ';
			} elseif ($type === 'blockquote') {
				$blockquote = get_sub_field('blockquote');
				$description .= str_replace(["\r", "\n"], '', strip_tags($blockquote['body'])) . ' ';
			}
		}
	}
	return mb_substr(trim($description), 0, 160) . '...';
}

if (is_404()) {
	$title = 'ページが見つかりませんでした ー 404エラー ー ' . $_base_title;
	$description = "EBI DIGITAL STUDIO内で該当ページが見つかりませんでした。EBI DIGITAL STUDIOは日本最大のポルシェ正規ディーラー EBI GROUP が提供する、ポルシェに惹かれるすべての人たちへ向けたWEBスタジオです。";
} elseif (is_tax('cpost-cat')) {
	$term = get_queried_object();
	$slug = strtoupper($term->slug);
	$ja_name = isset($term_ja_names[$slug]) ? $term_ja_names[$slug] : $slug;
	if ($slug == 'LOVE') {
		$slug = 'LOVE PORSCHE';
	}
	$title = "{$slug} ー {$ja_name} ー {$_base_title}";
	$description = $term->description;
	if ($term->slug !== 'news') {
		$ogimage = $themeUri . "/assets/img/ogp/" . $term->slug . ".png";
	}
} elseif (is_tax('cpost-tag')) {
	$term = get_queried_object();
	$tag_name = $term->name;
	$title = "#{$tag_name}一覧ページ{$_base_title}";
	$description = "EBI DIGITAL STUDIOの {$tag_name} ページです。";
} elseif (is_singular('cpost')) {
	$post_id = get_the_ID();
	$post_title = str_replace(["\r", "\n"], '', strip_tags(get_field('title', $post_id)));
	$terms = get_the_terms($post_id, 'cpost-cat');
	if (!empty($terms) && !is_wp_error($terms)) {
		$term = array_shift($terms);
		$slug = strtoupper($term->slug);
		$ja_name = isset($term_ja_names[$slug]) ? $term_ja_names[$slug] : $slug;
		if ($slug == 'LOVE') {
			$slug = 'LOVE PORSCHE';
		}
		$title = "{$post_title}｜{$slug} ー {$ja_name} ー {$_base_title}";
	} else {
		$title = "{$post_title}｜{$_base_title}";
	}
	$description = get_article_description(get_the_ID());
	$kv = get_field('kv', $post_id);
	$ogimage = wp_get_attachment_image_url($kv, 'full') ?? null;
} elseif (is_page()) {
	$slug = get_post_field('post_name', get_the_ID());
	switch ($slug) {
		case 'team':
			$title = "TEAM EBI DIGITAL STUDIO" . $_base_title;
			$description = "EBI DIGITAL STUDIO は、ポルシェに惹かれるすべての人々に向けた、“ポルシェ・エンターテイメント空間”として制作しました。最新情報の単純な追従ではなく、より本質的なポルシェブランドの真髄を、わかりやすく、そして心躍る形で発信していきます。“人生を変える存在”としてのポルシェ。その魅力を余すことなく届け、「ポルシェのある生活」の特別さを、より多くの方に感じていただければ幸いです。";
			break;
		case 'ebi-group':
			$title = "EBI GROUP" . $_base_title;
			$description = "日本最大のポルシェ正規ディーラーグループである EBI GROUP の紹介ページです。 EBI GROUP は1998年から25年以上に渡り国内最大市場である東京でポルシェ正規ディーラーを展開しています。お客さまの“歓びの創造者”をモットーに、「PORSCHE PRO（ポルシェプロ）」をはじめとする、経験豊富なスタッフによる丁寧な接客と、迅速で質の高いアフターサービスを提供し続けます。";
			$ogimage = $themeUri . "/assets/img/ogp/ebigroup.png";
			break;
		case 'special-ex':
			$title = "SPECIAL EXPERIENCE ー E-Performanceセンター ポルシェスタジオ銀座 ー " . $_base_title;
			$description = "ポルシェスタジオ銀座は、 EBI GROUP のスペシャルコンテンツを体感できる、まったく新しいポルシェのエンターテイメントディーラーです。E-Performanceセンターとしての機能が中核となり、都心のポルシェ正規ディーラー EBI GROUP 8拠点のハブストアとして、ブランドアンバサダー 「PORSCHE PRO（ポルシェプロ）」 がお客様をアテンドいたします。";
			$ogimage = $themeUri . "/assets/img/ogp/special-experience.png";
			break;
		default:
			$title = get_the_title() . $_base_title;
			break;
	}
}

?>

<title><?php echo $title ?></title>
<meta name="description" content="<?php echo $description; ?>">
<meta property="og:title" content="<?php echo $title; ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php the_permalink(); ?>">
<meta property="og:image" content="<?php echo $ogimage; ?>">
<meta property="og:site_name" content="<?php echo $title; ?>">
<meta property="og:description" content="<?php echo $description; ?>">
<meta property="og:locale" content="ja_JP">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo $title; ?>">
<meta name="twitter:description" content="<?php echo $description; ?>">
<meta name="twitter:image" content="<?php echo $ogimage; ?>">

<link rel="icon" href="<?php echo $themeUri; ?>/assets/icons/favicon.ico">
<link rel="apple-touch-icon" href="<?php echo $themeUri; ?>/assets/icons/apple-touch-icon.png">