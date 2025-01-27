<?php
/*======================================================================

葬儀プランに関する情報

======================================================================*/
class appConfigPlan
{
    const planList = ['plan1', 'plan2', 'plan3', 'plan4', 'plan5'];
    const planNavList = ['plan1', 'plan2', 'plan3', 'plan4', 'plan5'];
    const jitakusoList = ['plan3', 'plan4', 'plan5'];

    //-----------------------------------------------------
    // 葬儀プラン：基本
    //-----------------------------------------------------
    const plan = [
        'plan1' => [
            'id' => 'plan1',
            'name' => '都民のお別れ葬',
            'recommend' => '0',
            'price' => '79,000',
            'priceZei' => '86,900',
            'overview' => '仏具を省いて火葬のみ',
            'description' => '宗教儀式や仏具を省いた最安プランです',
            'visitText' => 'ご面会：火葬場にて3～5分',
            'flowSougi' => 1,
            'numberPeople' => '1～5名',
            'option' => [
                'car_shindai',
                'enshrined',
                'dryice', 'procedure',
                'coffin', 'clothes',
                'ceremony_staff',
                'pot'
            ],
            'optionAddComment' => [
                'car_shindai' => '寝台車2回分<br>・お迎え20kmまで<br>・火葬場搬送30kmまで',
                'enshrined' => '2日分（預かり安置のみ）',
                'dryice' => '2日分'
            ],
            'addOption' => [
                'flower',
                'flower_coffin',
                'flower_offering',
                'photo',
                'car_shindai',
                'enshrined',
                'lastmake',
                'bodywash_old',
                'bodywash',
                'letter',
                'gift'
            ],
            'addOptionPrint' => [
                'flower',
                'flower_coffin',
                'photo',
                'lastmake',
                'bodywash',
                'gift'
            ],
            'enshrined' => ['storage'],
            'optionObousan' => '',
        ],
        'plan2' => [
            'id' => 'plan2',
            'name' => '都民の火葬式',
            'recommend' => '1',
            'price' => '133,000',
            'priceZei' => '146,300',
            'overview' => '儀式は行わず火葬のみ',
            'description' => '通夜式・告別式を行わず、火葬のみを行うプランです',
            'visitText' => 'ご面会：安置施設にてご面会が可能です<span class="font-size-0_7">（※）</span>',
            'flowSougi' => 1,
            'numberPeople' => '1～10名',
            'option' => [
                'car_shindai',
                'enshrined',
                'dryice',
                'pillow_decoration',
                'procedure',
                'coffin',
                'clothes',
                'burning_incense',
                'ihai',
                'incense',
                'ceremony_staff',
                'pot',
                'after_decoration'
            ],
            'optionAddComment' => [
                'car_shindai' => '寝台車2回分<br>1回につき30kmまで対応',
                'enshrined' => '3日分',
                'dryice' => '3日分'
            ],
            'addOption' => [
                'flower',
                'flower_coffin',
                'flower_offering',
                'photo',
                'car_shindai',
                'enshrined',
                'enshrined_stay',
                'lastmake',
                'bodywash_old',
                'bodywash',
                'letter',
                'gift'
            ],
            'addOptionPrint' => [
                'flower',
                'flower_coffin',
                'photo',
                'lastmake',
                'bodywash',
                'gift'
            ],
            'enshrined' => ['home', 'storage'],
            'optionObousan' => '1'
        ],
        'plan3' => [
            'id' => 'plan3',
            'name' => '都民の一日葬',
            'recommend' => '1',
            'price' => '268,000',
            'priceZei' => '294,800',
            'overview' => '告別式のみ一日で',
            'description' => '通夜式を行わず、告別式～火葬を1日で行うプランです',
            'visitText' => '',
            'flowSougi' => 2,
            'numberPeople' => '2～30名',
            'option' => [
                'car_shindai',
                'enshrined',
                'dryice',
                'pillow_decoration',
                'procedure',
                'coffin',
                'clothes',
                'saijo',
                'waitingroom',
                'flower_altar',
                'flower',
                'photo',
                'burning_incense',
                'ihai',
                'incense',
                'ceremony_staff',
                'reception',
                'letter',
                'pot',
                'after_decoration',
            ],
            'optionAddComment' => [
                'flower_altar' => '生花祭壇をご用意致します',
                'ceremony_staff' => '（2名）',
                'car_shindai' => '寝台車3回分<br>1回につき30kmまで対応',
                'enshrined' => '3日分',
                'dryice' => '3日分',
                'saijo' => '25,000円（税込）まで',
                'letter' => '（30枚まで）',
            ],
            'addOption' => [
                'flower_coffin',
                'flower_offering',
                'enshrined_stay',
                'car_shindai',
                'enshrined',
                'lastmake',
                'bodywash_old',
                'bodywash',
                'car_bus',
                'car_hearse',
                'meal_shoujin',
                'gift',
                'letter'
            ],
            'addOptionPrint' => [
                'flower',
                'flower_coffin',
                'car_hearse',
                'car_bus',
                'lastmake',
                'bodywash',
                'meal_shoujin',
                'gift'
            ],
            'enshrined' => ['home', 'storage'],
            'optionObousan' => '2'
        ],
        'plan4' => [
            'id' => 'plan4',
            'name' => '都民の家族葬',
            'recommend' => '1',
            'price' => '349,000',
            'priceZei' => '383,900',
            'overview' => '通夜・告別式をご家族中心で',
            'description' => '通夜式・告別式をご家族を中心とした少人数で行うプランです',
            'visitText' => '',
            'flowSougi' => 3,
            'numberPeople' => '2～30名',
            'option' => [
                'car_shindai',
                'enshrined',
                'dryice',
                'pillow_decoration',
                'procedure',
                'coffin',
                'clothes',
                'saijo',
                'waitingroom',
                'flower_altar',
                'flower',
                'photo',
                'burning_incense',
                'ihai',
                'incense',
                'ceremony_staff',
                'enshrined_stay',
                'reception',
                'letter',
                'pot',
                'after_decoration',
            ],
            'optionAddComment' => [
                'flower_altar' => 'ご家族・親しい方で<br>お送りする場に相応しい<br>ボリュームアップした生花祭壇',
                'ceremony_staff' => '（2名）',
                'car_shindai' => '寝台車3回分<br>1回につき30kmまで対応',
                'enshrined' => '4日分',
                'dryice' => '4日分',
                'saijo' => '50,000円（税込）まで',
                'letter' => '（30枚まで）',
            ],
            'addOption' => [
                'flower_coffin',
                'flower_offering',
                'enshrined_stay',
                'car_shindai',
                'enshrined',
                'lastmake',
                'bodywash_old',
                'bodywash',
                'car_bus',
                'car_hearse',
                'meal_tuya',
                'meal_shoujin',
                'gift',
                'letter'
            ],
            'addOptionPrint' => [
                'flower',
                'flower_coffin',
                'car_hearse',
                'car_bus',
                'lastmake',
                'bodywash',
                'meal_shoujin',
                'gift'
            ],
            'enshrined' => ['home', 'storage', 'stay'],
            'optionObousan' => '3'
        ],
        'plan5' => [
            'id' => 'plan5',
            'name' => '都民の一般葬',
            'recommend' => '0',
            'price' => '480,000',
            'priceZei' => '528,000',
            'overview' => 'みなさまをお招きする昔ながらのお葬式です',
            'description' => '家族や友人・知人も招いて通夜・告別式を行うプランです',
            'visitText' => '',
            'flowSougi' => 3,
            'numberPeople' => '30名～',
            'option' => [
                'car_shindai',
                'enshrined',
                'dryice',
                'pillow_decoration',
                'procedure',
                'coffin',
                'clothes',
                'saijo',
                'waitingroom',
                'flower_altar',
                'coffin_bouquet',
                'photo',
                'burning_incense',
                'ihai',
                'incense',
                'ceremony_staff',
                'enshrined_stay',
                'reception',
                'letter',
                'pot',
                'after_decoration',
                'signboard'
            ],
            'optionAddComment' => [
                'flower_altar' => 'ワングレード上の生花祭壇で<br>華やかに彩ります',
                'ceremony_staff' => '（3名）',
                'car_shindai' => '寝台車3回分<br>1回につき30kmまで対応',
                'enshrined' => '5日分',
                'dryice' => '5日分',
                'saijo' => '100,000円（税込）まで',
                'letter' => '（100枚まで）',
            ],
            'addOption' => [
                'flower_coffin',
                'flower_offering',
                'enshrined_stay',
                'car_shindai',
                'enshrined',
                'lastmake',
                'bodywash_old',
                'bodywash',
                'car_bus',
                'car_hearse',
                'meal_tuya',
                'meal_shoujin',
                'gift',
                'letter'
            ],
            'addOptionPrint' => [
                'flower_coffin',
                'car_hearse',
                'car_bus',
                'lastmake',
                'bodywash',
                'meal_shoujin',
                'gift'
            ],
            'enshrined' => ['home', 'storage', 'stay'],
            'optionObousan' => '3'
        ]
    ];

