<?php

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([
            'slug' => 'main',
            'name' => '主菜单',
            'is_system' => true,
        ]);

        Menu::create([
            'slug' => 'navigation',
            'name' => '导航菜单',
            'is_system' => true,
        ]);

        $menu = Menu::find(2);
        $menu->items()->createMany([
            [
                'slug' => 'home',
                'name' => '使用说明',
                'route' => 'home',
                'order' => 1,
            ],
            [
                'slug' => 'contact',
                'name' => '联系我们',
                'route' => 'contact',
                'order' => 2,
            ],
        ]);

        $menu = Menu::find(1);
        $menu->items()->createMany([
            [
                'slug' => 'dashboard',
                'name' => '仪表盘',
                'route' => 'home',
                'icon' => 'tachometer-alt',
                'order' => -999,
            ],
            [
                'slug' => 'menu-manage',
                'name' => '菜单管理',
                'icon' => 'sitemap',
                'is_system' => true,
                'order' => 4,
            ],
            [
                'slug' => 'menu',
                'name' => '菜单管理',
                'route' => 'menus.index',
                'parent_id' => 4,
                'is_system' => true,
                'order' => 5,
            ],
            [
                'slug' => 'menuitem',
                'name' => '菜单项管理',
                'route' => 'menuitems.index',
                'parent_id' => 4,
                'is_system' => true,
                'order' => 6,
            ],
            [
                'slug' => 'user-manage',
                'name' => '用户管理',
                'icon' => 'users',
                'is_system' => true,
                'order' => 7,
            ],
            [
                'slug' => 'user',
                'name' => '用户管理',
                'route' => 'users.index',
                'parent_id' => 7,
                'is_system' => true,
                'order' => 8,
            ],
            [
                'slug' => 'role',
                'name' => '角色管理',
                'route' => 'roles.index',
                'parent_id' => 7,
                'is_system' => true,
                'order' => 9,
            ],
            [
                'slug' => 'permission',
                'name' => '权限管理',
                'route' => 'permissions.index',
                'parent_id' => 7,
                'is_system' => true,
                'order' => 10,
            ],
            [
                'slug' => 'group',
                'name' => '组管理',
                'route' => 'groups.index',
                'parent_id' => 7,
                'is_system' => true,
                'order' => 11,
            ],
            [
                'slug' => 'system-manage',
                'name' => '系统管理',
                'icon' => 'cogs',
                'is_system' => true,
                'order' => 12,
            ],
            [
                'slug' => 'password-change',
                'name' => '修改密码',
                'route' => 'passwords.change',
                'parent_id' => 12,
                'is_system' => true,
                'order' => 13,
            ],
            [
                'slug' => 'setting',
                'name' => '系统设置',
                'route' => 'settings.index',
                'parent_id' => 12,
                'is_system' => true,
                'order' => 14,
            ],
            [
                'slug' => 'log',
                'name' => '日志查询',
                'route' => 'logs.index',
                'parent_id' => 12,
                'is_system' => true,
                'order' => 15,
            ],
            [
                'slug' => 'archive-manage',
                'name' => '档案管理',
                'icon' => 'archive',
                'order' => 0,
            ],
            [
                'slug' => 'archive',
                'name' => '档案管理',
                'route' => 'archives.index',
                'parent_id' => 16,
                'order' => 1,
            ],
            [
                'slug' => 'delivery',
                'name' => '档案去向管理',
                'route' => 'deliveries.index',
                'parent_id' => 16,
                'order' => 2,
            ],
            [
                'slug' => 'entry',
                'name' => '档案条目管理',
                'route' => 'entries.index',
                'parent_id' => 16,
                'order' => 3,
            ],
            [
                'slug' => 'data-manage',
                'name' => '数据管理',
                'icon' => 'database',
                'order' => 1,
            ],
            [
                'slug' => 'student',
                'name' => '学生管理',
                'route' => 'students.search',
                'parent_id' => 20,
                'order' => 1,
            ],
            [
                'slug' => 'department',
                'name' => '学院管理',
                'route' => 'departments.index',
                'parent_id' => 20,
                'order' => 2,
            ],
            [
                'slug' => 'major',
                'name' => '专业管理',
                'route' => 'majors.search',
                'parent_id' => 20,
                'order' => 3,
            ],
            [
                'slug' => 'nation',
                'name' => '民族管理',
                'route' => 'nations.index',
                'parent_id' => 20,
                'order' => 4,
            ],
            [
                'slug' => 'idtype',
                'name' => '证件类型管理',
                'route' => 'idtypes.index',
                'parent_id' => 20,
                'order' => 5,
            ],
            [
                'slug' => 'gender',
                'name' => '性别管理',
                'route' => 'genders.index',
                'parent_id' => 20,
                'order' => 6,
            ],
        ]);
    }
}
