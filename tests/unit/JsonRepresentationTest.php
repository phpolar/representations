<?php

declare(strict_types=1);

namespace Phpolar\Http\Representations;

use PhpCommonEnums\MimeType\Enumeration\MimeTypeEnum as MimeType;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

#[CoversClass(JsonRepresentation::class)]
final class JsonRepresentationTest extends TestCase
{
    #[TestDox("Shall return the serialized result of the request processor")]
    #[TestWith(["{\"name\":\"John\"}", ["name" => "John"], true])]
    #[TestWith(["[\"apples\",\"oranges\",\"grapes\",\"bananas\"]", ["apples", "oranges", "grapes", "bananas"]])]
    #[TestWith(["\"John\"", "John"])]
    #[TestWith(["123", 123])]
    #[TestWith(["null", null])]
    public function testa(string|int|null $expectedResult, array|string|int|null $resource, bool $isObject = false)
    {
        $sut = new JsonRepresentation(
            $isObject === true ? (object) $resource : $resource,
        );

        $result = (string) $sut;

        $this->assertSame($expectedResult, $result);
    }

    #[TestDox("Shall return its mime type")]
    public function testd()
    {
        $sut = new JsonRepresentation("");

        $result = $sut->getMimeType();

        $this->assertSame(MimeType::ApplicationJson->value, $result);
    }
}
