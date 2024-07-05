<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PCNameEnum extends Enum
{
    const KATAHIRA  = 'WARM-KATAHIRA';
    const TAMURA    = 'WARM-TAMURA';

    // 進捗の更新が許可されているPC名であるか確認
    public static function checkExclusionPCName($pc_name)
    {
        if($pc_name !== self::KATAHIRA && $pc_name !== self::TAMURA){
            return true;
        }else{
            return false;
        }
    }
}
