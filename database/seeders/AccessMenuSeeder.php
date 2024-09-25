<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class AccessMenuSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $menus = Menu::all();
        $superAdminId = 1;

        foreach ($menus as $menu) {
            $menu->accessMenus()->create([
                'user_id' => $superAdminId,
                'menu_id' => $menu->id,
                'can_create' => true,
                'can_read' => true,
                'can_update' => true,
                'can_delete' => true,
                'can_etc' => true,
                'created_by' => $superAdminId,
                'updated_by' => $superAdminId,
            ]);
        }
    }
}
