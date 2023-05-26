<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

check_demo();

$w = isset($_REQUEST['w']) ? $_REQUEST['w'] : '';

auth_check_menu($auth, $sub_menu, "w");

$bn_id = isset($_REQUEST['bn_id']) ? preg_replace('/[^0-9]/', '', $_REQUEST['bn_id']) : 0;
$bn = array(
  'bn_id' => 0,
  'bn_alt' => '',
  'bn_device' => '',
  'bn_position' => '',
  'bn_border' => '',
  'bn_new_win' => '',
  'bn_order' => '',
  'bn_bg'=>'',
  'bn_img_title'=>'',
  'bn_img_subtitle'=>'',
);

$html_title = '배너';
$g5['title'] = $html_title . '관리';

if ($w == "u") {
  $html_title .= ' 수정';
  $sql = " select * from {$g5['g5_shop_banner_table']} where bn_id = '$bn_id' ";
  $bn = sql_fetch($sql);
  if(isset($bn['bn_json']) && $bn['bn_json']) {
    $bn_json = json_decode($bn['bn_json'], true);
    if(isset($bn_json['bg']) && $bn_json['bg']) $bn['bn_bg'] = $bn_json['bg'];
    if(isset($bn_json['img_title']) && $bn_json['img_title']) $bn['bn_img_title'] = $bn_json['img_title'];
    if(isset($bn_json['img_subtitle']) && $bn_json['img_subtitle']) $bn['bn_img_subtitle'] = $bn_json['img_subtitle'];
  }

} else {
  $html_title .= ' 입력';
  $bn['bn_url']        = "http://";
  $bn['bn_begin_time'] = date("Y-m-d 00:00:00", time());
  $bn['bn_end_time']   = date("Y-m-d 00:00:00", time() + (60 * 60 * 24 * 31));
}

