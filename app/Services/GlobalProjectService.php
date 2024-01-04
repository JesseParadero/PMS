<?php

use App\Models\ProgrammingLevelItem;

class pms
{
    public static function mProgrammingLevelItem(): ProgrammingLevelItem
    {
        return resolve(ProgrammingLevelItem::class);
    }
}
