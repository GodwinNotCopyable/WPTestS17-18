<?php

namespace App\Models;

use Illuminate\Support\Facades\Schema;
use Throwable;

class ThemeSetting extends CustomizedFeature
{
    public const LIGHT = 'light';
    public const DARK = 'dark';

    protected $table = 'theme_settings';

    public static function options(): array
    {
        return [self::LIGHT, self::DARK];
    }

    public static function defaultTheme(): string
    {
        try {
            if (! static::tableExists()) {
                return self::LIGHT;
            }

            $theme = static::query()->value('default_theme');

            return in_array($theme, static::options(), true) ? $theme : self::LIGHT;
        } catch (Throwable) {
            return self::LIGHT;
        }
    }

    public static function singleton(): self
    {
        if (! static::tableExists()) {
            return new static([
                'id' => 1,
                'default_theme' => self::LIGHT,
            ]);
        }

        return static::query()->firstOrCreate(
            ['id' => 1],
            ['default_theme' => self::LIGHT],
        );
    }

    protected static function tableExists(): bool
    {
        return Schema::connection('sqlite_custom')->hasTable((new static())->getTable());
    }
}
