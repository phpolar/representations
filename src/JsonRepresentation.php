<?php

declare(strict_types=1);

namespace Phpolar\Http\Representations;

use PhpCommonEnums\MimeType\Enumeration\MimeTypeEnum as MimeType;
use PhpContrib\Http\Representation\RepresentationInterface;
use Phpolar\Serializers\JsonSerializer;

final class JsonRepresentation implements RepresentationInterface
{
    private readonly MimeType $mimeType;

    public function __construct(
        private readonly mixed $resource,
    ) {
        $this->mimeType = MimeType::ApplicationJson;
    }

    public function getMimeType(): string
    {
        return $this->mimeType->value;
    }

    public function __toString(): string
    {
        return (new JsonSerializer())->serialize(
            $this->resource,
        );
    }
}
