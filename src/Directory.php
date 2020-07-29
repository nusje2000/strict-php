<?php

declare(strict_types=1);

namespace Nusje2000\StrictPhp;

final class Directory
{
    public static function exists(string $directory): bool
    {
        return is_dir($directory);
    }
}
