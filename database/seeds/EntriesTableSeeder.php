<?php

use App\Models\Entry;
use Illuminate\Database\Seeder;

class EntriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entries = [
            '高中材料',
            '专科材料',
            '学生历年成绩卡',
            '学籍异动材料',
            '教育实习评价材料',
            '高校毕业生登记表',
            '工作期间档案材料',
            '团员材料',
            '党员材料',
            '奖励材料',
            '处分材料',
            '健康卡',
            '就业通知书',
            '助学贷款材料',
            '学位授予材料',
            '教师资格申请表',
            '可供组织参考的其他材料',
            '硕士研究生登记表',
            '硕士研究生学生成绩卡',
            '硕士研究生论文评阅书',
            '硕士学位申请书',
            '硕士学位评定书',
            '硕士研究生毕业登记表',
            '博士研究生学生成绩卡',
            '博士研究生登记表',
            '博士研究生论文评阅书',
            '博士学位申请书',
            '博士学位评定书',
            '博士研究生毕业登记表',
            '其他材料',
        ];

        $i = 0;
        foreach ($entries as $entry) {
            $i++;
            Entry::create([
                'name' => $entry,
                'order' => $i,
            ])->groups()->sync([1, 2]);
        }

        // factory(Entry::class, 30)->create();
    }
}
