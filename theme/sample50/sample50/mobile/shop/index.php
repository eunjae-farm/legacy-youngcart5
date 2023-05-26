<?php
include_once('./_common.php');

define("_INDEX_", TRUE);

include_once(G5_THEME_MSHOP_PATH . '/shop.head.php');


add_stylesheet('<link rel="stylesheet" href="' . G5_THEME_URL . '/css/layout.css">');
add_stylesheet('<link rel="stylesheet" href="' . G5_THEME_URL . '/css/owl.carousel.css">');
add_javascript('<script src="' . G5_THEME_URL . '/js/owl.carousel.js"></script>');
?>


<script src="<?php echo G5_JS_URL; ?>/swipe.js"></script>
<script src="<?php echo G5_JS_URL; ?>/shop.mobile.main.js"></script>


<!-- <div id='sidebar'>
  <div class="side_btn">
    <div class="login">로그인</div>
    <div class="join"> <a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></div>
  </div>
<div class="log">
<?php //echo outlogin('theme/sidebar'); 
?>
</div> -->

</div>

<style>
  #sidebar {
    width: 300px;
    height: 100vh;
    position: fixed;
    top: 0;
    right: 0;
    background-color: #ddd;
    z-index: 9999;
  }

  #sidebar .join {
    background: #eee;
  }

  .side_btn {
    width: 100%;
    display: flex;
    height: 60px;

  }

  .side_btn div {
    width: 50%;
    padding: 19px 0;
    text-align: center;
  }
</style>

<!--■■■visual_slider■■■-->
<div class="visual_slider" id="visual">

  <?php
  tl_display_banner('메인', 'main', 'both', array('breakpoint' => 640));
  ?>

</div>
<!--■■■visual_slider■■■-->


<div class="idx_c">
  <?php if ($default['de_mobile_type4_list_use']) { ?>
    <div id="idx_new" class="sct_wrap">
      <!--   <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=1">베스트</a></h2>-->
      <?php
      $list = new item_list();
      $list->set_mobile(true);
      $list->set_type(4);
      $list->set_view('it_id', false);
      $list->set_view('it_name', true);
      $list->set_view('it_cust_price', true);
      $list->set_view('it_price', true);
      $list->set_view('it_1', true);
      $list->set_view('it_icon', true);
      $list->set_view('sns', true);
      echo $list->run();
      ?>
    </div>
  <?php } ?>
</div>



<section class="tl_top_wrap clearfix">
  <div class="inner clearfix">
    <ul>

      <li class="left">
        <div class="photo01">
          <!--         <div class="clearfix">
            <h2>SPRING<br>COSMETIC</h2>
            <p>Aenean auctor nisl vitae auctor faucibus. Pellentesque
            imperdiet auctor eros,</p>
         </div> -->
        </div>

        <div class="text_box">
          <h2>sub title</h2>
          <h1>모이스쳐 라이징</h1>
          <p>Aenean auctor nisl vitae auctor faucibus. Pellentesque
            imperdiet auctor eros, sit amet ornare mauris malesu
            da in. Duis rutrum nisi tempus finibus luctus. Sed porta
            vel lacus quis lacinia. Vestibulum nec justo lectus. In
            hac habitasse platea dictumst. </p>
        </div>
      </li>

      <li class="right">
        <div class="text_box">
          <h2>sub title</h2>
          <h1>모이스쳐 향수</h1>
          <p>Aenean auctor nisl vitae auctor faucibus. Pellentesque
            imperdiet auctor eros, sit amet ornare mauris malesu
            da in. Duis rutrum nisi tempus finibus luctus. Sed porta
            vel lacus quis lacinia. Vestibulum nec justo lectus. In
            hac habitasse platea dictumst. </p>
        </div>
        <div class="photo02"><!--<div class="small"><strong>COLORFUL</strong> COSMETIC</div><p>Aenean auctor nisl vitae auctor faucibus. Pellentesque imperdiet auctor eros,</p>--></div>
      </li>

    </ul>
  </div>
</section>





<section class="tl_about_box_wrap clearfix">
  <div class="photo"></div>
  <div class="txt">
    <h3>basic skin care</h3>
    <h2>피부 본연의 <strong>생기 밸런스</strong>를 되찾다!</h2>
    <p>We, TongRo Image Stock, since commence with producing digital Image slide transparency business in 1992</p>
     <div class="more"><a href="#">더보기</a></div>
  </div>
</section>

<div class="idx_c">
  <?php if ($default['de_mobile_type1_list_use']) { ?>
    <div id="idx_new" class="sct_wrap">
      <!--   <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=1">베스트</a></h2>-->
      <?php
      $list = new item_list();
      $list->set_mobile(true);
      $list->set_type(1);
      $list->set_view('it_id', false);
      $list->set_view('it_name', true);
      $list->set_view('it_cust_price', true);
      $list->set_view('it_price', true);
      $list->set_view('it_1', true);
      $list->set_view('it_icon', true);
      $list->set_view('sns', true);
      echo $list->run();
      ?>
    </div>
  <?php } ?>
</div>




<section class="tl_center_banner_wrap">

</section>




<div class="idx_c">
  <?php if ($default['de_mobile_type3_list_use']) { ?>
    <div id="idx_new" class="sct_wrap">
      <!--<h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=3">최신상품<?= $default['de_mobile_type3_list_use'] ?></a></h2>-->
      <?php
      $list = new item_list();
      $list->set_mobile(true);
      $list->set_type(3);
      $list->set_view('it_id', false);
      $list->set_view('it_name', true);
      $list->set_view('it_cust_price', true);
      $list->set_view('it_1', true);
      $list->set_view('it_price', true);
      $list->set_view('it_icon', true);
      $list->set_view('sns', true);
      echo $list->run();
      ?>
    </div>
  <?php } ?>
