<?php
include_once('./_common.php');

$g5['title'] = '마이페이지';

include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');

?>
<div id="smb_my">

    <section id="smb_my_ov">
        <h2>회원정보 개요</h2>
        <div class="hello_name">
            <div class="my_img">
                <?php echo get_member_profile_img($member['mb_id']); ?>
                <a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php" class="btn_edit">EDIT</a>
            </div>
            <div class="my_name">
                <strong><?php echo $member['mb_id'] ? $member['mb_name'] : '비회원'; ?></strong>님
            </div>
            <a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=member_leave.php" onclick="return member_leave();" class="btn_out">탈퇴하기</a>
        </div>
        <div class="my_cou_wr">
            <div class="my_cou"><a href="<?php echo G5_SHOP_URL; ?>/coupon.php" target="_blank" class="win_coupon"><span>쿠폰</span><?php echo number_format($cp_count); ?></a></div>
            <div class="my_po"><a href="<?php echo G5_BBS_URL; ?>/point.php" target="_blank" class="win_point"><span>포인트</span><?php echo number_format($member['mb_point']); ?>점</a></div>
        </div>
        <dl class="my_info">
            <dt>연락처</dt>
            <dd><?php echo ($member['mb_tel'] ? $member['mb_tel'] : '미등록'); ?></dd>
            <dt>E-Mail</dt>
            <dd><?php echo ($member['mb_email'] ? $member['mb_email'] : '미등록'); ?></dd>
            <dt>최종접속일시</dt>
            <dd><?php echo $member['mb_today_login']; ?></dd>
            <dt>회원가입일시</dt>
            <dd><?php echo $member['mb_datetime']; ?></dd>
            <dt class="add">주소</dt>
            <dd class="add"><?php echo sprintf("(%s%s)", $member['mb_zip1'], $member['mb_zip2']).' '.print_address($member['mb_addr1'], $member['mb_addr2'], $member['mb_addr3'], $member['mb_addr_jibeon']); ?></dd>
        </dl>
        <button type="button" class="btn_my_if">나의 정보 보기</button>
    </section>
    <script>
    $(function() {
        $(".btn_my_if").click(function() {
            $(".my_info").toggle();
        });
    });
    </script>
    <div id="smb_my_wr" >
        <section id="smb_my_od">
            <h2><a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php" >최근 주문내역</a></h2>
            <?php
            // 최근 주문내역
            define("_ORDERINQUIRY_", true);

            $limit = " limit 0, 4 ";
            include G5_MSHOP_PATH.'/orderinquiry.sub.php';
            ?>
        </section>

        <section id="smb_my_wish">
            <h2><a href="<?php echo G5_SHOP_URL; ?>/wishlist.php">최근 위시리스트</a></h2>

            <ul>
                <?php
                $sql = " select *
                           from {$g5['g5_shop_wish_table']} a,
                                {$g5['g5_shop_item_table']} b
                          where a.mb_id = '{$member['mb_id']}'
                            and a.it_id  = b.it_id
                          order by a.wi_id desc
                          limit 0, 4 ";
                $result = sql_query($sql);
                for ($i=0; $row = sql_fetch_array($result); $i++)
                {
                    $image_w = 260;
                    $image_h = 260;
                    $image = get_it_image($row['it_id'], $image_w, $image_h, true);
                    $list_left_pad = $image_w + 10;
                ?>

                <li>
                    <div class="wish_img"><?php echo $image; ?></div>
                    <div class="wish_info">
                        <a href="./item.php?it_id=<?php echo $row['it_id']; ?>" class="info_link"><?php echo stripslashes($row['it_name']); ?></a>
                        <span class="info_date"><?php echo $row['wi_time']; ?></span>
                    </div>
                </li>

                <?php
                }

                if ($i == 0)
                    echo '<li class="empty_list">보관 내역이 없습니다.</list>';
                ?>
            </ul>
        </section>
    </div>



</div>

<script>
$(function() {
    $(".win_coupon").click(function() {
        var new_win = window.open($(this).attr("href"), "win_coupon", "left=100,top=100,width=700, height=600, scrollbars=1");
        new_win.focus();
        return false;
    });
});

function member_leave()
{
    return confirm('정말 회원에서 탈퇴 하시겠습니까?')
}

$("#container_wr").addClass("container_wr");

</script>

<?php
include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
?>