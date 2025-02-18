<?php
$themeUri = get_template_directory_uri();
$top_page = get_page_by_path('home');
?>

<?php get_header(); ?>

<main class="main" role="main">
  <section class="top">
    <header class="top__header">
      <h2 class="top__title fontPanchang">EBI DIGITAL STUDIO</h2>
      <div class="top__description">
        日本最大のポルシェディーラー EBI GROUPが企画する<br>
        ポルシェのイベントやコンテンツのポータルサイトです。
      </div>
    </header>

    <div class="top__mv">
      <div class="top__mv__upper">
        <article class="top__mv__item">
          <a href="#TBD">
            <div class="top__mv__item__item__img">
              <img src="<?php echo $themeUri; ?>/assets/img/_dummy/top-img-1.jpg" alt="">
            </div>
            <div class="top__mv__item__body">
              <time class="-date fontPanchang">2024/03/03</time>
              <h3 class="-title">
                都市型コンセプトストア<br>
                ポルシェスタジオ銀座オープン
              </h3>
            </div>
          </a>
          <div class="-tags">
            <a href="#TBD">#ポルシェスタジオ銀座</a>
          </div>
        </article>
      </div>
      <div class="top__mv__lower">
        <article class="top__mv__item">
          <a href="#TBD">
            <div class="top__mv__item__item__img">
              <img src="<?php echo $themeUri; ?>/assets/img/_dummy/top-img-2.jpg" alt="">
            </div>
            <div class="top__mv__item__body">
              <time class="-date fontPanchang">2024/03/03</time>
              <h3 class="-title">
                銀座〜湾岸エリアの<br>
                ダイナミックな試乗コースを体験
              </h3>
            </div>
          </a>
          <div class="-tags">
            <a href="#TBD">#試乗体験</a>
          </div>
        </article>
        <article class="top__mv__item">
          <a href="#TBD">
            <div class="top__mv__item__item__img">
              <img src="<?php echo $themeUri; ?>/assets/img/_dummy/top-img-3.jpg" alt="">
            </div>
            <div class="top__mv__item__body">
              <time class="-date fontPanchang">2024/03/03</time>
              <h3 class="-title">
                大学生の頃からの憧れ<br>
                ポルシェ911ターボでドライブインタビュー
              </h3>
            </div>
          </a>
          <div class="-tags">
            <a href="#TBD">#ドライブインタビュー</a>
          </div>
        </article>
      </div>
    </div>

    <?php get_template_part('/include/m-pickup'); ?>
    <?php get_template_part('/include/m-latest'); ?>
    <?php get_template_part('/include/m-love'); ?>

    <div class="top__links">
      <div class="top__links__inner">
        <div class="top__links__item -fest">
          <a href="#TBD" target="_blank">
            <div class="-bg"><img src="<?php echo $themeUri; ?>/assets/img/top-fest-img.jpg" alt=""></div>
            <div class="-name fontPorsche">
              <em>The Fest.</em>
            </div>
            <div class="-logo">
              <img src="<?php echo $themeUri; ?>/assets/img/top-fest-logo.png" alt="">
            </div>
          </a>
        </div>
        <div class="top__links__item -rally">
          <a href="#TBD" target="_blank">
            <div class="-bg"><img src="<?php echo $themeUri; ?>/assets/img/top-rally-img.jpg" alt=""></div>
            <div class="-name fontPorsche">
              <em>The Rally</em> <span>- Amazing Moment -</span>
            </div>
            <div class="-logo">
              <img src="<?php echo $themeUri; ?>/assets/img/top-rally-logo.png" alt="">
            </div>
          </a>
        </div>

      </div>
    </div>

    <section class="top__news section">
      <div class="section__inner">
        <h2 class="top__news__title fontPanchang">
          NEWS
        </h2>
        <div class="top__news__content">
          <div class="newsList">
            <div class="newsList__list">
              <div class="newsList__item">
                <a href="$$TBD">
                  <div class="-title">Porsche × Dai Tamura Special ART exhibition 田村大 スペシャルコラボレーション</div>
                  <time class="-date fontPanchang">2024/03/03</time>
                  <div class="-i"><i><img src="<?php echo $themeUri; ?>/assets/img/icon-arrow-4.svg" alt=""></i></div>
                </a>
              </div>
              <div class="newsList__item">
                <a href="$$TBD">
                  <div class="-title">PUMAｘPORSCHE 911ターボ 50Y ジャパンリミテッドエディション販売</div>
                  <time class="-date fontPanchang">2024/03/03</time>
                  <div class="-i"><i><img src="<?php echo $themeUri; ?>/assets/img/icon-arrow-4.svg" alt=""></i></div>
                </a>
              </div>
              <div class="newsList__item">
                <a href="$$TBD">
                  <div class="-title">911 Targa 4S Heritage Design Editionがポルシェスタジオ銀座で展示</div>
                  <time class="-date fontPanchang">2024/03/03</time>
                  <div class="-i"><i><img src="<?php echo $themeUri; ?>/assets/img/icon-arrow-4.svg" alt=""></i></div>
                </a>
              </div>
              <div class="newsList__item">
                <a href="$$TBD">
                  <div class="-title">911 に着想を得た「ポルシェデザイン・トローリーケース」とどこへ行く？</div>
                  <time class="-date fontPanchang">2024/03/03</time>
                  <div class="-i"><i><img src="<?php echo $themeUri; ?>/assets/img/icon-arrow-4.svg" alt=""></i></div>
                </a>
              </div>
            </div>
          </div>
          <div class="top__news__btn ebiButton -small">
            <a href="#TBD" target="_blank">
              <span class="fontPanchang">VIEW ALL</span>
            </a>
          </div>
        </div>
      </div>
    </section>

    <section class="top__ds">
      <div class="top__ds__inner">
        <h2 class="top__ds__title fontPanchang">
          <em>EBI DIGITAL STUDIO</em>
          <small>ディーラーだから提供できる価値がある。</small>
        </h2>
        <div class="top__ds__text">
          <p>
            日本最大のポルシェディーラー EBI GROUP が企画するポルシェのさまざまなイベントやコンテンツのポータルサイトです。
          </p>
          <p>
            グループのセンターハブストア「ポルシェスタジオ銀座」で企画している<br>
            10のコンテンツ詳細をはじめ、都心の各ポルシェセンターでの企画も随時アップされていきます。
          </p>
          <p>
            またポルシェライフをより充実させるための<br>
            さまざまなライフスタイルコンテンツも同時に発信していきます。
          </p>
        </div>
      </div>
    </section>

    <section class="top__se">
      <div class="top__se__inner">
        <header class="top__se__header">
          <div class="-t1">EBI GROUPが提供する特別なポルシェのブランド体験</div>
          <h2 class="top__se__title fontPanchang">
            SPECIAL <br>EXPERIENCE
          </h2>
          <div class="-t2">
            E-Performanceセンター<br>
            ポルシェスタジオ銀座
          </div>
          <div class="top__se__btn ebiButton -small">
            <a href="#TBD" target="_blank">
              <span class="fontPanchang">VIEW ALL</span>
            </a>
          </div>
          <div class="-t3">
            <p>
              ポルシェスタジオ銀座は、<br>
              まったく新しいポルシェのエンターテイメントディーラーです。
            </p>
            <p>
              E-Performanceセンターとしての機能が中核となり、<br>
              都心のポルシェ正規ディーラー EBI GROUP 8拠点のハブストアとして、<br>
              ブランドアンバサダー 「PORSCHE PRO」 がお客様をアテンドいたします。
            </p>
            <p>
              EBI GROUP だけのオリジナルコンテンツを、<br>
              ぜひご来場のうえご体感ください。
            </p>
          </div>
        </header>

        <section class="top__se__contents">
          <div class="-main">
            <h3 class="top__se__contents__title">
              <div class="-inner">
                <span>
                  <span class="fontPanchang">PORSCHE STUDIO GINZA</span>でしか体験できない
                </span>
                <span>
                  <span class="fontPanchang">10</span>のスペシャルコンテンツ
                </span>
              </div>
            </h3>
            <div class="top__se__contents__map">
              <img src="<?php echo $themeUri; ?>/assets/img/top-se-map.svg" alt="">
            </div>
          </div>
          <div class="-nav">
            <ol>
              <li>
                <a href="#map1">
                  <div class="-img">
                    <img src="<?php echo $themeUri; ?>/assets/img/top-se-img-1.jpg" alt="">
                  </div>
                  <div class="-name fontPanchang">
                    01.<br>
                    EV Station
                  </div>
                  <i><span></span><span></span></i>
                </a>
              </li>
              <li>
                <a href="#map1">
                  <div class="-img">
                    <img src="<?php echo $themeUri; ?>/assets/img/top-se-img-2.jpg" alt="">
                  </div>
                  <div class="-name fontPanchang">
                    02.<br>
                    Exhibition
                  </div>
                  <i><span></span><span></span></i>
                </a>
              </li>
              <li>
                <a href="#map1">
                  <div class="-img">
                    <img src="<?php echo $themeUri; ?>/assets/img/top-se-img-3.jpg" alt="">
                  </div>
                  <div class="-name fontPanchang">
                    03.<br class="pc">
                    Test <br class="sp">Drive Counter
                  </div>
                  <i><span></span><span></span></i>
                </a>
              </li>
              <li>
                <a href="#map1">
                  <div class="-img">
                    <img src="<?php echo $themeUri; ?>/assets/img/top-se-img-4.jpg" alt="">
                  </div>
                  <div class="-name fontPanchang">
                    04.<br class="pc">
                    Sales & <br class="sp">Connection
                  </div>
                  <i><span></span><span></span></i>
                </a>
              </li>
            </ol>
            <ol>
              <li>
                <a href="#map1">
                  <div class="-img">
                    <img src="<?php echo $themeUri; ?>/assets/img/top-se-img-5.jpg" alt="">
                  </div>
                  <div class="-name fontPanchang">
                    05.<br class="pc">
                    Drive <br class="sp">Simulator
                  </div>
                  <i><span></span><span></span></i>
                </a>
              </li>
              <li>
                <a href="#map1">
                  <div class="-img">
                    <img src="<?php echo $themeUri; ?>/assets/img/top-se-img-6.jpg" alt="">
                  </div>
                  <div class="-name fontPanchang">
                    06.<br class="pc">
                    Event <br class="sp">Information
                  </div>
                  <i><span></span><span></span></i>
                </a>
              </li>
              <li>
                <a href="#map1">
                  <div class="-img">
                    <img src="<?php echo $themeUri; ?>/assets/img/top-se-img-7.jpg" alt="">
                  </div>
                  <div class="-name fontPanchang">
                    07.<br class="pc">
                    Drive <br class="sp">Journey
                  </div>
                  <i><span></span><span></span></i>
                </a>
              </li>
              <li>
                <a href="#map1">
                  <div class="-img">
                    <img src="<?php echo $themeUri; ?>/assets/img/top-se-img-8.jpg" alt="">
                  </div>
                  <div class="-name fontPanchang">
                    08.<br>
                    Lifestyle
                  </div>
                  <i><span></span><span></span></i>
                </a>
              </li>
              <li>
                <a href="#map1">
                  <div class="-img">
                    <img src="<?php echo $themeUri; ?>/assets/img/top-se-img-9.jpg" alt="">
                  </div>
                  <div class="-name fontPanchang">
                    09.<br class="pc">
                    Books <br class="sp">& Academy
                  </div>
                  <i><span></span><span></span></i>
                </a>
              </li>
              <li>
                <a href="#map1">
                  <div class="-img">
                    <img src="<?php echo $themeUri; ?>/assets/img/top-se-img-10.jpg" alt="">
                  </div>
                  <div class="-name fontPanchang">
                    10.<br>
                    Restaurant
                  </div>
                  <i><span></span><span></span></i>
                </a>
              </li>
            </ol>
          </div>
        </section>
      </div>
    </section>

    <section class="top__group">
      <div class="top__group__inner">
        <div class="top__group__contents">
          <h2 class="top__group__title fontPanchang">
            <small>日本最大 ポルシェディーラーグループ</small>
            <em>EBI GROUP</em>
          </h2>
          <div class="top__group__text">
            <p>
              日本最大のポルシェセンターとして、<br class="pc">お客様にポルシェの魅力をお伝えできるようおもてなしを追求しています。
            </p>
            <p>
              EBIグループはポルシェジャパンの発足と共に、国内最大市場である東京で20年以上にわたりポルシェビジネスを展開しています。「お客様の歓びの創造者」をモットーに、経験豊富なスタッフによる丁寧な接客と、迅速で質の高いアフターサービスを提供し続けています。全社員がブランドアンバサダーとして積極的に取り組み、将来にわたりかけがえのない信頼関係を築いていきます。
            </p>
            <p>
              <span>日本最大級のポルシェセンターの役割として、オーナー様の「ポルシェのある生活」がより豊かになるよう、様々な提案を図っていきます。プロダクトや季節にちなんだイベントをはじめ、店舗スタッフが自ら企画したイベントなどを開催し、オーナー様同士やスタッフとの繋がりを大切にしています。EBIグループだけのエクスクルーシブな体験をこれからもお楽しみください。</span>
              <img class="sp" src="<?php echo $themeUri; ?>/assets/img/top-group-img.jpg" alt="">
            </p>
          </div>
          <div class="top__group__btn ebiButton -small">
            <a href="#TBD" target="_blank">
              <span class="fontPanchang">VIEW ALL</span>
            </a>
          </div>
        </div>
        <div class="top__group__img pc">
          <img src="<?php echo $themeUri; ?>/assets/img/top-group-img.jpg" alt="">
        </div>
      </div>

      <div class="top__map">
        <div class="top__map__title">
          東京を中心に多数ショールームを展開ぜひお近くのショールームまでお越しください
        </div>
        <div class="top__map__contents">
          <img src="<?php echo $themeUri; ?>/assets/img/_dummy/top-map.jpg" alt="">
        </div>
      </div>
    </section>

    <section class="top__contact">
      <div class="top__contact__inner">
        <h2 class="top__contact__title fontPanchang">
          CONTACT
        </h2>
        <div class="top__contact__text">
          <p>
            ご試乗やご購入に関するご相談など、まずはお気軽にお問い合わせください。<br>
            グループのハブストア「ポルシェスタジオ銀座」のポルシェプロが対応させていただきます。
          </p>
          <p>
            その後、お客様のご状況やご希望に合わせて、<br>
            都心の各拠点へシームレスにお繋ぎすることも可能です。
          </p>
        </div>
        <div class="top__contact__btn ebiButton -full -black">
          <a href="#TBD">
            <span>お問い合わせ</span>
          </a>
        </div>
      </div>
    </section>
  </section>
</main>

<?php get_footer(); ?>