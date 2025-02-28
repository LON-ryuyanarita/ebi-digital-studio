<?php
/*
Template Name: 404
*/
?>

<?php get_header(); ?>

<main class="main" role="main">
  <section class="notfound">
    <div class="notfound__inner">
      <h2 class="notfound__title fontPanchang">
        Not Found
      </h2>
      <div class="notfound__text">
        <p>
          このページは見つかりませんでした。<br>
          ご指定のURLに誤りがあるか、<br class="sp">お探しのページが削除された可能性があります。
        </p>
      </div>
      <div class="notfound__btn ebiButton -full -black">
        <a href="/">
          <span>トップページへ戻る</span>
        </a>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>