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
            ['name' => 'Instruksi Kerja', 'code' => 'work-instructions', 'description' => 'Instruksi Kerja', 'url' => 'work-instructions.index', 'icon' => 'fas fa-clipboard-list', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Assignments', 'code' => 'assignments', 'description' => 'Assignments', 'url' => 'work-instructions.assignments.index', 'icon' => 'fas fa-tasks', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Daily Reports', 'code' => 'daily-reports', 'description' => 'Daily Report Management', 'url' => 'daily-reports.index', 'icon' => 'fas fa-calendar-day', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Monthly Reports', 'code' => 'monthly-reports', 'description' => 'Monthly Report Management', 'url' => 'monthly-reports.index', 'icon' => 'fas fa-calendar-alt', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'PCs', 'code' => 'pcs', 'description' => 'PC Management', 'url' => 'pcs.index', 'icon' => 'fas fa-desktop', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Printers', 'code' => 'printers', 'description' => 'Printer Management', 'url' => 'printers.index', 'icon' => 'fas fa-print', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Service Cards', 'code' => 'service-cards', 'description' => 'Service Card Management', 'url' => 'service-cards.index', 'icon' => 'fas fa-clipboard-list', 'created_by' => 1, 'updated_by' => 1],
            //            ['name' => 'Work Processes', 'code' => 'work-processes', 'description' => 'Work Process Management', 'url' => 'work-process.index', 'icon' => 'fas fa-cogs', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'PPs', 'code' => 'pps', 'description' => 'PP Management', 'url' => 'pps.index', 'icon' => 'fas fa-cogs', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'OPs', 'code' => 'ops', 'description' => 'OP Management', 'url' => 'ops.index', 'icon' => 'fas fa-cogs', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'OP Presets', 'code' => 'op-presets', 'description' => 'OP Preset Management', 'url' => 'op-presets.index', 'icon' => 'fas fa-cogs', 'created_by' => 1, 'updated_by' => 1],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
