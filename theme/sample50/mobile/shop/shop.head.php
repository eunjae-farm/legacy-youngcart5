<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH . '/head.sub.php');
include_once(G5_LIB_PATH . '/outlogin.lib.php');
include_once(G5_LIB_PATH . '/visit.lib.php');
include_once(G5_LIB_PATH . '/connect.lib.php');
include_once(G5_LIB_PATH . '/popular.lib.php');
include_once(G5_LIB_PATH . '/latest.lib.php');
add_stylesheet('<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard/dist/web/static/pretendard-dynamic-subset.css" />');
?>
<?php
tl_display_banner('상단', 'top_header');
?>


<header id="hd">
  <?php if ((!$bo_table || $w == 's') && defined('_INDEX_')) { ?><h1><?php echo $config['cf_title'] ?></h1><?php } ?>

  <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

  <?php if (defined('_INDEX_')) { // index에서만 실행
    include G5_MOBILE_PATH . '/newwin.inc.php'; // 팝업레이어
  } ?>

  <div id="cate_head">
    <div class="btn_login">

      <div class="btn_left"><a href="<?php echo G5_SHOP_URL; ?>/mypage.php"><i class="fa fa-user"></i>마이페이지</a>
        <a href="<?php echo G5_BBS_URL; ?>/faq.php"><i class="fa fa-question-circle-o"></i>FAQ</a>
        <a href="<?php echo G5_BBS_URL; ?>/qalist.php"><i class="fa fa-comments-o"></i>1:1문의</a>
        <a href="<?php echo G5_SHOP_URL; ?>/itemuselist.php"><i class="fa fa-camera"></i>사용후기</a>
        <a href="<?php echo G5_SHOP_URL; ?>/couponzone.php"><i class="fa fa-gift"></i>쿠폰존</a>
      </div>
      <?php if ($is_member) { ?>
        <div class="btn_right pc_only">
          <a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php"><?php echo get_member_profile_img($member['mb_id']); ?><span class="txt"><?php echo $member['mb_id'] ?> 님 </span></a>
          <a href="<?php echo G5_BBS_URL ?>/memo.php" target="_blank" class="win_scrap">
            <i class="fa fa-envelope-o"></i> 쪽지
            <strong><span><?php echo $memo_not_read ?></span></strong>
          </a>
          <a href="<?php echo G5_SHOP_URL; ?>/cart.php"><i class="fa fa-shopping-cart"></i><span> 장바구니</span> <span class="cart-count-"><?php echo get_boxcart_datas_count(); ?></span></a>
          <a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop">로그아웃</a>
        <?php } else { ?>
          <div class="btn_right pc_only">
            <a href="<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo $urlencode; ?>">로그인</a>
            <a href="<?php echo G5_BBS_URL; ?>/register.php" class="btn_ol">회원가입</a>
            <a href="<?php echo G5_SHOP_URL; ?>/cart.php" id="btn_cartop pc_only"><i class="fa fa-shopping-cart"></i><span> 장바구니</span><span class="cart-count-"><?php echo get_boxcart_datas_count(); ?></span></a>
          <?php } ?>


          </div>
        </div>

    </div>
    <div id="cate_mid">
      <div id="mid_logo"><a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?= G5_THEME_URL ?>/img/logo.png" alt="<?php echo $config['cf_title']; ?> 메인"></a></div>

      <div class="hd_sch_wr pc_only">
        <form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">

          <div class="sch_inner">
            <!-- <h2>상품 검색</h2> -->
            <label for="sch_str2" class="sound_only">상품명<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str2" required placeholder="검색어를 입력해주세요">
            <button type="submit" class="sch_submit"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only"> 검색</span></button>
          </div>
        </form>
        <!-- <?php
              $save_file = G5_DATA_PATH . '/cache/theme/jelly/keyword.php';
              if (is_file($save_file))
                include($save_file);

              if (!empty($keyword)) {
              ?>
          <div id="ppl_word">
            <h3>인기검색어</h3>
            <ol class="slides">
              <?php
                $seq = 1;
                foreach ($keyword as $word) {
              ?>
                <li><a href="<?php echo G5_SHOP_URL; ?>/search.php?q=<?php echo urlencode($word); ?>"><?php echo get_text($word); ?></a></li>
              <?php
                  $seq++;
                }
              ?>
            </ol>
          </div>
        <?php } ?> -->
      </div>
    </div>








    <style>
      #cate_head {
        height: auto;
        padding: 10px 0 50px 0;
        position: relative;
        margin: 0 auto;
      }

      #cate_head .btn_login {
        width: 100%;
      }

      #cate_head .btn_login .btn_right {
        float: right;
      }

      #cate_head .btn_login .btn_left {
        float: left;
      }

      #cate_head .btn_login .btn_left .fa {
        margin-right: 3px
      }

      #cate_mid {
        height: auto;
        max-width: 1400px;
        padding: 20px 15px 0px 15px;
        position: relative;
        margin: 0 auto;

      }

      #cate_mid #mid_logo {
        position: relative;
        height: 80px;
        width: 205px
      }

      #cate_mid #mid_logo img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 999;
      }

      @media all and (max-width: 576px) {
        #cate_mid #mid_logo {
          position: relative;
          height: 41px;
          width: 105px
        }
      }


      #cate_mid .hd_sch_wr {
        width: 500px;
        margin: 0 auto;
        color: #000;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
      }

      #cate_mid .sch_submit {
        position: absolute;
        top: 0;
        left: 0;
        height: 50px;
        border: 0;
        cursor: pointer;
        background: transparent;
        font-weight: 600;
        /* color: #fff; */
        width: 50px;
        font-size: 16px;
      }

      #cate_mid #sch_str2 {
        background: transparent;
        border: 0;
        border-bottom: 2px solid #000;
        color: #000;
        width: 100%;
        height: 50px;
        padding-left: 50px;
        font-size: 16px;
        outline: none;
      }

      #btn_cartop .cart-count- {
        font-size: 12px;
        padding: 0 5px;
      }
    </style>
    <div id="hd_wr">

      <?php include_once(G5_THEME_MSHOP_PATH . '/category.php'); // 분류 
      ?>
      <div id="hd_sch">
        <button type="button" class="btn_close"><i class="fa fa-times"></i></button>
        <div class="hd_sch_wr">
          <form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">

            <div class="sch_inner">
              <h2>상품 검색</h2>
              <label for="sch_str" class="sound_only">상품명<strong class="sound_only"> 필수</strong></label>
              <input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str" required placeholder="검색어를 입력해주세요">
              <button type="submit" class="sch_submit"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only"> 검색</span></button>
            </div>
          </form>
          <?php
          $save_file = G5_DATA_PATH . '/cache/theme/jelly/keyword.php';
          if (is_file($save_file))
            include($save_file);

          if (!empty($keyword)) {
          ?>
            <div id="ppl_word">
              <h3>인기검색어</h3>
              <ol class="slides">
                <?php
                $seq = 1;
                foreach ($keyword as $word) {
                ?>
                  <li><a href="<?php echo G5_SHOP_URL; ?>/search.php?q=<?php echo urlencode($word); ?>"><?php echo get_text($word); ?></a></li>
                <?php
                  $seq++;
                }
                ?>
              </ol>
            </div>
          <?php } ?>
        </div>
      </div>
      <div id="hd_btn">

        <button type="button" id="btn_cate"><i class="fa fa-bars"></i><span class="sound_only">분류열기</span></button>
        <button type="button" id="btn_sch"><i class="fa fa-search"></i><span class="sound_only">검색열기</span></button>
        <a href="<?php echo G5_SHOP_URL; ?>/cart.php" id="btn_cartop"><i class="fa fa-shopping-cart"></i><span class="sound_only">장바구니</span><span class="cart-count"><?php echo get_boxcart_datas_count(); ?></span></a>
      </div>
    </div>

    <script>
      function search_submit(f) {
        if (f.q.value.length < 2) {
          alert("검색어는 두글자 이상 입력하십시오.");
          f.q.select();
          f.q.focus();
          return false;
        }

        return true;
      }
    </script>

  </div>

  <style>
    #hd_btn {
      display: none;
    }

    .m_btn_login {
      display: none;
    }

    @media (max-width: 969px) {

      #hd_btn,
      .m_btn_login {
        display: block;
        z-index: 999;
      }

      .m_btn_login {
        background: #fff;
        padding: 0 10px;
      }

      .m_btn_login .btn_ol {
        line-height: 55px;
        height: 55px;
        border: 0;
        background: none;
        color: #717989;
        padding: 0 10px;
        position: relative;
      }

      .hd_sch_wr.pc_only {
        display: none;
      }

      .btn_login .btn_right {
        display: none;
      }

      #cate_mid {

        bottom: -40px;
        padding: 0px 15px 0px 15px;
      }

      #cate_head {
        padding: 15px 0 0 0;
      }

      #cate_head .btn_login .btn_left {
        width: 100%;
        display: flex;
        justify-content: space-around;
      }
    }
  </style>