</div>



<section class="tl_bottom_banner_wrap clearfix">
  <div class="inner clearfix">
    <div class="left"><a href="#">
        <h2>WINTER<br>COSMETICS</h2>
      </a></div>

    <div class="right">
      <div class="top"><a href="#">
          <h2>Water 미네랄 수분 크림</h2>
          <p>Aenean auctor nisl vitae auctor faucibus. ornare mauris malesuada in. Duis rutrum</p> <!--<div class="more"><a href="/">View more</a></div>-->
        </a></div>
      <div class="bottom"><a href="#">
          <div class="box01">
            <h2>Autumn Cosmetics</h2>
            <p>Aenean auctor</p>
          </div>
          <div class="box02">
            <h2>VEGAN<br>COSMETICS</h2>
        </a></div>
    </div>
</section>



<div class="idx_c" id="idx_tab">
  <ul class="tabs">
    <li class="tab-link current" data-tab="tab-1">히트상품</li>
    <li class="tab-link" data-tab="tab-2">추천상품</li>
    <li class="tab-link" data-tab="tab-3">할인상품</li>

  </ul>
  <?php if ($default['de_mobile_type1_list_use']) { ?>
    <div class="sct_wrap current" id="tab-1">
      <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=1">히트상품</a></h2>
      <?php
      $list = new item_list();
      $list->set_mobile(true);
      $list->set_type(1);
      $list->set_view('it_id', false);
      $list->set_view('it_name', true);
      $list->set_view('it_cust_price', true);
      $list->set_view('it_1', true);
      $list->set_view('it_price', true);
      $list->set_view('it_icon', false);
      $list->set_view('sns', true);
      echo $list->run();
      ?>
    </div>
  <?php } ?>




  <?php if ($default['de_mobile_type2_list_use']) { ?>
    <div class="sct_wrap" id="tab-2">
      <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=2">추천상품</a></h2>
      <?php
      $list = new item_list();
      $list->set_mobile(true);
      $list->set_type(2);
      $list->set_view('it_id', false);
      $list->set_view('it_name', true);
      $list->set_view('it_cust_price', true);
      $list->set_view('it_1', true);
      $list->set_view('it_price', true);
      $list->set_view('it_icon', false);
      $list->set_view('sns', true);
      echo $list->run();
      ?>
    </div>
  <?php } ?>



  <?php if ($default['de_mobile_type5_list_use']) { ?>
    <div class="sct_wrap" id="tab-3">
      <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=5">할인상품</a></h2>
      <?php
      $list = new item_list();
      $list->set_mobile(true);
      $list->set_type(5);
      $list->set_view('it_id', false);
      $list->set_view('it_name', true);
      $list->set_view('it_cust_price', true);
      $list->set_view('it_1', true);
      $list->set_view('it_price', true);
      $list->set_view('it_icon', false);
      $list->set_view('sns', true);
      echo $list->run();
      ?>
    </div>
  <?php } ?>

</div>









<!-- 메인리뷰-->
<?php
// 상품리뷰
$sql = " select a.is_id, a.is_subject, a.is_content, a.it_id, b.it_name
            from `{$g5['g5_shop_item_use_table']}` a join `{$g5['g5_shop_item_table']}` b on (a.it_id=b.it_id)
            where a.is_confirm = '1'
            order by a.is_id desc
            limit 0,5 ";
$result = sql_query($sql);

for ($i = 0; $row = sql_fetch_array($result); $i++) {
  if ($i == 0) {
    echo '<div id="idx_review">' . PHP_EOL;
    echo '<h2><a href="' . G5_SHOP_URL . '/itemuselist.php">상품후기</a></h2>' . PHP_EOL;
    echo '<div class="review">' . PHP_EOL;
  }

  $review_href = G5_SHOP_URL . '/item.php?it_id=' . $row['it_id'];
?>
  <div class="rv_li rv_<?php echo $i; ?>">
    <div class="li_wr">
      <div class="rv_hd">
        <a href="<?php echo $review_href; ?>" class="prd_img"><?php echo get_itemuselist_thumbnail($row['it_id'], $row['is_content'], 50, 50); ?></a>
        <span class="rv_tit"><?php echo get_text(cut_str($row['is_subject'], 20)); ?></span>
        <a href="<?php echo $review_href; ?>" class="rv_prd"><?php echo $row['it_name']; ?></a>
      </div>

      <p><?php echo get_text(cut_str(strip_tags($row['is_content']), 100), 1); ?></p>

    </div>
  </div>
<?php
}

if ($i > 0) {
  echo '</div>' . PHP_EOL;
  echo '</div>' . PHP_EOL;
}
?>



<script>
  //상품 탭
  $(document).ready(function() {

    $('ul.tabs li').click(function() {
      var tab_id = $(this).attr('data-tab');

      $('ul.tabs li').removeClass('current');
      $('.sct_wrap').removeClass('current');

      $(this).addClass('current');
      $("#" + tab_id).addClass('current');
    })

  })

  //후기
  $('.review').slick({
    dots: true,
    arrows: false,
    slidesToShow: 3,
    autoplay: true,
    autoplaySpeed: 200000,
    responsive: [{
        breakpoint: 970,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '20%',
          slidesToShow: 1
        }
      },
      {
        breakpoint: 670,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '10%',
          slidesToShow: 1
        }
      }
    ]
  });

  $("#container").removeClass("container").addClass("idx-container");
</script>

<?php
include_once(G5_THEME_MSHOP_PATH . '/shop.tail.php');
?>