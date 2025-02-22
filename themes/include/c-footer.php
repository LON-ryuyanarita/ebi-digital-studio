<?php
$themeUri = get_template_directory_uri();
?>

<footer class="footer" role="contentinfo" data-ebi-footer>
  <div class="footer__inner">
    <div class="footer__upper">
      <div class="-c1">
        <div class="footer__logo">
          <a href="/">
            <img src="<?php echo $themeUri; ?>/assets/img/logo-white.svg" alt="EBI DIGITAL STUDIO">
          </a>
        </div>
      </div>

      <div class="-c2">
        <div class="footer__nav">
          <ul class="footer__nav__items">
            <li>
              <a href="/">
                <span>TOP</span>
              </a>
            </li>
            <li>
              <a href="/special-ex/">
                <span>SPECIAL EXPERIENCE</span>
              </a>
            </li>
            <li>
              <a href="/news/">
                <span>NEWS</span>
              </a>
            </li>
            <li>
              <a href="/ebi-group/">
                <span>EBI GROUP</span>
              </a>
            </li>
            <li>
              <a href="/team/">
                <span>TEAM EBI DIGITAL STUDIO</span>
              </a>
            </li>
          </ul>
        </div>
      </div>

      <div class="-c3">
        <div class="footer__contents">
          <div class="footer__contents__title">CONTENTS</div>
          <ul class="footer__contents__items">
            <li>
              <a href="/reviews/">
                <span class="ebiFontP">REVIEWS</span>
              </a>
            </li>
            <li>
              <a href="/cutomize/">
                <span class="ebiFontP">CUSTOMIZE</span>
              </a>
            </li>
            <li>
              <a href="/heritage/">
                <span class="ebiFontP">HERITAGE</span>
              </a>
            </li>
            <li>
              <a href="/race/">
                <span class="ebiFontP">RACE</span>
              </a>
            </li>
            <li>
              <a href="/lifestyle/">
                <span class="ebiFontP">LIFESTYLE</span>
              </a>
            </li>
            <li>
              <a href="/event/">
                <span class="ebiFontP">EVENT</span>
              </a>
            </li>
            <li>
              <a href="/love/">
                <span class="ebiFontP">LOVE PORSCHE</span>
              </a>
            </li>
          </ul>
        </div>
      </div>


      <div class="-c4">
        <div class="footer__contact contactBanner">
          <a href="https://ginza.ebi-group.tokyo/digital-s" target="_blank">
            <img src="<?php echo $themeUri; ?>/assets/img/contact-txt.png" alt="CONTACT">
            <img src="<?php echo $themeUri; ?>/assets/img/contact-txt.png" alt="CONTACT">
            <img src="<?php echo $themeUri; ?>/assets/img/contact-txt.png" alt="CONTACT">
          </a>
        </div>

        <div class="footer__lineLink">
          <a href="https://lin.ee/P29MAc9" target="_blank">
            <span class="-txt1">
              EBI DIGITAL STUDIO<br>
              公式アカウント<br>
              友だち登録募集中!
            </span>
            <i>
              <?php echo file_get_contents(get_template_directory() . '/include/svg/icon-line.svg'); ?>
            </i>
            <span class="-txt2">
              公式アカウント<br>
              を見る<i><img src="<?php echo $themeUri; ?>/assets/img/icon-arrow-3.svg" alt=""></i>
            </span>
          </a>
        </div>
      </div>
    </div>

    <div class="footer__lower">
      <div class="-c1">
      </div>

      <div class="-c2">
        <div class="footer__copyright">
          <small>&copy; 2025 EBI Marketing Co., Ltd.</small>
        </div>
      </div>

      <div class="-c3">
      </div>

      <div class="-c4">
        <div class="footer__stockLink">
          <a href="#TBD" target="_blank">
            <span>EBI GROUP 認定中古車在庫</span>
            <i><img src="<?php echo $themeUri; ?>/assets/img/icon-window-1.svg" alt=""></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</footer>