<?php if ($is_admin) { ?>
    <?php if ($member['user_type'] == '판매자') { ?>
        <div class="hd_admin"><a href="<?php echo G5_SELLER_URL; ?>" target="_blank">판매자</a></div>
    <?php } elseif ($member['user_type'] == '최고관리자') { ?>
        <div class="hd_admin"><a href="<?php echo G5_ADMIN_URL; ?>" target="_blank">관리자</a> <a
                href="<?php echo G5_THEME_ADM_URL ?>" target="_blank">테마관리</a></div>
    <?php } ?>
<?php } ?>

  <script>
    $(document).ready(function() {
      var jbOffset = $('#hd_wr').offset();
      $(window).scroll(function() {
        if ($(document).scrollTop() > jbOffset.top) {
          $('#hd_wr').addClass('fixed');
        } else {
          $('#hd_wr').removeClass('fixed');
        }
      });
    });

    $("#btn_cate").on("click", function() {
      $("#category").show();
    });

    $(".menu_close").on("click", function() {
      $(".menu").hide();
    });
    $(".cate_bg").on("click", function() {
      $(".menu").hide();
    });

    $(".btn_ol").on("click", function() {
      $(".ol").show();
    });

    $(".ol .btn_close").on("click", function() {
      $(".ol").hide();
    });

    $("#btn_sch").on("click", function() {
      $("#hd_sch").show();
    });

    $("#hd_sch .btn_close").on("click", function() {
      $("#hd_sch").hide();
    });
  </script>