    //-----------------------------------------------------
    // 宗派別葬儀プラン
    //-----------------------------------------------------
    const religion = [
        'shinto' => [
            'id' => 'shinto',
            'name' => '神道',
            'planList' => self::planShinto,
            'tuya' => '通夜祭',
            'kokubetsu' => '葬場祭'
        ],
        'christ' => [
            'id' => 'christ',
            'name' => 'キリスト教',
            'planList' => self::planChrist,
            'tuya' => '通夜',
            'kokubetsu' => '告別式'
        ],
        'yujinso' => [
            'id' => 'yujinso',
            'name' => '友人葬',
            'planList' => self::planYujinso,
            'tuya' => '通夜',
            'kokubetsu' => '告別式'
        ]
    ];
    //-----------------------------------------------------
    // 葬儀プラン：神道
    //-----------------------------------------------------
    const planShinto = [
        'plan1' => [
            'id' => 'plan1',
            'name' => '神道のお別れ葬',
            'price' => '119,000',
            'priceZei' => '130,900',
            'overview' => 'シンプルに火葬のみ',
            'flowSougi' => self::plan['plan1']['flowSougi'],
            'numberPeople' => self::plan['plan1']['numberPeople'],
            'option' => [
                'car_shindai',
                'enshrined',
                'dryice',
                'procedure',
                'coffin',
                'shinto_clothes',
                'ceremony_staff',
                'pot'
            ],
            'optionAddComment' => self::plan['plan1']['optionAddComment'],
            'addOption' => [],
            'addOptionAddComment' => [],
        ],
        'plan2' => [
            'id' => 'plan2',
            'name' => '神道の火葬式',
            'price' => '163,000',
            'priceZei' => '179,300',
            'overview' => self::plan['plan2']['overview'],
            'flowSougi' => self::plan['plan2']['flowSougi'],
            'numberPeople' => self::plan['plan2']['numberPeople'],
            'option' => [
                'car_shindai',
                'enshrined',
                'dryice',
                'shinto_pillow_decoration',
                'procedure',
                'coffin',
                'shinto_clothes',
                'burning_incense',
                'shinto_reiji',
                'incense',
                'ceremony_staff',
                'pot',
                'shinto_after_decoration'
            ],
            'optionAddComment' => self::plan['plan2']['optionAddComment'],
            'addOption' => [],
            'addOptionAddComment' => []
        ],
        'plan3' => [
            'id' => 'plan3',
            'name' => '神道の一日葬',
            'price' => '498,000',
            'priceZei' => '547,800',
            'overview' => 'ご都合に合わせて1日でお葬式',
            'flowSougi' => self::plan['plan3']['flowSougi'],
            'numberPeople' => self::plan['plan3']['numberPeople'],
            'option' => [
                'car_shindai',
                'enshrined',
                'dryice',
                'shinto_pillow_decoration',
                'procedure',
                'coffin',
                'shinto_clothes',
                'saijo',
                'waitingroom',
                'shinto_set',
                'flower_altar',
                'flower',
                'photo',
                'burning_incense',
                'shinto_reiji',
                'incense',
                'ceremony_staff',
                'reception',
                'letter',
                'pot',
                'shinto_after_decoration',
            ],
            'optionAddComment' => [
                'flower_altar' => '神道備品付きの花祭壇です',
                'ceremony_staff' => '（2名）',
                'car_shindai' => '寝台車3回分<br>1回につき30kmまで対応',
                'enshrined' => '3日分',
                'dryice' => '3日分',
                'saijo' => '25,000円（税込）まで',
                'letter' => '（30枚まで）'
            ],
            'addOption' => ['shinto_saidan', 'shinto_tamagushi'],
            'addOptionAddComment' => ['shinto_tamagushi' => '500円／本（税抜）']
        ],
        'plan4' => [
            'id' => 'plan4',
            'name' => '神道の家族葬',
            'price' => '579,000',
            'priceZei' => '636,900',
            'overview' => '通夜祭・葬場祭をご家族中心で',
            'flowSougi' => self::plan['plan4']['flowSougi'],
            'numberPeople' => self::plan['plan4']['numberPeople'],
            'option' => [
                'car_shindai',
                'enshrined',
                'dryice',
                'shinto_pillow_decoration',
                'procedure',
                'coffin',
                'shinto_clothes',
                'saijo',
                'waitingroom',
                'shinto_set',
                'flower_altar',
                'flower',
                'photo',
                'burning_incense',
                'shinto_reiji',
                'incense',
                'ceremony_staff',
                'shinto_enshrined_stay',
                'reception',
                'letter',
                'pot',
                'shinto_after_decoration',
            ],
            'optionAddComment' => [
                'flower_altar' => '神道備品付きの花祭壇です',
                'ceremony_staff' => '（2名）',
                'car_shindai' => '寝台車3回分<br>1回につき30kmまで対応',
                'enshrined' => '4日分',
                'dryice' => '4日分',
                'saijo' => '50,000円（税込）まで',
                'letter' => '（30枚まで）',
            ],
            'addOption' => ['shinto_saidan', 'shinto_tamagushi'],
            'addOptionAddComment' => ['shinto_tamagushi' => '500円／本（税抜）']
        ],
        'plan5' => [
            'id' => 'plan5',
            'name' => '神道の一般葬',
            'price' => '710,000',
            'priceZei' => '781,000',
            'overview' => self::plan['plan5']['overview'],
            'flowSougi' => self::plan['plan5']['flowSougi'],
            'numberPeople' => self::plan['plan5']['numberPeople'],
            'option' => [
                'car_shindai',
                'enshrined',
                'dryice',
                'shinto_pillow_decoration',
                'procedure',
                'coffin',
                'shinto_clothes',
                'saijo',
                'waitingroom',
                'shinto_set',
                'flower_altar',
                'coffin_bouquet',
                'photo',
                'burning_incense',
                'shinto_reiji',
                'incense',
                'ceremony_staff',
                'shinto_enshrined_stay',
                'reception',
                'letter',
                'pot',
                'shinto_after_decoration',
                'signboard'
            ],
            'optionAddComment' => [
                'flower_altar' => '神道備品付きの花祭壇です',
                'ceremony_staff' => '（3名）',
                'car_shindai' => '寝台車3回分<br>1回につき30kmまで対応',
                'enshrined' => '5日分',
                'dryice' => '5日分',
                'saijo' => '100,000円（税込）まで',
                'letter' => '（100枚まで）',
            ],
            'addOption' => ['shinto_saidan', 'shinto_tamagushi'],
            'addOptionAddComment' => ['shinto_tamagushi' => '500円／本（税抜）']
        ]
    ];

