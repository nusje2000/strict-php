<?php

declare(strict_types=1);

namespace Nusje2000\StrictPhp\Tests;

use Nusje2000\StrictPhp\File;
use PHPUnit\Framework\TestCase;

final class FileTest extends TestCase
{
    private const TEST_FILE = __DIR__ . '/test-file.txt';

    public function testExists(): void
    {
        self::assertTrue(File::exists(__FILE__));
        self::assertFalse(File::exists(__DIR__));
        self::assertFalse(File::exists(__FILE__ . '.non-existent'));
    }

    public function testFilePutContents(): void
    {
        $writtenBytes = File::putContents(self::TEST_FILE, 'some-contents');

        self::assertSame(13, $writtenBytes);
        self::assertFileExists(self::TEST_FILE);
    }

    /**
     * @depends testFilePutContents
     */
    public function testFileGetContents(): void
    {
        file_put_contents(self::TEST_FILE, 'some-contents');
        self::assertSame(File::getContents(self::TEST_FILE), 'some-contents');
    }

    /**
     * @depends testFilePutContents
     */
    public function testFileGetContentsWithMaxLenght(): void
    {
        $this->createTestFile();
        self::assertSame(File::getContents(self::TEST_FILE, false, null, 0, 4), 'some');
    }

    protected function tearDown(): void
    {
        if (is_file(self::TEST_FILE)) {
            unlink(self::TEST_FILE);
        }
    }

    private function createTestFile(): void
    {
        file_put_contents(self::TEST_FILE, 'some-contents');
    }
}
