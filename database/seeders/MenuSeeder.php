<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $menus = [
            ['name' => 'Dashboard', 'code' => 'dashboard', 'description' => 'Dashboard', 'url' => '/dashboard', 'icon' => 'fas fa-home', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'User', 'code' => 'users', 'description' => 'User Management', 'url' => 'users.index', 'icon' => 'fas fa-users', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Unit', 'code' => 'units', 'description' => 'Unit Management', 'url' => 'units.index', 'icon' => 'fas fa-building', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Work Instructions', 'code' => 'work-instructions', 'description' => 'Work Instructions', 'url' => 'work-instructions.index', 'icon' => 'fas fa-clipboard-list', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Assignments', 'code' => 'assignments', 'description' => 'Assignments', 'url' => 'work-instructions.assignments.index', 'icon' => 'fas fa-tasks', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Daily Reports', 'code' => 'daily-reports', 'description' => 'Daily Report Management', 'url' => 'daily-report.index', 'icon' => 'fas fa-calendar-day', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Monthly Reports', 'code' => 'monthly-reports', 'description' => 'Monthly Report Management', 'url' => 'monthly-report.index', 'icon' => 'fas fa-calendar-alt', 'created_by' => 1, 'updated_by' => 1],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
