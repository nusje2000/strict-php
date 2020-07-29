<?php

declare(strict_types=1);

namespace Nusje2000\StrictPhp\Tests;

use LogicException;
use Nusje2000\StrictPhp\Json;
use PHPUnit\Framework\TestCase;
use stdClass;
use UnexpectedValueException;

final class JsonTest extends TestCase
{
    public function testEncode(): void
    {
        self::assertSame(Json::encode([]), '[]');
        self::assertSame(Json::encode(1), '1');
        self::assertSame(Json::encode('string'), '"string"');
        self::assertSame(Json::encode(1.1), '1.1');
        self::assertSame(Json::encode(true), 'true');
        self::assertSame(Json::encode(false), 'false');
        self::assertSame(Json::encode(null), 'null');
        self::assertSame(Json::encode(new stdClass()), '{}');

        $resource = imagecreate(1, 1);
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Could not encode string due to "Type is not supported".');
        Json::encode($resource);
    }

    public function testDecode(): void
    {
        self::assertSame(Json::decode('[]'), []);
        self::assertSame(Json::decode('1'), 1);
        self::assertSame(Json::decode('"string"'), 'string');
        self::assertSame(Json::decode('1.1'), 1.1);
        self::assertEquals(Json::decode('{}'), new stdClass());
        self::assertTrue(Json::decode('true'));
        self::assertFalse(Json::decode('false'));
        self::assertNull(Json::decode('null'));

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Could not decode contents due to "Syntax error".');
        Json::decode('nu ll');
    }

    public function testDecodeToArray(): void
    {
        self::assertSame(Json::decodeToArray('["value"]'), ['value']);
        self::assertSame(Json::decodeToArray('{"key": "value"}'), ['key' => 'value']);
    }

    public function testDecodeToArrayWithNonArrayContents(): void
    {
        $this->expectException(UnexpectedValueException::class);
        $this->expectExceptionMessage('Expected output of json decode to be array, "integer" found.');
        Json::decodeToArray('1');
    }

    public function testDecodeToObject(): void
    {
        self::assertEquals(Json::decodeToObject('{}'), new stdClass());
    }

    public function testDecodeToArrayWithNonObjectContents(): void
    {
        $this->expectException(UnexpectedValueException::class);
        $this->expectExceptionMessage('Expected output of json decode to be instance of stdClass, "integer" found.');
        Json::decodeToObject('1');
    }
}
