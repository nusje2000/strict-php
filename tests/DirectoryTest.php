<?php

declare(strict_types=1);

namespace Nusje2000\StrictPhp\Tests;

use Nusje2000\StrictPhp\Directory;
use PHPUnit\Framework\TestCase;

final class DirectoryTest extends TestCase
{
    public function testExists(): void
    {
        self::assertTrue(Directory::exists(__DIR__));
        self::assertFalse(Directory::exists(__DIR__ . '/non-existent-directory'));
        self::assertFalse(Directory::exists(__FILE__));
    }
}
