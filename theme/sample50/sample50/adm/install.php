<?php
$sub_menu = "100000";
ini_set('memory_limit', '-1');
set_time_limit(20);
include_once('./_common.php');

$g5['title'] = '테마 설정';
include_once(G5_ADMIN_PATH . '/admin.head.php');
?>
<style>
  .alert {
    border: 1px solid #FCF;
    padding: 0.5em;
    margin-top: 5px;
    border-radius: 0.5em;
  }
</style>
<?php
if ($install === 'ok') {
  // 변경한 파일
  function recurse_copy($src, $dst)
  {
    $dir = opendir($src);
    if ($dir) {
      @mkdir($dst);
      while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
          if (is_dir($src . '/' . $file)) {
            recurse_copy($src . '/' . $file, $dst . '/' . $file);
          } else {
            @copy($src . '/' . $file, $dst . '/' . $file);
          }
        }
      }
      closedir($dir);
    }
  }

  // 부가환경설정 필드 추가
  if (!isset($config['cf_data'])) {
    sql_query(" ALTER TABLE `{$g5['config_table']}` ADD `cf_data` TEXT NOT NULL DEFAULT '' ", false);
    echo '<div class="alert">환경설정테이블에 부가환경설정필드(cf_data) 추가</div>';
  }

  // cf_title, cf_theme, 
  // cf_search_skin, cf_new_skin, cf_search_skin, cf_connect_skin, cf_faq_skin, cf_member_skin, 
  // cf_mobile_new_skin, cf_mobile_search_skin, cf_mobile_connect_skin, cf_mobile_faq_skin, cf_mobile_member_skin,
  // cf_data
  $n_config = unserialize(file_get_contents('./var_n_config.txt'));
  $sql_common = '';
  if (is_array($n_config)) {
    foreach ($n_config as $kk => $vv) {
      $sql_common .= "{$kk} = '" . sql_real_escape_string($vv) . "',";
    }
  }
  $sql_common = trim($sql_common, ',');
  $sql = " update {$g5['config_table']} set $sql_common ";
  sql_query($sql);
  echo '<div class="alert">환경설정 정보 추가</div>';

  //{{{ 기본게시판 생성
  $bo_tablem = unserialize(file_get_contents('./var_bo_tablem.txt'));

  $file = file(G5_PATH . '/adm/sql_write.sql');
  foreach ($bo_tablem as $bo_table => $row_board) {
    @mkdir(G5_DATA_PATH . '/file/' . $bo_table, G5_DIR_PERMISSION);
    $row = sql_fetch(" select count(*) as cnt from {$g5['board_table']} where bo_table = '{$bo_table}' ");

    $sql_common = '';
    if (is_array($row_board)) {
      foreach ($row_board as $kk => $vv) {
        $sql_common .= "{$kk} = '" . sql_real_escape_string($vv) . "',";
      }
    }

    $sql_common = trim($sql_common, ',');
    if ($row['cnt'] == 0) {
      $sql = " insert into {$g5['board_table']} set {$sql_common} ";
      sql_query($sql);

      // 게시판 테이블 생성
      $sql = implode("\n", $file);
      $create_table = $g5['write_prefix'] . $bo_table;

      // sql_board.sql 파일의 테이블명을 변환
      $source = array('/__TABLE_NAME__/', '/;/');
      $target = array($create_table, '');
      $sql = preg_replace($source, $target, $sql);
      sql_query($sql, FALSE);
    } else {
      $sql = " update {$g5['board_table']} set {$sql_common} where bo_table = '{$bo_table}'";
      sql_query($sql);
    }
  }
  //}}} 기본게시판 생성
  echo '<div class="alert">기본게시판 생성</div>';

  //{{{ 게시물 입력 
  $bo_board_data_sql = trim(file_get_contents('./var_bo_board_data.txt'));
  if ($bo_board_data_sql) {
    $tmps = explode(';;;--;;;', $bo_board_data_sql);
    foreach ($tmps as $k => $sql) {
      $sql = trim($sql);
      if (trim($sql) != '') sql_query($sql);
    }
  }
  //}}} 게시물 입력
  echo '<div class="alert">게시물 입력</div>';


  recurse_copy('./file', G5_DATA_PATH . '/file');
  recurse_copy('./editor', G5_DATA_PATH . '/editor');
  recurse_copy('./banner', G5_DATA_PATH . '/banner');
  recurse_copy('./item', G5_DATA_PATH . '/item');

  echo '<div class="alert">게시판 파일복사 데이타 입력</div>';


  sql_query("ALTER TABLE {$g5['g5_shop_banner_table']} ADD `bn_json` TEXT NOT NULL");
  echo '<div class="alert">배너 테이블 필드 추가</div>';

  //{{{ QnA 설정 입력 
  $sql = "DELETE FROM {$g5['qa_config_table']}";
  sql_query($sql);
  $qa_config_sql = trim(file_get_contents('./var_qa_config.txt'));
  if ($qa_config_sql) {
    $tmps = explode(';;;--;;;', $qa_config_sql);
    foreach ($tmps as $k => $sql) {
      $sql = trim($sql);
      if (trim($sql) != '') sql_query($sql);
    }
  }
  //}}} QnA 설정 입력
  echo '<div class="alert">QnA 설정 입력</div>';

  //{{{ 카테고리 입력 
  $shop_category_sql = trim(file_get_contents('./var_shop_category.txt'));
  if ($shop_category_sql) {
    $tmps = explode(';;;--;;;', $shop_category_sql);
    foreach ($tmps as $k => $sql) {
      $sql = trim($sql);
      if (trim($sql) != '') sql_query($sql);
    }
  }
  //}}} 카테고리 입력
  echo '<div class="alert">쇼핑몰 카테고리 입력</div>';

  //{{{ 샵 기본설정 입력 
  $sql = "DELETE FROM {$g5['g5_shop_default_table']}";
  sql_query($sql);
  $shop_default_sql = trim(file_get_contents('./var_shop_default.txt'));
  if ($shop_default_sql) {
    $tmps = explode(';;;--;;;', $shop_default_sql);
    foreach ($tmps as $k => $sql) {
      $sql = trim($sql);
      if (trim($sql) != '') sql_query($sql);
    }
  }
  //}}} 샵 기본설정 입력
  echo '<div class="alert">쇼핑몰 기본설정 입력</div>';

  //{{{ 쇼핑몰 아이템 입력 
  $shop_item_sql = trim(file_get_contents('./var_shop_item.txt'));
  if ($shop_item_sql) {
    $tmps = explode(';;;--;;;', $shop_item_sql);
    foreach ($tmps as $k => $sql) {
      $sql = trim($sql);
      if (trim($sql) != '') sql_query($sql);
    }
  }
  //}}} 쇼핑몰 아이템 입력
  echo '<div class="alert">쇼핑몰 아이템 입력</div>';

  //{{{ 쇼핑몰 답변필드 추가 
  $sql = "select * from {$g5['g5_shop_item_use_table']} limit 1";
  $item_use = sql_fetch($sql);
  if (!isset($item_use['is_reply_subject'])) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_item_use_table']}`
                                ADD COLUMN `is_reply_subject` VARCHAR(255) NOT NULL DEFAULT '' AFTER `is_confirm`,
                                ADD COLUMN `is_reply_content` TEXT NOT NULL AFTER `is_reply_subject`,
                                ADD COLUMN `is_reply_name` VARCHAR(25) NOT NULL DEFAULT '' AFTER `is_reply_content`
                                ", true);
  }
  //}}} 쇼핑몰 답변필드 추가 
  echo '<div class="alert">쇼핑몰 리뷰답변 추가</div>';

  //{{{ 쇼핑몰 리뷰 입력 
  $shop_item_use_sql = trim(file_get_contents('./var_shop_item_use.txt'));
  if ($shop_item_use_sql) {
    $tmps = explode(';;;--;;;', $shop_item_use_sql);
    foreach ($tmps as $k => $sql) {
      $sql = trim($sql);
      if (trim($sql) != '') sql_query($sql);
    }
  }
  //}}} 쇼핑몰 리뷰 입력
  echo '<div class="alert">쇼핑몰 리뷰 입력</div>';

    //{{{ 배너 데이터입력
  $shop_banner_sql = trim(file_get_contents('./var_shop_banners.txt'));
  if ($shop_banner_sql) {
    $tmps = explode(';;;--;;;', $shop_banner_sql);
    foreach ($tmps as $k => $sql) {
      $sql = trim($sql);
      if (trim($sql) != '') sql_query($sql, $SQL_ERROR_STOP);
    }
  }
  //}}} 배너 데이터입력

} else {
?>
  <button type="button" class="btn btn_submit" onclick="go_install()">테마 설치</button>
  <script>
    function go_install() {
      if (confirm("설치하시겠습니까?")) {
        location.href = 'install.php?install=ok';
      }
    }
  </script>
  <?php
}
include_once(G5_ADMIN_PATH . '/admin.tail.php');
  ?>`