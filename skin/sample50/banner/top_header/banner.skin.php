<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
if ($_COOKIE['ck_top_header_bar'] != 'X' && isset($banners) && is_array($banners) && count($banners) > 0) { // X --> N 으로 수정하면 하루동안 보이지 않음 
  add_javascript('<link rel="stylesheet" href="' . $banner_skin_url . '/style.css">');

  $bn_new_win = ($banners[0]['bn_new_win']) ? ' target="_blank"' : '';
?>
  <div id="top-header-bar" style="background-color: <?= (!isset($banners[0]['bn_bg']) && $banners[0]['bn_bg'] == '' ? '#ddd' : $banners[0]['bn_bg']) ?>;">
    <?php if ($is_admin) { ?>
      <a href="<?= tl_banner_adm_link($banners[0]['bn_position']) ?>" target="_blank" class="btn-banner-adm-left"><i class="fa fa-gear" aria-hidden="true"></i></a>
    <?php } ?>
    <div class="img">
      <?php
      $banner = '';
      if ($banners[0]['bn_url'][0] == '#')
        echo '<a href="' . $banners[0]['bn_url'] . '">';
      else if ($banners[0]['bn_url'] && $banners[0]['bn_url'] != 'http://') {
        echo '<a href="' . G5_SHOP_URL . '/bannerhit.php?bn_id=' . $banners[0]['bn_id'] . '&amp;url=' . urlencode($banners[0]['bn_url']) . '"' . $bn_new_win . '>';
      }
      ?>
        <img src="<?= G5_DATA_URL . '/banner/' . $banners[0]['bn_id'] ?>" style="max-width:100%;" alt="<?= get_text($banners[0]['bn_alt']) ?>" class="bn-pc-only">
        <img src="<?= G5_DATA_URL . '/banner/mobile/' . $banners[0]['bn_id'] ?>" style="max-width:100%;" alt="<?= get_text($banners[0]['bn_alt']) ?>" class="bn-mobile-only">
      <?php
      if ($banners[0]['bn_url'][0] == '#' || ($banners[0]['bn_url'] && $banners[0]['bn_url'] != 'http://') ) echo '</a>';
      ?>
    </div>
    <button type="button" class="btn-close" onClick="hide_top_header_bar('#top-header-bar','ck_top_header_bar','N');"><span class="sound_only">배너닫기</span></button>
  </div>
  <script type="text/javascript">
    function hide_top_header_bar(div_id, ck_key, value) {
      $(div_id).animate({
        'height': 0
      }, 800, function() {
        $(this).css("display", "none");
      });
      var today = new Date();
      today.setTime(today.getTime());
      var expires = 1 * 60 * 60 * 24;
      var expires_date = new Date(today.getTime() + (expires));
      document.cookie = ck_key + "=" + value + "; path=/ ;domain=" + document.domain + "; expires=" + expires_date.toGMTString();
    }
  </script>
<?php } ?>