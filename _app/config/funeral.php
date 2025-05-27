<?php
//======================================================================
// 葬儀情報の設定
//======================================================================
class appConfigFuneral
{
    public const planCategoryKasou = 'kasou';
    public const planCategorySougi = 'sougi';
    public const plan = [
        'none' => ['name' => '未定', 'category' => 'none', 'optionFlower' => true],
        'plan1_bu' => ['name' => 'お別れ葬(仏式)', 'category' => self::planCategoryKasou, 'optionFlower' => false],
        'plan2_bu' => ['name' => '火葬式(仏式)', 'category' => self::planCategoryKasou, 'optionFlower' => true],
        'plan3_bu' => ['name' => '一日葬(仏式)', 'category' => self::planCategorySougi, 'optionFlower' => true],
        'plan4_bu' => ['name' => '家族葬(仏式)', 'category' => self::planCategorySougi, 'optionFlower' => true],
        'plan5_bu' => ['name' => '一般葬(仏式)', 'category' => self::planCategorySougi, 'optionFlower' => true],
        'plan_bu' => ['name' => '未定(仏式)', 'category' => 'none', 'optionFlower' => true],
        'plan1_si' => ['name' => 'お別れ葬(神道)', 'category' => self::planCategoryKasou, 'optionFlower' => false],
        'plan2_si' => ['name' => '火葬式(神道)', 'category' => self::planCategoryKasou, 'optionFlower' => true],
        'plan3_si' => ['name' => '一日葬(神道)', 'category' => self::planCategorySougi, 'optionFlower' => true],
        'plan4_si' => ['name' => '家族葬(神道)', 'category' => self::planCategorySougi, 'optionFlower' => true],
        'plan5_si' => ['name' => '一般葬(神道)', 'category' => self::planCategorySougi, 'optionFlower' => true],
        'plan_si' => ['name' => '未定(神道)', 'category' => 'none', 'optionFlower' => true],
        'plan1_ch' => ['name' => 'お別れ葬(キリスト教)', 'category' => self::planCategoryKasou, 'optionFlower' => false],
        'plan2_ch' => ['name' => '火葬式(キリスト教)', 'category' => self::planCategoryKasou, 'optionFlower' => true],
        'plan3_ch' => ['name' => '一日葬(キリスト教)', 'category' => self::planCategorySougi, 'optionFlower' => true],
        'plan4_ch' => ['name' => '家族葬(キリスト教)', 'category' => self::planCategorySougi, 'optionFlower' => true],
        'plan5_ch' => ['name' => '一般葬(キリスト教)', 'category' => self::planCategorySougi, 'optionFlower' => true],
        'plan_ch' => ['name' => '未定(キリスト教)', 'category' => 'none', 'optionFlower' => true],
        'plan1_so' => ['name' => 'お別れ葬(友人葬)', 'category' => self::planCategoryKasou, 'optionFlower' => false],
        'plan2_so' => ['name' => '火葬式(友人葬)', 'category' => self::planCategoryKasou, 'optionFlower' => true],
        'plan3_so' => ['name' => '一日葬(友人葬)', 'category' => self::planCategorySougi, 'optionFlower' => true],
        'plan4_so' => ['name' => '家族葬(友人葬)', 'category' => self::planCategorySougi, 'optionFlower' => true],
        'plan5_so' => ['name' => '一般葬(友人葬)', 'category' => self::planCategorySougi, 'optionFlower' => true],
        'plan_so' => ['name' => '未定(友人葬)', 'category' => self::planCategorySougi, 'optionFlower' => true],
        'plan_fu' => ['name' => '福祉葬', 'category' => 'none', 'optionFlower' => false]
    ];

    public const enshrined =  [
        'none' => '未定',
        'home' => '自宅安置',
        'storage' => 'お預かり安置',
        'stay' => '付添い安置'
    ];

    /*葬儀社名*/
    public const funeral_company_name = [
        'tsubasa' => ['name' => 'つばさの葬儀社'],
    ];

    /*宗派*/
    public const religion_category = [
        ['name' => '無宗教'],
        ['name' => '日蓮宗'],
        ['name' => '真言宗　豊山派'],
        ['name' => '真言宗　智山派'],
        ['name' => '真言宗'],
        ['name' => '浄土真宗　西'],
        ['name' => '浄土真宗　東'],
        ['name' => '浄土真宗'],
        ['name' => '曹洞宗'],
        ['name' => '天台宗'],
        ['name' => '臨済宗'],
        ['name' => '浄土宗'],
        ['name' => '黄檗宗'],
        ['name' => '時宗'],
        ['name' => '法華宗'],
        ['name' => '本門佛立宗'],
        ['name' => '日蓮正宗'],
        ['name' => '立正佼成会'],
        ['name' => '創価学会'],
        ['name' => '神道'],
        ['name' => 'プロテスタント'],
        ['name' => 'カトリック'],
    ];
}
