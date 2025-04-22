<?php
//======================================================================
// 葬儀情報の設定
//======================================================================
class appConfigFuneral
{
    public const planCategoryKasou = 'kasou';
    public const planCategorySougi = 'sougi';
    public const plan = [
        'none' => ['name' => '未定', 'category' => 'none'],
        'plan1_bu' => ['name' => 'お別れ葬(仏式)', 'category' => self::planCategoryKasou],
        'plan2_bu' => ['name' => '火葬式(仏式)', 'category' => self::planCategoryKasou],
        'plan3_bu' => ['name' => '一日葬(仏式)', 'category' => self::planCategorySougi],
        'plan4_bu' => ['name' => '家族葬(仏式)', 'category' => self::planCategorySougi],
        'plan5_bu' => ['name' => '一般葬(仏式)', 'category' => self::planCategorySougi],
        'plan_bu' => ['name' => '未定(仏式)', 'category' => 'none'],
        'plan1_si' => ['name' => 'お別れ葬(神道)', 'category' => self::planCategoryKasou],
        'plan2_si' => ['name' => '火葬式(神道)', 'category' => self::planCategoryKasou],
        'plan3_si' => ['name' => '一日葬(神道)', 'category' => self::planCategorySougi],
        'plan4_si' => ['name' => '家族葬(神道)', 'category' => self::planCategorySougi],
        'plan5_si' => ['name' => '一般葬(神道)', 'category' => self::planCategorySougi],
        'plan_si' => ['name' => '未定(神道)', 'category' => 'none'],
        'plan1_ch' => ['name' => 'お別れ葬(キリスト教)', 'category' => self::planCategoryKasou],
        'plan2_ch' => ['name' => '火葬式(キリスト教)', 'category' => self::planCategoryKasou],
        'plan3_ch' => ['name' => '一日葬(キリスト教)', 'category' => self::planCategorySougi],
        'plan4_ch' => ['name' => '家族葬(キリスト教)', 'category' => self::planCategorySougi],
        'plan5_ch' => ['name' => '一般葬(キリスト教)', 'category' => self::planCategorySougi],
        'plan_ch' => ['name' => '未定(キリスト教)', 'category' => 'none'],
        'plan1_so' => ['name' => 'お別れ葬(友人葬)', 'category' => self::planCategoryKasou],
        'plan2_so' => ['name' => '火葬式(友人葬)', 'category' => self::planCategoryKasou],
        'plan3_so' => ['name' => '一日葬(友人葬)', 'category' => self::planCategorySougi],
        'plan4_so' => ['name' => '家族葬(友人葬)', 'category' => self::planCategorySougi],
        'plan5_so' => ['name' => '一般葬(友人葬)', 'category' => self::planCategorySougi],
        'plan_so' => ['name' => '未定(友人葬)', 'category' => self::planCategorySougi],
        'plan_fu' => ['name' => '福祉葬', 'category' => 'none']
    ];

    public const enshrined =  [
        'none' => '未定',
        'home' => '自宅安置',
        'storage' => 'お預かり安置',
        'stay' => '付添い安置'
    ];
}