// 접속기기 필드 추가
if (!sql_query(" select bn_device from {$g5['g5_shop_banner_table']} limit 0, 1 ")) {
  sql_query(" ALTER TABLE `{$g5['g5_shop_banner_table']}`
                    ADD `bn_device` varchar(10) not null default '' AFTER `bn_url` ", true);
  sql_query(" update {$g5['g5_shop_banner_table']} set bn_device = 'pc' ", true);
}

include_once(G5_ADMIN_PATH . '/admin.head.php');
?>

<form name="fbanner" action="./bannerformupdate.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="w" value="<?php echo $w; ?>">
  <input type="hidden" name="bn_id" value="<?php echo $bn_id; ?>">

  <div class="tbl_frm01 tbl_wrap">
    <table>
      <caption><?php echo $g5['title']; ?></caption>
      <colgroup>
        <col class="grid_4">
        <col>
      </colgroup>
      <tbody>
        <tr>
          <th scope="row">이미지</th>
          <td>
            <input type="file" name="bn_bimg">
            <?php
            $bimg_str = "";
            $bimg = G5_DATA_PATH . "/banner/{$bn['bn_id']}";
            if (file_exists($bimg) && $bn['bn_id']) {
              $size = @getimagesize($bimg);
              if ($size[0] && $size[0] > 750)
                $width = 750;
              else
                $width = $size[0];

              echo '<input type="checkbox" name="bn_bimg_del" value="1" id="bn_bimg_del"> <label for="bn_bimg_del">삭제</label>';
              $bimg_str = '<img src="' . G5_DATA_URL . '/banner/' . $bn['bn_id'] . '" width="' . $width . '">';
            }
            if ($bimg_str) {
              echo '<div class="banner_or_img">';
              echo $bimg_str;
              echo '</div>';
            }
            ?>
            <hr style="border-top:1px solid #ccc; margin:10px;">
            <?php //echo help("반응형에 적용될 이미지가 필요할 때 입력하세요."); ?>
            <input type="file" name="bn_bimg_mobile">
            <?php
            $bimg_str_mobile = "";
            $bimg_mobile = G5_DATA_PATH . "/banner/mobile/{$bn['bn_id']}";
            if (file_exists($bimg_mobile) && $bn['bn_id']) {
              $size = @getimagesize($bimg_mobile);
              if ($size[0] && $size[0] > 750)
                $width = 750;
              else
                $width = $size[0];

              echo '<input type="checkbox" name="bn_bimg_mobile_del" value="1" id="bn_bimg_mobile_del"> <label for="bn_bimg_mobile_del">삭제</label>';
              $bimg_str_mobile = '<img src="' . G5_DATA_URL . '/banner/mobile/' . $bn['bn_id'] . '" width="' . $width . '">';
            }
            if ($bimg_str_mobile) {
              echo '<div class="banner_or_img">';
              echo $bimg_str_mobile;
              echo '</div>';
            }
            ?>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="bn_bg">이미지 배경색상</label></th>
          <td>
            <?php echo help("이미지에 배경색상이 필요할 때 입력합니다."); ?>
            <input type="color" name="bn_bg" value="<?php echo get_text($bn['bn_bg']); ?>" id="bn_bg" class="frm_input">
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="bn_alt">이미지 설명</label></th>
          <td>
            <?php echo help("img 태그의 alt, title 에 해당되는 내용입니다.\n배너에 마우스를 오버하면 이미지의 설명이 나옵니다."); ?>
            <input type="text" name="bn_alt" value="<?php echo get_text($bn['bn_alt']); ?>" id="bn_alt" class="frm_input" size="80">
          </td>
        </tr>

        <tr>
          <th scope="row"><label for="bn_img_title">메인 이미지 제목</label></th>
          <td>
            <?php echo help("메인 이미지 제목"); ?>
            <input type="text" name="bn_img_title" value="<?php echo get_text($bn['bn_img_title']); ?>" id="bn_img_title" class="frm_input" size="80">
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="bn_img_subtitle">메인 이미지 서버 제목</label></th>
          <td>
            <?php echo help("메인 이미지 서버제목"); ?>
            <input type="text" name="bn_img_subtitle" value="<?php echo get_text($bn['bn_img_subtitle']); ?>" id="bn_img_subtitle" class="frm_input" size="80">
          </td>
        </tr>


        <tr>
          <th scope="row"><label for="bn_url">링크</label></th>
          <td>
            <?php echo help("배너클릭시 이동하는 주소입니다."); ?>
            <input type="text" name="bn_url" size="80" value="<?php echo get_sanitize_input($bn['bn_url']); ?>" id="bn_url" class="frm_input">
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="bn_device">접속기기</label></th>
          <td>
            <?php echo help('배너를 표시할 접속기기를 선택합니다.'); ?>
            <select name="bn_device" id="bn_device">
              <option value="both" <?php echo get_selected($bn['bn_device'], 'both', true); ?>>PC와 모바일</option>
              <option value="pc" <?php echo get_selected($bn['bn_device'], 'pc'); ?>>PC</option>
              <option value="mobile" <?php echo get_selected($bn['bn_device'], 'mobile'); ?>>모바일</option>
            </select>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="bn_position">출력위치</label></th>
          <td>
            <?php echo help("왼쪽 : 쇼핑몰화면 왼쪽에 출력합니다.\n메인 : 쇼핑몰 메인화면(index.php)에만 출력합니다."); ?>
            <select name="bn_position" id="bn_position">
              <option value="왼쪽" <?php echo get_selected($bn['bn_position'], '왼쪽'); ?>>왼쪽</option>
              <option value="메인" <?php echo get_selected($bn['bn_position'], '메인'); ?>>메인</option>
              <option value="상단" <?php echo get_selected($bn['bn_position'], '상단'); ?>>상단</option>
            </select>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="bn_border">테두리</label></th>
          <td>
            <?php echo help("배너이미지에 테두리를 넣을지를 설정합니다.", 50); ?>
            <select name="bn_border" id="bn_border">
              <option value="0" <?php echo get_selected($bn['bn_border'], 0); ?>>사용안함</option>
              <option value="1" <?php echo get_selected($bn['bn_border'], 1); ?>>사용</option>
            </select>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="bn_new_win">새창</label></th>
          <td>
            <?php echo help("배너클릭시 새창을 띄울지를 설정합니다.", 50); ?>
            <select name="bn_new_win" id="bn_new_win">
              <option value="0" <?php echo get_selected($bn['bn_new_win'], 0); ?>>사용안함</option>
              <option value="1" <?php echo get_selected($bn['bn_new_win'], 1); ?>>사용</option>
            </select>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="bn_begin_time">시작일시</label></th>
          <td>
            <?php echo help("배너 게시 시작일시를 설정합니다."); ?>
            <input type="text" name="bn_begin_time" value="<?php echo $bn['bn_begin_time']; ?>" id="bn_begin_time" class="frm_input" size="21" maxlength="19">
            <input type="checkbox" name="bn_begin_chk" value="<?php echo date("Y-m-d 00:00:00", time()); ?>" id="bn_begin_chk" onclick="if (this.checked == true) this.form.bn_begin_time.value=this.form.bn_begin_chk.value; else this.form.bn_begin_time.value = this.form.bn_begin_time.defaultValue;">
            <label for="bn_begin_chk">오늘</label>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="bn_end_time">종료일시</label></th>
          <td>
            <?php echo help("배너 게시 종료일시를 설정합니다."); ?>
            <input type="text" name="bn_end_time" value="<?php echo $bn['bn_end_time']; ?>" id="bn_end_time" class="frm_input" size=21 maxlength=19>
            <input type="checkbox" name="bn_end_chk" value="<?php echo date("Y-m-d 23:59:59", time() + 60 * 60 * 24 * 31); ?>" id="bn_end_chk" onclick="if (this.checked == true) this.form.bn_end_time.value=this.form.bn_end_chk.value; else this.form.bn_end_time.value = this.form.bn_end_time.defaultValue;">
            <label for="bn_end_chk">오늘+31일</label>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="bn_order">출력 순서</label></th>
          <td>
            <?php echo help("배너를 출력할 때 순서를 정합니다. 숫자가 작을수록 먼저 출력됩니다."); ?>
            <?php echo order_select("bn_order", $bn['bn_order']); ?>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="btn_fixed_top">
    <a href="./bannerlist.php" class="btn_02 btn">목록</a>
    <input type="submit" value="확인" class="btn_submit btn" accesskey="s">
  </div>

</form>

<?php
include_once(G5_ADMIN_PATH . '/admin.tail.php');