    //-----------------------------------------------------
    // 葬儀プラン：キリスト教
    //-----------------------------------------------------
    const planChrist = [
        'plan1' => [
            'id' => 'plan1',
            'name' => 'キリスト教のお別れ葬',
            'price' => '79,000',
            'priceZei' => '86,900',
            'overview' => 'シンプルに火葬のみ',
            'flowSougi' => self::plan['plan1']['flowSougi'],
            'numberPeople' => self::plan['plan1']['numberPeople'],
            'option' => [
                'car_shindai',
                'enshrined',
                'dryice',
                'procedure',
                'coffin',
                'ceremony_staff',
                'pot'
            ],
            'optionAddComment' => self::plan['plan1']['optionAddComment'],
            'addOption' => self::plan['plan1']['addOption']
        ],
        'plan2' => [
            'id' => 'plan2',
            'name' => 'キリスト教の火葬式',
            'price' => '173,800',
            'priceZei' => '191,180',
            'overview' => self::plan['plan2']['overview'],
            'flowSougi' => self::plan['plan2']['flowSougi'],
            'numberPeople' => self::plan['plan2']['numberPeople'],
            'option' => [
                'car_shindai',
                'enshrined',
                'dryice',
                'christ_pillow_decoration',
                'procedure',
                'christ_coffin',
                'ceremony_staff',
                'pot',
                'christ_after_decoration'
            ],
            'optionAddComment' => self::plan['plan2']['optionAddComment'],
            'addOption' => self::plan['plan2']['addOption']
        ],
        'plan3' => [
            'id' => 'plan3',
            'name' => 'キリスト教の一日葬',
            'price' => '308,800',
            'priceZei' => '339,680',
            'overview' => 'ご都合に合わせて1日でお葬式',
            'flowSougi' => self::plan['plan3']['flowSougi'],
            'numberPeople' => self::plan['plan3']['numberPeople'],
            'option' => [
                'car_shindai',
                'enshrined',
                'dryice',
                'christ_pillow_decoration',
                'procedure',
                'christ_coffin',
                'saijo',
                'waitingroom',
                'flower_altar',
                'flower',
                'photo',
                'ceremony_staff',
                'reception',
                'letter',
                'pot',
                'christ_after_decoration',
            ],
            'optionAddComment' => [
                'flower_altar' => '生花祭壇をご用意致します',
                'ceremony_staff' => '（2名）',
                'car_shindai' => '寝台車3回分<br>1回につき30kmまで対応',
                'enshrined' => '3日分',
                'dryice' => '3日分',
                'saijo' => '25,000円（税込）まで<br>※提携式場をご利用の場合',
                'letter' => '（30枚まで）',
            ],
            'addOption' => self::plan['plan3']['addOption']
        ],
        'plan4' => [
            'id' => 'plan4',
            'name' => 'キリスト教の家族葬',
            'price' => '389,800',
            'priceZei' => '428,780',
            'overview' => 'ご家族中心で温かいお別れを',
            'flowSougi' => self::plan['plan4']['flowSougi'],
            'numberPeople' => self::plan['plan4']['numberPeople'],
            'option' => [
                'car_shindai',
                'enshrined',
                'dryice',
                'christ_pillow_decoration',
                'procedure',
                'christ_coffin',
                'saijo',
                'waitingroom',
                'flower_altar',
                'flower',
                'photo',
                'ceremony_staff',
                'enshrined_stay',
                'reception',
                'letter',
                'pot',
                'christ_after_decoration',
            ],
            'optionAddComment' => [
                'flower_altar' => 'ご家族・親しい方で<br>お送りする場に相応しい<br>ボリュームアップした生花祭壇',
                'ceremony_staff' => '（2名）',
                'car_shindai' => '寝台車3回分<br>1回につき30kmまで対応',
                'enshrined' => '4日分',
                'dryice' => '4日分',
                'saijo' => '50,000円（税込）まで<br>※提携式場をご利用の場合',
                'letter' => '（30枚まで）',
            ],
            'addOption' => self::plan['plan4']['addOption']
        ],
        'plan5' => [
            'id' => 'plan5',
            'name' => 'キリスト教の一般葬',
            'price' => '520,800',
            'priceZei' => '572,880',
            'overview' => '知人・友人・ご家族でのお葬式',
            'flowSougi' => self::plan['plan5']['flowSougi'],
            'numberPeople' => self::plan['plan5']['numberPeople'],
            'option' => [
                'car_shindai',
                'enshrined',
                'dryice',
                'christ_pillow_decoration',
                'procedure',
                'christ_coffin',
                'saijo',
                'waitingroom',
                'flower_altar',
                'coffin_bouquet',
                'photo',
                'ceremony_staff',
                'enshrined_stay',
                'reception',
                'letter',
                'pot',
                'christ_after_decoration',
                'signboard'
            ],
            'optionAddComment' => [
                'flower_altar' => 'ワングレード上の生花祭壇で<br>華やかに彩ります',
                'ceremony_staff' => '（3名）',
                'car_shindai' => '寝台車3回分<br>1回につき30kmまで対応',
                'enshrined' => '5日分',
                'dryice' => '5日分',
                'saijo' => '100,000円（税込）まで<br>※提携式場をご利用の場合',
                'letter' => '（100枚まで）',
            ],
            'addOption' => self::plan['plan5']['addOption']
        ]
    ];

