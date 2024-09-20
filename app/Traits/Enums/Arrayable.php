<?php

namespace App\Traits\Enums;

trait Arrayable {
    public static function toArray() {
        return array_column(self::cases(), 'value');
    }

    public static function randomValue(): int {
        $values = self::toArray();

        return $values[array_rand($values)];
    }
}
