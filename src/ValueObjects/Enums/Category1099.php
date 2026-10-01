<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum Category1099: string
{
    case NecBox1 = 'NEC_BOX_1';
    case MiscBox1 = 'MISC_BOX_1';
    case MiscBox2 = 'MISC_BOX_2';
    case MiscBox3 = 'MISC_BOX_3';
    case MiscBox4 = 'MISC_BOX_4';
    case MiscBox5 = 'MISC_BOX_5';
    case MiscBox6 = 'MISC_BOX_6';
    case MiscBox8 = 'MISC_BOX_8';
    case MiscBox9 = 'MISC_BOX_9';
    case MiscBox10 = 'MISC_BOX_10';
    case MiscBox11 = 'MISC_BOX_11';
    case MiscBox12 = 'MISC_BOX_12';
    case MiscBox14 = 'MISC_BOX_14';
    case MiscBox15 = 'MISC_BOX_15';
    case IntBox1 = 'INT_BOX_1';
    case IntBox2 = 'INT_BOX_2';
    case IntBox3 = 'INT_BOX_3';
    case DivBox1a = 'DIV_BOX_1A';
    case DivBox1b = 'DIV_BOX_1B';
    case DivBox2a = 'DIV_BOX_2A';
    case DivBox2b = 'DIV_BOX_2B';
    case DivBox2c = 'DIV_BOX_2C';
    case DivBox2d = 'DIV_BOX_2D';
    case DivBox2e = 'DIV_BOX_2E';
    case DivBox2f = 'DIV_BOX_2F';
    case DivBox3 = 'DIV_BOX_3';
    case DivBox4 = 'DIV_BOX_4';
    case DivBox5 = 'DIV_BOX_5';
    case DivBox6 = 'DIV_BOX_6';
    case DivBox7 = 'DIV_BOX_7';
    case DivBox8 = 'DIV_BOX_8';
    case DivBox9 = 'DIV_BOX_9';
    case DivBox10 = 'DIV_BOX_10';
    case DivBox12 = 'DIV_BOX_12';
    case DivBox13 = 'DIV_BOX_13';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'NEC-Box 1' => self::NecBox1,
            'MISC-Box 1' => self::MiscBox1,
            'MISC-Box 2' => self::MiscBox2,
            'MISC-Box 3' => self::MiscBox3,
            'MISC-Box 4' => self::MiscBox4,
            'MISC-Box 5' => self::MiscBox5,
            'MISC-Box 6' => self::MiscBox6,
            'MISC-Box 8' => self::MiscBox8,
            'MISC-Box 9' => self::MiscBox9,
            'MISC-Box 10' => self::MiscBox10,
            'MISC-Box 11' => self::MiscBox11,
            'MISC-Box 12' => self::MiscBox12,
            'MISC-Box 14' => self::MiscBox14,
            'MISC-Box 15' => self::MiscBox15,
            'INT-Box 1' => self::IntBox1,
            'INT-Box 2' => self::IntBox2,
            'INT-Box 3' => self::IntBox3,
            'DIV-Box 1a' => self::DivBox1a,
            'DIV-Box 1b' => self::DivBox1b,
            'DIV-Box 2a' => self::DivBox2a,
            'DIV-Box 2b' => self::DivBox2b,
            'DIV-Box 2c' => self::DivBox2c,
            'DIV-Box 2d' => self::DivBox2d,
            'DIV-Box 2e' => self::DivBox2e,
            'DIV-Box 2f' => self::DivBox2f,
            'DIV-Box 3' => self::DivBox3,
            'DIV-Box 4' => self::DivBox4,
            'DIV-Box 5' => self::DivBox5,
            'DIV-Box 6' => self::DivBox6,
            'DIV-Box 7' => self::DivBox7,
            'DIV-Box 8' => self::DivBox8,
            'DIV-Box 9' => self::DivBox9,
            'DIV-Box 10' => self::DivBox10,
            'DIV-Box 12' => self::DivBox12,
            'DIV-Box 13' => self::DivBox13,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::NecBox1 => 'NEC-Box 1',
            self::MiscBox1 => 'MISC-Box 1',
            self::MiscBox2 => 'MISC-Box 2',
            self::MiscBox3 => 'MISC-Box 3',
            self::MiscBox4 => 'MISC-Box 4',
            self::MiscBox5 => 'MISC-Box 5',
            self::MiscBox6 => 'MISC-Box 6',
            self::MiscBox8 => 'MISC-Box 8',
            self::MiscBox9 => 'MISC-Box 9',
            self::MiscBox10 => 'MISC-Box 10',
            self::MiscBox11 => 'MISC-Box 11',
            self::MiscBox12 => 'MISC-Box 12',
            self::MiscBox14 => 'MISC-Box 14',
            self::MiscBox15 => 'MISC-Box 15',
            self::IntBox1 => 'INT-Box 1',
            self::IntBox2 => 'INT-Box 2',
            self::IntBox3 => 'INT-Box 3',
            self::DivBox1a => 'DIV-Box 1a',
            self::DivBox1b => 'DIV-Box 1b',
            self::DivBox2a => 'DIV-Box 2a',
            self::DivBox2b => 'DIV-Box 2b',
            self::DivBox2c => 'DIV-Box 2c',
            self::DivBox2d => 'DIV-Box 2d',
            self::DivBox2e => 'DIV-Box 2e',
            self::DivBox2f => 'DIV-Box 2f',
            self::DivBox3 => 'DIV-Box 3',
            self::DivBox4 => 'DIV-Box 4',
            self::DivBox5 => 'DIV-Box 5',
            self::DivBox6 => 'DIV-Box 6',
            self::DivBox7 => 'DIV-Box 7',
            self::DivBox8 => 'DIV-Box 8',
            self::DivBox9 => 'DIV-Box 9',
            self::DivBox10 => 'DIV-Box 10',
            self::DivBox12 => 'DIV-Box 12',
            self::DivBox13 => 'DIV-Box 13',
        };
    }
}