    //-----------------------------------------------------
    // 葬儀プラン：友人葬（創価学会）
    //-----------------------------------------------------
    const planYujinso = [
        'plan1' => [
            'id' => 'plan1',
            'name' => '友人葬のお別れ葬',
            'price' => '79,000',
            'priceZei' => '86,900',
            'overview' => self::plan['plan1']['overview'],
            'flowSougi' => self::plan['plan1']['flowSougi'],
            'numberPeople' => self::plan['plan1']['numberPeople'],
            'option' => self::plan['plan1']['option'],
            'optionAddComment' => self::plan['plan1']['optionAddComment'],
            'addOption' => self::plan['plan1']['addOption']
        ],
        'plan2' => [
            'id' => 'plan2',
            'name' => '友人葬の火葬式',
            'price' => '133,000',
            'priceZei' => '146,300',
            'overview' => self::plan['plan2']['overview'],
            'flowSougi' => self::plan['plan2']['flowSougi'],
            'numberPeople' => self::plan['plan2']['numberPeople'],
            'option' => self::plan['plan2']['option'],
            'optionAddComment' => self::plan['plan2']['optionAddComment'],
            'addOption' => self::plan['plan2']['addOption']
        ],
        'plan3' => [
            'id' => 'plan3',
            'name' => '友人葬の一日葬',
            'price' => '268,000',
            'priceZei' => '294,800',
            'overview' => self::plan['plan3']['overview'],
            'flowSougi' => self::plan['plan3']['flowSougi'],
            'numberPeople' => self::plan['plan3']['numberPeople'],
            'option' => self::plan['plan3']['option'],
            'optionAddComment' => [
                'flower_altar' => '選択可能<br>・生花祭壇<br>・樒入り生花祭壇',
                'ceremony_staff' => '（2名）',
                'car_shindai' => '寝台車3回分<br>1回につき30kmまで対応',
                'enshrined' => '3日分',
                'dryice' => '3日分',
                'saijo' => '25,000円（税込）まで',
                'letter' => '（30枚まで）',
            ],
            'addOption' => self::plan['plan3']['addOption']
        ],
        'plan4' => [
            'id' => 'plan4',
            'name' => '友人葬の家族葬',
            'price' => '349,000',
            'priceZei' => '383,900',
            'overview' => self::plan['plan4']['overview'],
            'flowSougi' => self::plan['plan4']['flowSougi'],
            'numberPeople' => self::plan['plan4']['numberPeople'],
            'option' => self::plan['plan4']['option'],
            'optionAddComment' => [
                'flower_altar' => '選択可能<br>・生花祭壇<br>・樒入り生花祭壇',
                'ceremony_staff' => '（2名）',
                'car_shindai' => '寝台車3回分<br>1回につき30kmまで対応',
                'enshrined' => '4日分',
                'dryice' => '4日分',
                'saijo' => '50,000円（税込）まで',
                'letter' => '（30枚まで）',
            ],
            'addOption' => self::plan['plan4']['addOption']
        ],
        'plan5' => [
            'id' => 'plan5',
            'name' => '友人葬の一般葬',
            'price' => '480,000',
            'priceZei' => '528,000',
            'overview' => self::plan['plan5']['overview'],
            'flowSougi' => self::plan['plan5']['flowSougi'],
            'numberPeople' => self::plan['plan5']['numberPeople'],
            'option' => self::plan['plan5']['option'],
            'optionAddComment' => [
                'flower_altar' => '選択可能<br>・生花祭壇<br>・樒入り生花祭壇',
                'ceremony_staff' => '（3名）',
                'car_shindai' => '寝台車3回分<br>1回につき30kmまで対応',
                'enshrined' => '5日分',
                'dryice' => '5日分',
                'saijo' => '100,000円（税込）まで',
                'letter' => '（100枚まで）',
            ],
            'addOption' => self::plan['plan5']['addOption']
        ]
    ];

