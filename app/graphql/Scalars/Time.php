<?php

namespace App\GraphQL\Scalars;

use Carbon\Carbon;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Language\AST\StringValueNode;

class Time extends ScalarType
{
    public function __construct()
    {
        $this->name = 'Time';
        $this->description = 'A time string with format H:i:s';
    }

    public function serialize($value)
    {
        return Carbon::parse($value)->format('H:i:s');
    }

    public function parseValue($value)
    {
        return Carbon::createFromFormat('H:i:s', $value);
    }

    public function parseLiteral($valueNode, ?array $variables = null)
    {
        if ($valueNode instanceof StringValueNode) {
            return Carbon::createFromFormat('H:i:s', $valueNode->value);
        }

        return null;
    }
}
