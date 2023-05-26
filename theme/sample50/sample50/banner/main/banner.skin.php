<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_javascript('<link rel="stylesheet" href="' . $banner_skin_url . '/style.css">');
add_stylesheet('<link rel="stylesheet" href="' . G5_THEME_URL . '/css/owl.carousel.css">');
add_javascript('<script src="' . G5_THEME_URL . '/js/owl.carousel.js"></script>');

?>
<div class="main-carousel-wrapper">
  <?php if ($is_admin) { ?>
    <a href="<?= tl_banner_adm_link($banners[0]['bn_position']) ?>" target="_blank" class="btn-banner-adm-left"><i class="fa fa-gear" aria-hidden="true"></i></a>
  <?php } ?>
  <div class="main-carousel owl-carousel">
    <?php
    for ($i = 0;isset($banners) && is_array($banners) && $i <  count($banners); $i++) {
      $more = '';
      if ($banners[0]['bn_url'][0] == '#')
        $more = '<a href="' . $banners[$i]['bn_url'] . '">more</a>';
      else if ($banners[$i]['bn_url'] && $banners[$i]['bn_url'] != 'http://') {
        $more = '<a href="' . G5_SHOP_URL . '/bannerhit.php?bn_id=' . $banners[0]['bn_id'] . '&amp;url=' . urlencode($banners[0]['bn_url']) . '"' . $bn_new_win . '>more</a>';
      }
    ?>
      <div class="li img01" style="background-image: linear-gradient( rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1) ), url(<?= G5_DATA_URL . '/banner/' . $banners[$i]['bn_id'] ?>)" data-pc_style="background-image: linear-gradient( rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1) ), url(<?= G5_DATA_URL . '/banner/' . $banners[$i]['bn_id'] ?>)" data-mobile_style="background-image: linear-gradient( rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3) ), url(<?= G5_DATA_URL . '/banner/mobile/' . $banners[$i]['bn_id'] ?>)">
        <div class="copy_area_wrap">
          <div class="copy_area">
            <h2>
              <?php
              // **test** --> <strong>test</strong> 로 변경
              echo preg_replace("@\*\*(.+)\*\*@", '<strong>$1</strong>', $banners[$i]['bn_img_title']);
              ?>
            </h2>
            <h3>
            <?php 
            echo $banners[$i]['bn_img_subtitle'];
            ?></h3>
            <div><?= $more ?></div>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
</div>
<script>
  $(document).ready(function() {
    var breakpoint = <?= $options['breakpoint'] ?>;

    function resize() {
      var ww = $(window).width();
      var $li = $('.main-carousel .li');
      if (breakpoint < ww) {
        $li.each(function(idx, el) {
          var style = $(this).attr('data-pc_style');
          $(this).attr('style', style);
        });
      } else {
        $li.each(function(idx, el) {
          var style = $(this).attr('data-mobile_style');
          $(this).attr('style', style);
        });
      }
    }
    resize();

    $('.main-carousel').owlCarousel({
      items: 1, //보여줄 이미지 갯수
      nav: true,
      loop: true,
      autoplay: true,
      autoplayTimeout: 9000,
      navText: ["PREV", "NEXT"]
    });

    $(window).resize(function(e) {
      resize();
    });

  });
</script>