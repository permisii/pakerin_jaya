<?php

namespace App\Helpers;

class MenuHelper {
    public static function isActiveMenu($pattern, $prefix = null): bool {
        $menuPrefix = request()->query('menu-prefix');

        if ($prefix !== null && $menuPrefix === $prefix) {
            return true;
        }

        if ($menuPrefix === null) {
            return request()->is($pattern);
        }

        return false;
    }
}
