<?php
$themeUri = get_template_directory_uri();
?>

<header class="header" data-ebi-header>
  <?php
  if (is_page('top')):
    $news_id = get_field('header_news');
    if (!empty($news_id)) :
      $post_id = $news_id;
      $post = get_post($post_id);
      $title = get_field('title', $post_id); ?>
      <div class="header__news">
        <div data-ebi-header-news-wrapper>
          <div data-ebi-header-news-list></div>
          <div data-ebi-header-news-item>
            <time class="-date fontPanchang" datetime="<?php echo get_the_date('c', $post_id); ?>"><?php echo get_the_date('Y/m/d', $post_id); ?></time>
            <span>
              <a href="<?php echo get_permalink($post_id); ?>">
                <?php echo $title; ?>
              </a>
            </span>
          </div>
        </div>
      </div>
  <?php
    endif;
  endif; ?>

  <div class="header__inner">
    <h1 class="header__logo">
      <a href="/">
        <img src="<?php echo $themeUri; ?>/assets/img/logo.svg" alt="EBI DIGITAL STUDIO">
      </a>
    </h1>

    <div class="header__nav">
      <nav class="nav">
        <div class="nav__inner">
          <ul class="nav__list">
            <li class="nav__item">
              <a href="/">
                <span>TOP</span>
              </a>
            </li>
            <li class="nav__item -contents">
              <a>
                <span>CONTENTS</span>
                <i>
                  <?php echo file_get_contents(get_template_directory() . '/include/svg/icon-arrow-1.svg'); ?>
                </i>
              </a>
              <div class="nav__child">
                <div class="nav__child__inner">
                  <ul>
                    <li class="-reviews">
                      <a href="/reviews/">
                        <span>REVIEWS</span>
                        <span>レビュー</span>
                      </a>
                    </li>
                    <li class="-customize">
                      <a href="/customize/">
                        <span>CUSTOMIZE</span>
                        <span>カスタマイズ</span>
                      </a>
                    </li>
                    <li class="-heritage">
                      <a href="/heritage/">
                        <span>HERITAGE</span>
                        <span>ヘリテージ</span>
                      </a>
                    </li>
                    <li class="-race">
                      <a href="/race/">
                        <span>RACE</span>
                        <span>レース</span>
                      </a>
                    </li>
                    <li class="-lifestyle">
                      <a href="/lifestyle/">
                        <span>LIFESTYLE</span>
                        <span>ライフスタイル</span>
                      </a>
                    </li>
                    <li class="-event">
                      <a href="/event/">
                        <span>EVENT</span>
                        <span>イベント</span>
                      </a>
                    </li>
                    <li class="-love">
                      <a href="/love/">
                        <span>LOVE PORSCHE</span>
                        <span>オーナーレビュー</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </li>
            <li class="nav__item">
              <a href="/special-ex/">
                <span>SPECIAL EXPERIENCE</span>
              </a>
            </li>
            <li class="nav__item">
              <a href="/news/">
                <span>NEWS</span>
              </a>
            </li>
            <li class="nav__item">
              <a href="/ebi-group/">
                <span>EBI GROUP</span>
              </a>
            </li>
            <li class="nav__item sp">
              <a href="/team/">
                <span>TEAM EBI DIGITAL STUDIO</span>
              </a>
            </li>
          </ul>

          <div class="nav__footer sp">
            <div class="nav__line">
              <a href="https://lin.ee/P29MAc9" target="_blank">
                公式ラインはこちら
              </a>
            </div>
            <div class="nav__footer__info">
              <div class="nav__copyright">
                <small>&copy; 2025 EBI Marketing Co., Ltd.</small>
              </div>
              <div class="nav__stockLink">
                <a href="#TBD" target="_blank">
                  <span>EBI GROUP 認定中古車在庫</span>
                  <i><img src="<?php echo $themeUri; ?>/assets/img/icon-window-1-black.svg" alt=""></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </div>

    <div class="header__contact contactBanner">
      <a href="https://ginza.ebi-group.tokyo/digital-s" target="_blank">
        <img src="<?php echo $themeUri; ?>/assets/img/contact-txt.png" alt="CONTACT">
        <img src="<?php echo $themeUri; ?>/assets/img/contact-txt.png" alt="CONTACT">
        <img src="<?php echo $themeUri; ?>/assets/img/contact-txt.png" alt="CONTACT">
      </a>
    </div>

    <div class="sp header__toggle">
      <button type="button" data-ebi-nav-toggle>
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </div>
</header>