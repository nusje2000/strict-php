<?php

declare(strict_types=1);

namespace Nusje2000\StrictPhp;

use LogicException;
use stdClass;
use UnexpectedValueException;

final class Json
{
    /**
     * @param int|string|float|bool|object|array<mixed>|null $subject
     */
    public static function encode($subject, int $options = 0, int $depth = 512): string
    {
        $encoded = json_encode($subject, $options, $depth);
        if (false === $encoded) {
            throw new LogicException(sprintf('Could not encode string due to "%s".', json_last_error_msg()));
        }

        return $encoded;
    }

    /**
     * @return int|string|float|bool|object|array<mixed>|null
     */
    public static function decode(string $contents, bool $assoc = false)
    {
        /** @var int|string|float|bool|object|array<mixed>|null $decoded */
        $decoded = json_decode($contents, $assoc);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new LogicException(sprintf('Could not decode contents due to "%s".', json_last_error_msg()));
        }

        return $decoded;
    }

    /**
     * @return array<mixed>
     */
    public static function decodeToArray(string $contents): array
    {
        $decoded = self::decode($contents, true);

        if (!is_array($decoded)) {
            throw new UnexpectedValueException(sprintf('Expected output of json decode to be array, "%s" found.', gettype($decoded)));
        }

        return $decoded;
    }

    public static function decodeToObject(string $contents): stdClass
    {
        /** @var int|string|float|bool|object|array<mixed>|null $decoded */
        $decoded = self::decode($contents);

        if (!$decoded instanceof stdClass) {
            throw new UnexpectedValueException(sprintf('Expected output of json decode to be instance of stdClass, "%s" found.', gettype($decoded)));
        }

        return $decoded;
    }
}
