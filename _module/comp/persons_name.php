<?php
//======================================================================
// 人名
// $option['fname']...苗字
// $option['lname']...名前
// $option['fname_kana']...苗字（カナ）
// $option['lname_kana']...名前（カナ）
//======================================================================
?>
<?php echo $option['fname']; ?>&nbsp;<?php echo $option['lname']; ?>
<?php appLibraryDisp::strlenString($option['fname_kana'], '<span class="d-block font-size-0_8">（' . $option['fname_kana'] . '&nbsp;' . $option['lname_kana'] . '）</span>', '');
