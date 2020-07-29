<?php

declare(strict_types=1);

namespace Nusje2000\StrictPhp;

use UnexpectedValueException;

final class File
{
    /**
     * @psalm-pure
     */
    public static function exists(string $file): bool
    {
        return is_file($file);
    }

    /**
     * @psalm-pure
     *
     * @param resource|null $context
     */
    public static function getContents(
        string $fileName,
        bool $useIncludePath = false,
        $context = null,
        int $offset = 0,
        ?int $maxlen = null
    ): string {
        if (null !== $maxlen) {
            $contents = file_get_contents($fileName, $useIncludePath, $context, $offset, $maxlen);
        } else {
            $contents = file_get_contents($fileName, $useIncludePath, $context, $offset);
        }

        if (false === $contents) {
            throw new UnexpectedValueException(sprintf('Could not read file contents of file "%s".', $fileName));
        }

        return $contents;
    }

    /**
     * @param resource|null $context
     */
    public static function putContents(string $fileName, string $contents, int $flags = 0, $context = null): int
    {
        $writtenBytes = file_put_contents($fileName, $contents, $flags, $context ?? stream_context_create([]));
        if (false === $writtenBytes) {
            throw new UnexpectedValueException(sprintf('Could not write file contents to file "%s".', $fileName));
        }

        return $writtenBytes;
    }
}