    //'car_shindai','enshrined','dryice','ceremony_staff','procedure','photo','burning_incense','incense','pillow_decoration','coffin','ihai','clothes','pot','reception','letter','saijo','flower_altar','flower_photo','flower_coffin','enshrined_stay',
    // 'option' => ['car_hearse', 'car_shindai', 'enshrined', 'dryice', 'pillow_decoration', 'procedure', 'coffin', 'clothes', 'saijo', 'flower_altar', 'photo', 'burning_incense', 'ihai', 'incense', 'ceremony_staff', 'enshrined_stay',  'reception', 'car_bus', 'letter', 'flower_coffin', 'flower_photo', 'pot', 'after_decoration'],
    /*
    安置の種類
    */
    const enshrined =  [
        'home' => ['id' => 'home', 'name' => '自宅安置'],
        'storage' => ['id' => 'storage', 'name' => 'お預かり安置'],
        'stay' => ['stay' => '3', 'name' => '付添い安置']
    ];

    /*
    お坊さまの手配
    */
    const obousan =  [
        'name' => '寺院・お坊さまの手配',
        '1' => ['id' => '1', 'price' => '60,000', 'priceKaimyo' => '10,000', 'service' => '炉前読経'],
        '2' => ['id' => '2', 'price' => '95,000',  'priceKaimyo' => '15,000', 'service' => '告別式読経／初七日読経／炉前読経'],
        '3' => ['id' => '3', 'price' => '180,000', 'priceKaimyo' => '15,000', 'service' => '通夜読経／告別式読経／初七日読経／炉前読経'],
    ];

