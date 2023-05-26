<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
add_javascript('<script src="'.G5_THEME_JS_URL.'/shop.list.action.js"></script>', 10);
add_javascript('<script src="' . G5_MSHOP_SKIN_URL . '/script.js"></script>', 0);
?>

<script src="<?php echo G5_JS_URL ?>/jquery.fancylist.js"></script>
<?php if($config['cf_kakao_js_apikey']) { ?>
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
<script src="<?php echo G5_JS_URL; ?>/kakaolink.js"></script>
<script>
    // 사용할 앱의 Javascript 키를 설정해 주세요.
    Kakao.init("<?php echo $config['cf_kakao_js_apikey']; ?>");
</script>
<?php } ?>

<!-- 메인상품진열 20 시작 { -->
<?php
$li_width = intval(100 / $this->list_mod);
$li_width_style = ' style="width:'.$li_width.'%;"';

for ($i=0; $row=sql_fetch_array($result); $i++) {
    if ($i == 0) {
        if ($this->css) {
            echo "<ul class=\"{$this->css}\">\n";
        } else {
            echo "<ul class=\"sct smt_20\">\n";
        }
    }

    if($i % $this->list_mod == 0)
        $li_clear = ' sct_clear';
    else
        $li_clear = '';

    echo "<li class=\"sct_li{$li_clear}\">\n";
    echo "<div class=\"li_wr main20skin\">\n";
     echo "<div class=\"sct_img\">\n";

    if ($this->href) {
        echo "<a href=\"{$this->href}{$row['it_id']}\">\n";
    }

    if ($this->view_it_img) {
        echo get_it_image3($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']))."\n";
    }

    if ($this->href) {
        echo "</a>\n";
    }
    echo "<div class=\"sct_btn\">
    <button type=\"button\" style=\"position:absolute;z-index:999;bottom: 15px;right: 50px; \" class=\"btn_cart sct_cart\" data-it_id=\"{$row['it_id']}\"><i class=\"fa fa-shopping-cart\" aria-hidden=\"true\"></i><span class=\"sound_only\">장바구니</span></button>\n";
echo "</div>\n";

echo "<div class=\"cart-layer\"></div>\n";
    // echo "<button type=\"button\" class=\"btn_wish\" data-it_id=\"{$row['it_id']}\"><span class=\"sound_only\">위시리스트</span><i class=\"fa fa-heart-o\" aria-hidden=\"true\"></i></button>\n";
    $in_wish = '';
    $my_wish = get_wishlist_datas($member['mb_id']);
    if(array_key_exists($row['it_id'], $my_wish)){
        $in_wish = 'style_class';
    }

    echo "<button type=\"button\" class=\"btn_wish {$in_wish}\" data-it_id=\"{$row['it_id']}\" ><span class=\"sound_only\">위시리스트</span><i class=\"fa fa-heart-o\" aria-hidden=\"true\"></i>
        </button>\n"

        ;
        if ($this->view_sns) {
            echo "<button type=\"button\" class=\"btn_share\"><span class=\"sound_only\">공유하기</span><i class=\"fa fa-share-alt\" aria-hidden=\"true\"></i></button>\n";
         }
         echo "<div class=\"sct_sns_wrap\">";
         if ($this->view_sns) {
             $sns_top = $this->img_height + 10;
             $sns_url  = $item_link_href;
             $sns_title = get_text($row['it_name']).' | '.get_text($config['cf_title']);
             echo "<div class=\"sct_sns\">";
             echo "<h3>SNS 공유</h3>";
             echo get_sns_share_link('facebook', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/facebook.png');
             echo get_sns_share_link('twitter', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/twitter.png');
             echo get_sns_share_link('googleplus', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/gplus.png');
             echo get_sns_share_link('kakaotalk', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/sns_kakao.png');
             echo "<button type=\"button\" class=\"sct_sns_cls\"><span class=\"sound_only\">닫기</span><i class=\"fa fa-times\" aria-hidden=\"true\"></i></button>";
             echo "</div>\n";
         }
         echo "<div class=\"sct_sns_bg\"></div>";
         echo "</div>\n";
 
    echo "</div>\n";

     echo "<div class=\"sct_txt_wr\">\n";

    if ($this->view_it_id) {
        echo "<div class=\"sct_id\">&lt;".stripslashes($row['it_id'])."&gt;</div>\n";
    }

    if ($this->href) {
        echo "<a href=\"{$this->href}{$row['it_id']}\" class=\"sct_txt\">\n";
    }

    if ($this->view_it_name) {
        echo stripslashes($row['it_name'])."\n";
    }

    if ($this->href) {
        echo "</a>\n";
    }

    if ($this->view_it_basic) {
        echo "<div class=\"sct_sub_txt\">".get_text($row['it_basic'])."</div>\n";
    }


    if ($this->view_it_cust_price || $this->view_it_price) {

        echo "<div class=\"sct_cost\">\n";

        if ($this->view_it_cust_price && $row['it_cust_price']) {
            echo "<span class=\"sct_discount\">".display_price($row['it_cust_price'])."</span>\n";
        }

        if ($this->view_it_price) {
            echo display_price(get_price($row), $row['it_tel_inq'])."\n";
        }

        echo "</div>\n";

    }
     if ($this->view_it_icon) {
        echo item_icon2($row);
    }


    // if ($this->view_sns) {
    //     $sns_top = $this->img_height + 10;
    //     $sns_url  = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];
    //     $sns_title = get_text($row['it_name']).' | '.get_text($config['cf_title']);
    //     echo "<div class=\"sct_sns\" style=\"top:{$sns_top}px\">";
    //     echo get_sns_share_link('facebook', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/facebook.png');
    //     echo get_sns_share_link('twitter', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/twitter.png');
    //     echo get_sns_share_link('googleplus', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/gplus.png');
    //     echo get_sns_share_link('kakaotalk', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/sns_kakao.png');
    //     echo "</div>\n";
    // }
    
    $s_core  =  (int)$row['it_use_avg']; 
    if ($s_core > 0 ) { 
        echo "<span class=\"sct_star\"><img src=".G5_SHOP_URL."/img/s_star".$s_core.".png></span>"; 
    } 
    echo "</div>\n";


    echo "</div>\n";
    echo "</li>\n";
}

if ($i > 0) echo "</ul>\n";

if($i == 0) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>\n";
?>
<!-- } 상품진열 20 끝 -->

<script>


//SNS 공유
$(function (){
    $('.main20skin .sct_img').mouseenter(function(e) {
		var $img_wrap = $(this);
		var $img = $(this).find('img[data-over_img]');
		if ($img.length > 0) {
			$img.attr('src', $img.data('over_img'));
		}
	});
	$('.main20skin .sct_img').mouseleave(function(e) {
		var $img_wrap = $(this);
		var $img = $(this).find('img[data-ori_img]');
		if ($img.length > 0) {
			$img.attr('src', $img.data('ori_img'));
		}
	});
});			
</script>