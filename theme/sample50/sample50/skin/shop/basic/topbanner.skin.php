<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">');
add_javascript('<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></scrip>');
?>
<style>
  .swiper {
    width: 100%;
    height: 100%;
  }

  .swiper-slide {
    text-align: center;
    font-size: 18px;
    background: #fff;

    /* Center slide text vertically */
    display: -webkit-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    -webkit-justify-content: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    -webkit-align-items: center;
    align-items: center;
  }

  .swiper-slide a {
    width: 100%;
    height: 100%;
  }

  .swiper-slide img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
</style>
<!-- Swiper -->
<div class="swiper top-swiper">
  <div class="swiper-wrapper">
    <?php
    for ($i = 0; $row = sql_fetch_array($result); $i++) {
      $bimg = G5_DATA_PATH . '/banner/' . $row['bn_id'];
      // 테두리 있는지
      $bn_border  = ($row['bn_border']) ? ' class="sbn_border"' : '';;
      // 새창 띄우기인지
      $bn_new_win = ($row['bn_new_win']) ? ' target="_blank"' : '';
      $banner = '';
      $size = getimagesize($bimg);
      if ($size[2] < 1 || $size[2] > 16)
        continue;
      $item_html = '';
    ?>
      <div class="swiper-slide">
        <?php
        if (file_exists($bimg)) {

          if ($row['bn_url'][0] == '#')
            $banner .= '<a href="' . $row['bn_url'] . '" class="pc">';
          else if ($row['bn_url'] && $row['bn_url'] != 'http://') {
            $banner .= '<a href="' . G5_SHOP_URL . '/bannerhit.php?bn_id=' . $row['bn_id'] . '"' . $bn_new_win . ' class="pc">';
          }
          $item_html .= $banner . '<img src="' . G5_DATA_URL . '/banner/' . $row['bn_id'] . '?' . preg_replace('/[^0-9]/i', '', $row['bn_time']) . '" alt="' . get_text($row['bn_alt']) . '"' . $bn_border . '>';
          if ($banner)
            $item_html .= '</a>';
          echo $item_html;
        }
        ?>
      </div>
    <?php } ?>
  </div>
  <div class="swiper-button-next"></div>
  <div class="swiper-button-prev"></div>
</div>
<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper(".top-swiper", {
    direction: "vertical",
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    }
  });
</script>