    /*
    葬儀オプション（基本）
    */
    const option =  [
        'car_shindai' => ['id' => 'car_shindai', 'name' => 'ご搬送', 'category' => 'service', 'summary' => ''],
        'enshrined' => ['id' => 'enshrined', 'name' => 'ご安置', 'category' => 'service', 'summary' => ''],
        'dryice' => ['id' => 'dryice', 'name' => 'ドライアイス', 'category' => 'service', 'summary' => ''],
        'host_staff' => ['id' => 'host_staff', 'name' => '司会スタッフ', 'category' => 'service', 'summary' => ''],
        'ceremony_staff' => ['id' => 'ceremony_staff', 'name' => '運営スタッフ', 'category' => 'service', 'summary' => ''],
        'procedure' => ['id' => 'procedure', 'name' => '役所手続き', 'category' => 'service', 'summary' => '役所への手続きを代行いたします'],
        'photo' => ['id' => 'photo', 'name' => '遺影写真', 'category' => 'funeralItem', 'summary' => '大小2点ご用意いたします。<br>大（四切サイズ）／小（キャビネサイズ）'],
        'burning_incense' => ['id' => 'burning_incense', 'name' => '焼香用品', 'category' => 'funeralItem', 'summary' => '焼香、焼香炉、焼香盆などをご用意いたします'],
        'incense' => ['id' => 'incense', 'name' => '線香・ろうそく', 'category' => 'funeralItem', 'summary' => ''],
        'pillow_decoration' => ['id' => 'pillow_decoration', 'name' => '枕飾り一式', 'category' => 'funeralItem', 'summary' => '葬儀前、故人の枕元に飾る簡易的な祭壇です'],
        'after_decoration' => ['id' => 'after_decoration', 'name' => '後飾り', 'category' => 'funeralItem', 'summary' => '火葬後に自宅に飾る祭壇です（自宅飾りとも呼びます）'],
        'coffin' => ['id' => 'coffin', 'name' => 'お棺一式', 'category' => 'funeralItem', 'summary' => ''],
        'coffin_bouquet' => ['id' => 'coffin_bouquet', 'name' => '棺上花束', 'category' => 'funeralItem', 'summary' => '棺の上にのせる花束です'],
        'ihai' => ['id' => 'ihai', 'name' => '白木位牌', 'category' => 'funeralItem', 'summary' => '枕飾りやご葬儀で飾る、白木で作られたお位牌です'],
        'clothes' => ['id' => 'clothes', 'name' => '仏衣一式', 'category' => 'funeralItem', 'summary' => '（お着替えは別料金となります）'],
        'pot' => ['id' => 'pot', 'name' => '骨壷', 'category' => 'funeralItem', 'summary' => '骨箱・骨覆い付き'],
        'signboard' => ['id' => 'signboard', 'name' => '布看板', 'category' => 'item', 'summary' => '葬儀場への案内看板をご用意いたします'],
        'car_bus' => ['id' => 'car_bus', 'name' => '送迎バス', 'category' => 'service', 'summary' => ''],
        'car_hearse' => ['id' => 'car_hearse', 'name' => '霊柩車', 'category' => 'service', 'summary' => '火葬場への出棺時、霊柩車をご用意いたします。'],
        'bodyWash' => ['id' => 'bodyWash', 'name' => '湯かん', 'category' => 'service', 'summary' => ''],
        'lightning_photo' => ['id' => 'photo', 'name' => '電光遺影', 'category' => 'funeralItem', 'summary' => ''],
        'sword' => ['id' => 'sword', 'name' => '守り刀', 'category' => 'funeralItem', 'summary' => ''],
        'reception' => ['id' => 'reception', 'name' => '受付用品', 'category' => 'service', 'summary' => '受付で使用する筆記用具や台などをご用意いたします'],
        'letter' => ['id' => 'letter', 'name' => '会葬礼状', 'category' => 'item', 'summary' => '参列者へお渡しするお礼の手紙です'],
        'saijo' => ['id' => 'saijo', 'name' => '式場利用料', 'category' => 'service', 'summary' => ''],
        'waitingroom' => ['id' => 'waitingroom', 'name' => '親族控室', 'category' => '', 'summary' => '', 'comment' => ''],
        'flower_altar' => ['id' => 'flower_altar', 'name' => '花祭壇', 'category' => 'item', 'summary' => ''],
        'enshrined_stay' => ['id' => 'enshrined_stay', 'name' => '付き添い安置', 'category' => '', 'summary' => '告別式前日1泊分<br>（式場によっては対応できない場合がございます）', 'comment' => ''],
        'flower' => ['id' => 'flower', 'name' => '棺上花束', 'category' => 'funeralItem', 'summary' => '棺の上に捧げる花束です'],
        'shinto_clothes' => ['id' => 'shinto_clothes', 'name' => '神衣一式', 'category' => 'funeralItem', 'summary' => '（お着替えは別料金となります）'],
        'shinto_set' => ['id' => 'shinto_set', 'name' => '神道セット', 'category' => 'funeralItem', 'summary' => '大榊一対・大祓・御神饌物'],
        'shinto_reiji' => ['id' => 'shinto_reiji', 'name' => '霊璽', 'category' => 'funeralItem', 'summary' => ''],
        'shinto_enshrined_stay' => ['id' => 'enshrined_stay', 'name' => '付き添い安置', 'category' => '', 'summary' => '葬場祭前日1泊分<br>（式場によっては対応できない場合がございます）', 'comment' => ''],
        'shinto_pillow_decoration' => ['id' => 'shinto_pillow_decoration', 'name' => '枕飾り一式', 'category' => 'funeralItem', 'summary' => '葬儀前、故人の枕元に飾る簡易的な祭壇です'],
        'shinto_after_decoration' => ['id' => 'shinto_after_decoration', 'name' => '後飾り', 'category' => 'funeralItem', 'summary' => '火葬後に自宅に飾る神道用の祭壇です（自宅飾りとも呼びます）'],
        'christ_pillow_decoration' => ['id' => 'pillow_decoration', 'name' => '枕飾り一式', 'category' => 'funeralItem', 'summary' => '葬儀前、故人の枕元に飾る簡易的な祭壇です'],
        'christ_after_decoration' => ['id' => 'after_decoration', 'name' => '後飾り', 'category' => 'funeralItem', 'summary' => '火葬後に自宅に飾るキリスト教用の祭壇です（自宅飾りとも呼びます）'],
        'christ_coffin' => ['id' => 'coffin', 'name' => 'お棺一式（白布棺）', 'category' => 'funeralItem', 'summary' => ''],
    ];

