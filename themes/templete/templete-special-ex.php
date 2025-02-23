<?php
/*
Template Name: Special Experience
*/
?>

<?php
$themeUri = get_template_directory_uri();
?>

<?php get_header(); ?>

<main class="main" role="main">
<section class="specialex">

<section class="specialex__mv">
  <figure class="specialex__mv__bg">
    <picture>      
      <source media="(max-width: 768px)" srcset="<?= $themeUri ?>/assets/img/specialex/mv_sp.webp" type="image/webp">
      <source media="(max-width: 768px)" srcset="<?= $themeUri ?>/assets/img/specialex/mv_sp.png">
      <source srcset="<?= $themeUri ?>/assets/img/specialex/mv.webp" type="image/webp">      
      <img src="<?= $themeUri ?>/assets/img/specialex/mv.png" alt="">
    </picture>  
  </figure>
  <h1 class="specialex__mv__title">
    <span class="specialex__mv__titleMain fontPanchang">SPECIAL EXPERIENCE</span>
    <span class="specialex__mv__titleSub">E-Performanceセンター ポルシェスタジオ銀座</span>
  </h1>
</section>


<section class="specialex__about">
  <div class="section__inner">
    <div class="specialex__about__ctt">
      <div class="specialex__about__text">
        <h2 class="specialex__about__heading">
          <span class="specialex__about__headingSub">E-Performanceセンター</span>
          <span class="specialex__about__headingMain">ポルシェスタジオ銀座</span>
        </h2>
        <div class="specialex__about__desc">
          <p>
            ポルシェスタジオ銀座は、ポルシェの世界へと誘う特別な空間です。
            <br class="pc">
            ブランドアンバサダーであるポルシェプロが出迎え、
            <br class="pc">
            E-パフォーマンスモデルについての専門的な販売・アフターフォローを中核とする、
            <br class="pc">
            国内でも類を見ない特別なストアとして、
            <br class="pc">
            EBI GROUPがコンセプトを企画しております。              
          </p>
          <p>
            このストアで[新車/中古車]をご購入いただいたお客様には、
            <br class="pc">
            担当セールスとポルシェプロの「ダブル担当制」による、
            <br class="pc">
            万全のアフターフォロー体制でポルシェライフのサポートをいたします。              
          </p>
          <p>
            さまざまなストアコンテンツを内包する「ポルシェのエンターテイメントストア」で、
            <br class="pc">
            革新と情熱が交差する特別なブランド体験を心ゆくまでお楽しみください。                                                
          </p>
        </div>

      </div>
      <figure class="specialex__about__pic">
        <picture>
          <source media="(max-width: 768px)" srcset="<?= $themeUri ?>/assets/img/specialex/about_sp.png">
          <img loading="lazy" src="<?= $themeUri ?>/assets/img/specialex/about.png" alt="">
        </picture>
      </figure>
    </div>
  </div>
</section>

<div class="specialex__deco">
  <figure class="specialex__deco__item">
    <picture>
      <source media="(max-width: 768px)" srcset="<?= $themeUri ?>/assets/img/specialex/deco_1_sp.png">
      <img loading="lazy" src="<?= $themeUri ?>/assets/img/specialex/deco_1.png" alt="">
    </picture>
  </figure>
  <figure class="specialex__deco__item">
    <picture>
      <source media="(max-width: 768px)" srcset="<?= $themeUri ?>/assets/img/specialex/deco_2_sp.png">
      <img loading="lazy" src="<?= $themeUri ?>/assets/img/specialex/deco_2.png" alt="">
    </picture>
  </figure>
  <figure class="specialex__deco__item">
    <picture>
      <source media="(max-width: 768px)" srcset="<?= $themeUri ?>/assets/img/specialex/deco_3_sp.png">
      <img loading="lazy" src="<?= $themeUri ?>/assets/img/specialex/deco_3.png" alt="">
    </picture>
  </figure>
</div>

