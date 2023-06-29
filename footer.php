  <script src="<?php echo get_theme_file_uri('/src/landing-animation.js'); ?>" async></script>
  <script src="<?php echo get_theme_file_uri('/src/landing-parallax.js'); ?>" async></script>
  </main>
  <footer id="footer">
    <div class="footer-contener container">
      <div class="footer-contener-content">
        <div class="footer-contener-content__logo">
          <?php include get_stylesheet_directory().'/img/svg/luckycuppa-footer-logo.svg' ?>
        </div>
        <span class="footer-contener-content__text font-footer">The Essential Ceramic Cups for Your Drinking Pleasure</span>
      </div>
      <div class="footer-contener-lists">
        <ul class="font-heading heading-min" aria-label="Sitemap">
          <li>
            <?php
              wp_nav_menu(array(
                'theme_location' => 'sitemap',
                'container_class' => 'footer-contener-lists__sitemap',
                'menu_class' => 'font-footer !w-full'
              ));
            ?>
          </li>
        </ul>
        <ul class="font-heading heading-min" aria-label="<?php bloginfo('title'); ?>">
          <li>
            <span class="font-footer uppercase">128 CITY ROAD</span>
          </li>
          <li>
            <span class="font-footer uppercase">LONDON</span>
          </li>
        </ul>
      </div>
      <div class="footer-contener-newsletter">
        <span class="footer-contener-newsletter__text font-heading heading-min">Subscribe to our newsletter</span>
        <form id="sib_signup_form_1" class="footer-contener-newsletter-form sib_signup_form" method="post">
          <div class="footer-contener-newsletter-form__loader" style="display: none;">
            <img src="http://lucky-cuppa.local/wp-includes/images/spinner.gif" alt="loader">
          </div>
          <input type="hidden" name="sib_form_action" value="subscribe_form_submit">
          <input type="hidden" name="sib_form_id" value="1">
          <input type="hidden" name="sib_form_alert_notice" value="Please fill out this field">
          <input type="hidden" name="sib_security" value="55f3a3e0b8">
          <div class="footer-contener-newsletter-form-box">
            <div class="footer-contener-newsletter-form-box__alert sib_signup_box_inside_1">
              <p class="font-footer sib_msg_disp" style="display: none;">Thank you, you have successfully registered!</p>
            </div>
            <div class="footer-contener-newsletter-form-box-inputs relative">
              <input type="email" class="footer-contener-newsletter-form-box-inputs__email sib-email-area" name="email" required="required" placeholder="Input Email">
              <input id="subscription-submit" type="submit" class="sib-default-btn !hide" name="submit" value="Subscribe">
              <span class="footer-contener-newsletter-form-box-inputs__submit" onclick="document.getElementById('subscription-submit').click()"><?php include get_stylesheet_directory().'/img/svg/arrow-right.svg'; ?></span>
            </div>
          </div>
        </form>
        <div class="footer-contener-newsletter-socials">
          <div class="footer-contener-newsletter-socials__text">
            <span class="font-heading heading-min">Follow Us</span>
          </div>
          <ul class="footer-contener-newsletter-socials__icons">
            <li>
              <a href="/"><?php include get_stylesheet_directory().'/img/svg/icon-facebook.svg'; ?></a>
            </li>
            <li>
              <a href="/"><?php include get_stylesheet_directory().'/img/svg/icon-instagram.svg'; ?></a>
            </li>
            <li>
              <a href="/"><?php include get_stylesheet_directory().'/img/svg/icon-twitter.svg'; ?></a>
            </li>
          </ul>
        </div>
      </div>
      <div class="footer-contener-copyright">
        <span class="font-subtitle">Copyright &copy; <?php bloginfo('title'); ?>&trade; 2023</span>
      </div>
    </div>
  </footer>
</body>
</html>