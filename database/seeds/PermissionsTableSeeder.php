<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'slug' => 'home',
            'name' => '首页',
            'action' => 'home',
            'model' => 'navigation',
        ]);

        Permission::create([
            'slug' => 'contact',
            'name' => '联系我们',
            'action' => 'contact',
            'model' => 'navigation',
        ]);

        Permission::create([
            'slug' => 'log-index',
            'name' => '列出日志',
            'action' => 'index',
            'model' => 'log',
        ]);

        Permission::create([
            'slug' => 'log-show',
            'name' => '查看日志',
            'action' => 'show',
            'model' => 'log',
        ]);

        $modules = [
            'setting', 'menu', 'menuitem', 'group', 'role', 'permission', 'user', 'archive', 'delivery', 'entry', 'student', 'department', 'major', 'nation', 'gender', 'idtype',
        ];

        $actions = [
            'create', 'edit', 'delete', 'show', 'index',
        ];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                Permission::create([
                    'slug' => $module . '-' . $action,
                    'name' => __($action) . __($module . '.module'),
                    'action' => $action,
                    'model' => $module,
                ]);
            }
        }

        Permission::create([
            'slug' => 'password-change',
            'name' => '修改密码',
            'action' => 'changePassword',
            'model' => 'user',
        ]);

        Permission::create([
            'slug' => 'password-reset',
            'name' => '重置密码',
            'action' => 'resetPassword',
            'model' => 'user',
        ]);

        Permission::create([
            'slug' => 'group-assign',
            'name' => '分配组',
            'action' => 'assignGroup',
            'model' => 'user',
        ]);

        Permission::create([
            'slug' => 'role-assign',
            'name' => '分配角色',
            'action' => 'assignRole',
            'model' => 'user',
        ]);

        Permission::create([
            'slug' => 'permission-assign',
            'name' => '分配权限',
            'action' => 'assignPermission',
            'model' => 'role',
        ]);

        foreach (['student', 'department', 'major', 'nation', 'gender', 'idtype'] as $module) {
            Permission::create([
                'slug' => $module . '-sync',
                'name' => '同步' . __($module . '.module'),
                'action' => 'sync',
                'model' => $module,
            ]);
        }

        Permission::create([
            'slug' => 'archive-search',
            'name' => '检索档案信息',
            'action' => 'search',
            'model' => 'archive',
        ]);

        Permission::create([
            'slug' => 'delivery-search',
            'name' => '检索档案去向',
            'action' => 'search',
            'model' => 'delivery',
        ]);

        Permission::create([
            'slug' => 'student-search',
            'name' => '检索学生信息',
            'action' => 'search',
            'model' => 'student',
        ]);

        Permission::create([
            'slug' => 'major-search',
            'name' => '检索专业信息',
            'action' => 'search',
            'model' => 'major',
        ]);

        Permission::create([
            'slug' => 'archive-import',
            'name' => '导入档案',
            'action' => 'import',
            'model' => 'archive',
        ]);

        Permission::create([
            'slug' => 'archive-export',
            'name' => '导出档案移交表excel模板',
            'action' => 'export',
            'model' => 'archive',
        ]);

        Permission::create([
            'slug' => 'delivery-import',
            'name' => '导入档案去向',
            'action' => 'import',
            'model' => 'delivery',
        ]);

        Permission::create([
            'slug' => 'delivery-download',
            'name' => '下载档案去向模板',
            'action' => 'download',
            'model' => 'delivery',
        ]);

        Permission::create([
            'slug' => 'delivery-ems',
            'name' => '导出档案去向机要交寄单',
            'action' => 'ems',
            'model' => 'delivery',
        ]);

        Permission::create([
            'slug' => 'delivery-notice',
            'name' => '导出档案去向通知单',
            'action' => 'notice',
            'model' => 'delivery',
        ]);

        Permission::create([
            'slug' => 'archive-transfer',
            'name' => '导出档案移交表pdf文件',
            'action' => 'transfer',
            'model' => 'archive',
        ]);
    }
}