<section class="specialex__feature">

  <div class="specialex__feature__item __is1">
    <div class="section__inner">
      <div class="specialex__feature__itemCtt">
        <h2 class="specialex__feature__itemHead fontPanchang">
          FEATURE. 01
        </h2>
        <p class="specialex__feature__itemHeading">
          EVスペシャリスト PORSCHE PROが常駐し、 EVやHybridモデルの専門的な販売と
          <br>            
          アフターフォローを実現する「E-Performanceセンター」
        </p>
        <div class="specialex__feature__itemDesc">
          <p>
            ポルシェプロは、各ポルシェセンターに所属する既存のセールスと異なり、
            <br class="pc"/>
            ブランドアンバサダーという中立的な立場からお客さまのあらゆるご質問・ご相談にお応えいたします。
          </p>
          <p>
            特にE-パフォーマンスモデルに関する幅広い知識と経験により、
            <br class="pc"/>
            EVやHybridのあらゆるモデルや詳細グレードの解説。 
            <br class="pc"/>
            そしてメンテナンス方法や充電に関する解決策といった、 専門的なアドバイスを可能とします。
          </p>
          <p>
            【E-Performance モデル専用】のテストドライブプランでは、東京湾岸エリアでしか実現できない、
            <br class="pc"/>
            ポルシェの最新テクノロジーを味わい尽くす爽快なテストドライブを満喫することができます。            
          </p>                        
        </div>
        <a href="#" class="specialex__feature__itemLink">
          <figure class="specialex__feature__itemLinkFig">
            <img loading="lazy" src="<?= $themeUri ?>/assets/img/specialex/feature_link_thumb.png" alt="">
          </figure>              
          <div class="specialex__feature__itemLinkText">
            <span class="specialex__feature__itemLinkTitle">
                ポルシェの最新テクノロジーを味わい尽くす
                <br class="pc">
              【E-Paformanceモデル専用】の爽快テストドライブプラン
            </span>
            <span class="specialex__feature__itemLinkTag">
                試乗体験プランの詳細を見る
            </span>
          </div>
        </a>          
      </div>
    </div>
  </div>

  <figure class="specialex__feature__deco __is1">
    <picture>      
      <source media="(max-width: 768px)" srcset="<?= $themeUri ?>/assets/img/specialex/deco_4_sp.webp" type="image/webp">
      <source media="(max-width: 768px)" srcset="<?= $themeUri ?>/assets/img/specialex/deco_4_sp.png">
      <source srcset="<?= $themeUri ?>/assets/img/specialex/deco_4.png" type="image/webp">
      <img loading="lazy" src="<?= $themeUri ?>/assets/img/specialex/deco_4.png" alt="">
    </picture>
  </figure>

  <div class="specialex__feature__item __is2">
    <div class="section__inner">
      <div class="specialex__feature__itemCol2 __is1">
        <div class="specialex__feature__itemPic">
          <figure class="specialex__feature__itemPicItem">
            <picture>
              <source media="(max-width: 768px)" srcset="<?= $themeUri ?>/assets/img/specialex/feature_1_sp.png">
              <img loading="lazy" src="<?= $themeUri ?>/assets/img/specialex/feature_1.png" alt="">
            </picture>
          </figure>
          <figure class="specialex__feature__itemPicItem">
            <picture>
              <source media="(max-width: 768px)" srcset="<?= $themeUri ?>/assets/img/specialex/feature_2_sp.png">
              <img loading="lazy" src="<?= $themeUri ?>/assets/img/specialex/feature_2.png" alt="">
            </picture>
          </figure>
        </div>
        <div class="specialex__feature__itemText">
          <h2 class="specialex__feature__itemHead fontPanchang">
            FEATURE. 02
          </h2>
          <p class="specialex__feature__itemHeading">
            EBI GROUP 全拠点から精鋭テクニシャンが集結する
            <br class="pc"/>
            「ポルシェサービスセンター東京ベイ辰巳」 が、
            <br class="pc"/>
            納車後のアフターメンテンナンスを担当
          </p>
          <div class="specialex__feature__itemDesc">
            <p>
              都内最大となる10基のワークベイをはじめ、
              <br class="pc"/>
              EV専用の作業ペイやお客様とともに車両を確認できるダイレクトダイアログペイなど、
              <br class="pc"/>
              最先端の設備を完備した国内初の独立型サービスセンター、
              <br class="pc"/>
              それが「ポルシェサービスセンター東京ベイ辰巳」です。
            </p>
            <p>
              ポルシェスタジオ銀座でボルシェをご購入いただいた場合、
              <br class="pc"/>
              この世界最先端工場がアフターメンテナンスを担当いたします。
            </p>                
            <p>
              レーシングシミュレーターや多数のポルシェライフスタイルアイテムも取り揃え、
              <br class="pc"/>
              整備を待つ時間もポルシェの世界観をお楽しみいただけます。              
            </p>                          
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="specialex__feature__item __is3">
    <div class="section__inner">
      <div class="specialex__feature__itemCol2 __is2">
        <div class="specialex__feature__itemText">
          <h2 class="specialex__feature__itemHead fontPanchang">
            FEATURE. 03
          </h2>
          <p class="specialex__feature__itemHeading __is3">   
            <span>
            日本最大のポルシェディーラーEBI GROUPのハブストアとして、 
            <br class="pc">
            全8拠点とのシームレスな
            <br class="pc">
            オンラインコミュニケーションを実現
            </span>             
          </p>
          <div class="specialex__feature__itemDesc">
            <p>
              ポルシェスタジオ銀座は、
              <br class="pc">
              EBI GROUP 全拠点とのシームレスなオンラインコミュニケーションを実現し、
              <br class="pc">
              新時代のディーラーネットワークを構築いたしました。
              <br class="pc">
              お客様のライフスタイルに適したお好みの店舗やサービス工場へ、
              <br class="pc">
              ご要望に応じてご案内させていただきます。
              <br class="pc">
              また、お客様の適正に合ったセールスのご紹介なども承っておりますので、
              <br class="pc">
              お気軽にご相談ください。
            </p>                
          </div>
        </div>
        <div class="specialex__feature__itemPic __is2">
          <figure class="specialex__feature__itemPicItem">
            <img loading="lazy" src="<?= $themeUri ?>/assets/img/specialex/feature_3.png" alt="">
          </figure>
        </div>            
      </div>
      <div class="specialex__feature__gallery">
        <figure class="specialex__feature__galleryItem">
          <picture>
              <source media="(max-width: 768px)" srcset="<?= $themeUri ?>/assets/img/specialex/feature_4_sp.png">
              <img loading="lazy" src="<?= $themeUri ?>/assets/img/specialex/feature_4.png" alt="">
          </picture>
        </figure>
        <figure class="specialex__feature__galleryItem">
          <picture>
              <source media="(max-width: 768px)" srcset="<?= $themeUri ?>/assets/img/specialex/feature_5_sp.png">
              <img loading="lazy" src="<?= $themeUri ?>/assets/img/specialex/feature_5.png" alt="">
          </picture>
        </figure>
      </div>
    </div>
  </div>

  <div class="specialex__feature__item __is4">
    <div class="section__inner">
      <div class="specialex__feature__itemCtt">
        <h2 class="specialex__feature__itemHead fontPanchang">
          FEATURE. 04
        </h2>
        <p class="specialex__feature__itemHeading">
          ポルシェライフをさらに充実させる、
          <br>
          さまざまなストアコンテンツを内包する全く新しいエンターテイメント空間
        </p>
      </div>
    </div>
  </div>

  <div class="specialex__feature__map"></div>

</section>


<section class="specialex__feature__cta">
  <div class="section__inner">
    <h2 class="specialex__feature__cta__heading">ポルシェスタジオ銀座 公式LINEはこちら</h2>
    <a href="" class="specialex__feature__cta__link">
      公式LINEを登録する
    </a>
  </div>
</section>



</section>    
</main>

<?php get_footer(); ?>