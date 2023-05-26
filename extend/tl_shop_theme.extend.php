<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (!defined('G5_USE_SHOP') || !G5_USE_SHOP) return;

//{{{배너관리자 custom--------------------
add_event('admin_common', 'tl_add_bannerform', 10, 0);
function tl_add_bannerform()
{
  if (!defined('TL_SHOP_HOOK')) return; //[theme]/theme.config.php 에 정의

  global $amenu, $menu, $w, $auth_menu, $is_admin, $auth, $g5, $sub_menu, $config;
  if ($is_admin && $_SERVER['SCRIPT_FILENAME'] == G5_ADMIN_PATH . '/shop_admin/bannerform.php') {
    include(G5_THEME_PATH . '/bannerform_ex.php');
    exit;
  }
}

add_event('admin_common', 'tl_add_bannerlist', 10, 0);
function tl_add_bannerlist()
{
  if (!defined('TL_SHOP_HOOK')) return; //[theme]/theme.config.php 에 정의

  global $amenu, $menu, $auth_menu, $is_admin, $auth, $g5, $sub_menu, $config;
  if ($is_admin && $_SERVER['SCRIPT_FILENAME'] == G5_ADMIN_PATH . '/shop_admin/bannerlist.php') {
    include(G5_THEME_PATH . '/bannerlist_ex.php');
    exit;
  }
}


add_event('admin_common', 'tl_bannerformupdate', 10, 0);
function tl_bannerformupdate()
{
  if (!defined('TL_SHOP_HOOK')) return; //[theme]/theme.config.php 에 정의
  global $auth, $sub_menu, $w, $config, $g5;
  if ($_SERVER['SCRIPT_FILENAME'] == G5_ADMIN_PATH . '/shop_admin/bannerformupdate.php') {
    include(G5_THEME_PATH . '/bannerformupdate_ex.php');
    exit;
  }
}
//}}}배너관리자 custom--------------------

// 배너출력
function tl_display_banner($position, $skin = 'top_header', $device = 'both', $options=array())
{
  global $g5, $is_admin;
  $banner_skin_path = G5_THEME_PATH . '/banner/' . $skin;
  $banner_skin_url = G5_THEME_URL . '/banner/' . $skin;

  if (!$position) $position = '상단';
  $skin_file = $banner_skin_path . '/banner.skin.php';

  if (file_exists($skin_file)) {
    // 접속기기
    $sql_device = " and ( bn_device = 'both' or bn_device = 'pc' ) ";
    if ($device == 'mobile')
      $sql_device = " and ( bn_device = 'both' or bn_device = 'mobile' ) ";

    // 배너 출력
    $sql = " select * from {$g5['g5_shop_banner_table']} where '" . G5_TIME_YMDHIS . "' between bn_begin_time and bn_end_time $sql_device and bn_position = '$position' order by bn_order, bn_id desc ";
	$result = sql_query($sql);
    while ($row = sql_fetch_array($result)) {
      if(isset($row['bn_json']) && $row['bn_json']) {
        $bn_json = json_decode($row['bn_json'], true);
        $row['bn_bg'] = $bn_json['bg'];
        $row['bn_img_title'] = $bn_json['img_title'];
        $row['bn_img_subtitle'] = $bn_json['img_subtitle'];
      } else {
        $row['bn_bg'] = '';
        $row['bn_img_title'] = '';
        $row['bn_img_subtitle'] = '';
      }
      $banners[] = $row;
    }
    include($skin_file);
  } else {
    echo '<p>' . str_replace(G5_PATH . '/', '', $skin_path) . '파일이 존재하지 않습니다.</p>';
  }
}


function tl_banner_adm_link($position)
{
  return G5_ADMIN_URL . '/shop_admin/bannerlist.php?bn_position=' . urlencode($position);
}