</header>



<div id="side_menu">
	<ul id="quick">
		<li><button class="btn_sm_cl1 btn_sm"><i class="fa fa-user-o" aria-hidden="true"></i><span class="qk_tit">마이메뉴</span></button></li>
		<li><button class="btn_sm_cl2 btn_sm"><i class="fa fa-archive" aria-hidden="true"></i><span class="qk_tit">오늘 본 상품</span></button></li>
		<li><button class="btn_sm_cl3 btn_sm"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="qk_tit">장바구니</span></button></li>
		<li><button class="btn_sm_cl4 btn_sm"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="qk_tit">위시리스트</span></button></li>
    </ul>
    <button type="button" id="top_btn"><i class="fa fa-arrow-up" aria-hidden="true"></i><span class="sound_only">상단으로</span></button>
    <div id="tabs_con">
	    <div class="side_mn_wr1 qk_con">
	    	<div class="qk_con_wr">
	    		<?php echo outlogin('theme/shop_side'); // 아웃로그인 ?>
		        <ul class="side_tnb">
		        	<?php if ($is_member) { ?>
					<li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">마이페이지</a></li>
		            <?php } ?>
					<li><a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php">주문내역</a></li>
					<li><a href="<?php echo G5_BBS_URL ?>/faq.php">FAQ</a></li>
		            <li><a href="<?php echo G5_BBS_URL ?>/qalist.php">1:1문의</a></li>
		            <li><a href="<?php echo G5_SHOP_URL ?>/personalpay.php">개인결제</a></li>
		            <li><a href="<?php echo G5_SHOP_URL ?>/itemuselist.php">사용후기</a></li>
		            <li><a href="<?php echo G5_SHOP_URL ?>/itemqalist.php">상품문의</a></li>
		            <li><a href="<?php echo G5_SHOP_URL; ?>/couponzone.php">쿠폰존</a></li>
		        </ul>
	        	<?php // include_once(G5_SHOP_SKIN_PATH.'/boxcommunity.skin.php'); // 커뮤니티 ?>
	    		<button type="button" class="con_close"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="sound_only">나의정보 닫기</span></button>
	    	</div>
	    </div>
	    <div class="side_mn_wr2 qk_con">
	    	<div class="qk_con_wr">
	        	<?php include(G5_SHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?>
	    		<button type="button" class="con_close"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="sound_only">오늘 본 상품 닫기</span></button>
	    	</div>
	    </div>
	    <div class="side_mn_wr3 qk_con">
	    	<div class="qk_con_wr">
	        	<?php include_once(G5_SHOP_SKIN_PATH.'/boxcart.skin.php'); // 장바구니 ?>
	    		<button type="button" class="con_close"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="sound_only">장바구니 닫기</span></button>
	    	</div>
	    </div>
	    <div class="side_mn_wr4 qk_con">
	    	<div class="qk_con_wr">
	        	<?php include_once(G5_SHOP_SKIN_PATH.'/boxwish.skin.php'); // 위시리스트 ?>
	    		<button type="button" class="con_close"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="sound_only">위시리스트 닫기</span></button>
	    	</div>
	    </div>
    </div>
</div>
<script>
jQuery(function ($){
	$(".btn_member_mn").on("click", function() {
        $(".member_mn").toggle();
        $(".btn_member_mn").toggleClass("btn_member_mn_on");
    });
    
    var active_class = "btn_sm_on",
        side_btn_el = "#quick .btn_sm",
        quick_container = ".qk_con";

    $(document).on("click", side_btn_el, function(e){
        e.preventDefault();

        var $this = $(this);
        
        if (!$this.hasClass(active_class)) {
            $(side_btn_el).removeClass(active_class);
            $this.addClass(active_class);
        }

        if( $this.hasClass("btn_sm_cl1") ){
            $(".side_mn_wr1").show();
        } else if( $this.hasClass("btn_sm_cl2") ){
            $(".side_mn_wr2").show();
        } else if( $this.hasClass("btn_sm_cl3") ){
            $(".side_mn_wr3").show();
        } else if( $this.hasClass("btn_sm_cl4") ){
            $(".side_mn_wr4").show();
        }
    }).on("click", ".con_close", function(e){
        $(quick_container).hide();
        $(side_btn_el).removeClass(active_class);
    });

    $(document).mouseup(function (e){
        var container = $(quick_container),
            mn_container = $(".shop_login");
        if( container.has(e.target).length === 0){
            container.hide();
            $(side_btn_el).removeClass(active_class);
        }
        if( mn_container.has(e.target).length === 0){
            $(".member_mn").hide();
            $(".btn_member_mn").removeClass("btn_member_mn_on");
        }
    });

    $("#top_btn").on("click", function() {
        $("html, body").animate({scrollTop:0}, '500');
        return false;
    });
});
</script>

<div id="container" class="container">
  <?php if (!defined('_INDEX_')) { ?><h1 id="container_title"><?php echo $g5['title'] ?></h1><?php } ?>