    /*
    葬儀オプション（有料）
    価格は小さなお葬式ベース。ただし、表には出さず問い合わせを受けて対応するスタイル 2020/06/09
    */
    const addOption =  [
        'obousan' => ['id' => 'obousan', 'name' => '寺院・お坊さまの手配', 'price' => '？？？', 'priceZei' => '？？？', 'priceType' => 'multiple', 'category' => '', 'summary' => ''],
        'car_shindai' => ['id' => 'car_shindai', 'name' => '搬送超過料金', 'price' => '？？？', 'priceZei' => '？？？', 'priceType' => 'multiple', 'category' => '', 'summary' => '10km毎'],
        'enshrined' => ['id' => 'enshrined', 'name' => '安置追加料金', 'price' => '？？？', 'priceZei' => '？？？', 'priceType' => 'multiple', 'category' => '', 'summary' => '1日超過毎'],
        'enshrined_stay' => ['id' => 'enshrined_stay', 'name' => '付き添い安置', 'price' => '？？？', 'priceZei' => '？？？', 'priceType' => 'multiple', 'category' => '', 'summary' => '1日超過毎、追加料金', 'comment' => ''],
        'flower' => ['id' => 'flower', 'name' => '棺上花束', 'price' => '5,000', 'priceZei' => '5,500', 'priceType' => 'multiple', 'category' => '', 'summary' => '棺の上に捧げる花束です'],
        'flower_photo' => ['id' => 'flower_photo', 'name' => '遺影花飾り', 'price' => '？？？', 'priceZei' => '？？？', 'priceType' => 'multiple', 'category' => '', 'summary' => ''],
        'flower_coffin' => ['id' => 'flower_coffin', 'name' => 'お花盆',  'price' => '？？？', 'priceZei' => '？？？', 'priceType' => 'multiple', 'category' => '', 'summary' => '棺の中に入れるお花です'],
        'flower_offering' => ['id' => 'flower_offering', 'name' => '供花・枕花・献花・花輪', 'price' => '？？？', 'priceZei' => '？？？', 'priceType' => 'multiple', 'category' => '', 'summary' => ''],
        'movie' => ['id' => 'movie', 'name' => 'ムービー上映・制作', 'price' => '？？？', 'priceZei' => '？？？', 'priceType' => 'multiple', 'category' => '', 'summary' => '映像で葬儀を演出いたします'],
        'livemusic' => ['id' => 'livemusic', 'name' => '生演奏', 'price' => '？？？', 'priceZei' => '？？？', 'priceType' => 'multiple', 'category' => '', 'summary' => 'プロの演奏者を手配し、生演奏を行います'],
        'meal_tuya' => ['id' => 'meal_tuya', 'name' => 'お食事', 'price' => '？？？', 'priceZei' => '？？？', 'priceType' => 'multiple', 'category' => '', 'summary' => '（通夜ぶるまい）'],
        'meal_shoujin' => ['id' => 'meal_shoujin', 'name' => 'お食事', 'price' => '？？？', 'priceZei' => '？？？', 'priceType' => 'multiple', 'category' => '', 'summary' => '（精進落とし）'],
        'gift' => ['id' => 'gift', 'name' => '返礼品', 'price' => '？？？', 'priceZei' => '？？？', 'priceType' => 'multiple', 'category' => '', 'summary' => '参列者にお渡しする品物をご用意いたします'],
        'car_hearse' => ['id' => 'car', 'name' => '霊柩車', 'price' => '？？？', 'priceZei' => '？？？', 'priceType' => 'multiple', 'category' => '', 'summary' => ''],
        'car_bus' => ['id' => 'bus', 'name' => '送迎用バス', 'price' => '？？？', 'priceZei' => '？？？', 'priceType' => 'multiple', 'category' => '', 'summary' => ''],
        'photo' => ['id' => 'photo', 'name' => '遺影写真', 'category' => 'funeralItem', 'price' => '？？？', 'priceZei' => '？？？', 'priceType' => 'single', 'summary' => '大小2点をご用意いたします'],
        'letter' => ['id' => 'letter', 'name' => '会葬礼状', 'category' => 'item',  'price' => '？？？', 'priceZei' => '？？？', 'priceType' => 'multiple', 'summary' => '参列者へお渡しするお礼の手紙です'],
        'bodywash_old' => ['id' => 'bodywash_old', 'name' => '古式湯灌', 'price' => '90,000', 'priceZei' => '99,000', 'priceType' => 'multiple', 'category' => '', 'summary' => '故人様のお身体をアルコール清拭して、化粧を施します', 'comment' => ''],
        'bodywash' => ['id' => 'bodywash', 'name' => '湯灌', 'price' => '100,000', 'priceZei' => '110,000', 'priceType' => 'multiple', 'category' => '', 'summary' => '故人様のお身体をお湯で洗い清め、化粧を施します', 'comment' => ''],
        'lastmake' => ['id' => 'lastmake', 'name' => 'ラストメイク', 'price' => '？？？', 'priceZei' => '？？？', 'priceType' => 'multiple', 'category' => '', 'summary' => '故人様にメイクや処置を施します', 'comment' => ''],
        'shinto_saidan' => ['id' => 'shinto_saidan', 'name' => '白木祭壇へ変更', 'price' => '？？？', 'priceZei' => '？？？', 'priceType' => 'multiple', 'category' => '', 'summary' => '250,000円（税抜）', 'comment' => ''],
        'shinto_tamagushi' => ['id' => 'shinto_tamagushi', 'name' => '玉串料', 'price' => '？？？', 'priceZei' => '？？？', 'priceType' => 'multiple', 'category' => '', 'summary' => '', 'comment' => ''],
        'christ_staff' => ['id' => 'christ_staff', 'name' => '牧師手配 (プロテスタント)', 'price' => '？？？', 'priceZei' => '？？？', 'priceType' => 'multiple', 'category' => '', 'summary' => '', 'comment' => ''],
        'yujinso_temple' => ['id' => 'yujinso_temple', 'name' => '寺院手配（戒名なし）', 'price' => '？？？', 'priceZei' => '？？？', 'priceType' => 'multiple', 'category' => '', 'summary' => '', 'comment' => ''],
        'yujinso_temple_kaimyo' => ['id' => 'yujinso_temple', 'name' => '寺院手配（戒名あり）', 'price' => '？？？', 'priceZei' => '？？？', 'priceType' => 'multiple', 'category' => '', 'summary' => '', 'comment' => ''],
    ];

    /*
    葬儀オプションのカテゴリ
    */
    const optionCategory = [
        'service' => 'service',
        'funeralItem' => 'funeralItem',
        'item' => 'item'
    ];

    /*
    葬儀の流れ
    */
    const sougiflow =  [
        '1' => ['id' => '1', 'comment' => ''],
        '2' => ['id' => '2', 'comment' => ''],
        '3' => ['id' => '3', 'comment' => '']
    ];
}
