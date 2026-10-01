<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum FieldType: string
{
    case Text = 'TEXT';
    case Number = 'NUMBER';
    case Currency = 'CURRENCY';
    case Date = 'DATE';
    case Boolean = 'BOOLEAN';
    case SingleSelect = 'SINGLE_SELECT';
    case MultiSelect = 'MULTI_SELECT';
    case Link = 'LINK';
    case Paragraph = 'PARAGRAPH';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'text' => self::Text,
            'number' => self::Number,
            'currency' => self::Currency,
            'date' => self::Date,
            'boolean' => self::Boolean,
            'single_select' => self::SingleSelect,
            'multi_select' => self::MultiSelect,
            'link' => self::Link,
            'paragraph' => self::Paragraph,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Text => 'text',
            self::Number => 'number',
            self::Currency => 'currency',
            self::Date => 'date',
            self::Boolean => 'boolean',
            self::SingleSelect => 'single_select',
            self::MultiSelect => 'multi_select',
            self::Link => 'link',
            self::Paragraph => 'paragraph',
        };
    }
}
