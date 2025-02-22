<?php
$themeUri = get_template_directory_uri();
?>

<aside class="categories section">
  <div class="section__inner">
    <h2 class="categories__title fontPanchang">
      CATEGORY
    </h2>
    <div class="categories__items">
      <ul>
        <li class="-reviews">
          <a href="/reviews/">
            <span class="-en fontPanchang">REVIEWS</span>
            <span class="-ja">レビュー</span>
          </a>
        </li>
        <li class="-customize">
          <a href="/customize/">
            <span class="-en fontPanchang">CUSTOMIZE</span>
            <span class="-ja">カスタマイズ</span>
          </a>
        </li>
        <li class="-heritage">
          <a href="/heritage/">
            <span class="-en fontPanchang">HERITAGE</span>
            <span class="-ja">ヘリテージ</span>
          </a>
        </li>
        <li class="-race">
          <a href="/race/">
            <span class="-en fontPanchang">RACE</span>
            <span class="-ja">レース</span>
          </a>
        </li>
        <li class="-lifestyle">
          <a href="/lifestyle/">
            <span class="-en fontPanchang">LIFESTYLE</span>
            <span class="-ja">ライフスタイル</span>
          </a>
        </li>
        <li class="-event">
          <a href="/event/">
            <span class="-en fontPanchang">EVENT</span>
            <span class="-ja">イベント</span>
          </a>
        </li>
      </ul>
    </div>

    <?php get_template_part('include/m-tags'); ?>
  </div>
</aside>