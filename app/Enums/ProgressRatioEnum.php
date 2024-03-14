<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProgressRatioEnum extends Enum
{
    // 件数
    const SHIPMENT_ORDER_QUANTITY_PROGRESS_RATIO_NAME   = '進捗率(件数)';
    const SHIPMENT_ORDER_QUANTITY                       = 'shipment_order_quantity';
    const INSPECTION_INCOMPLETE_SHIPMENT_ORDER_QUANTITY = 'inspection_incomplete_shipment_order_quantity';
    // PCS数
    const SHIPMENT_QUANTITY_PCS_PROGRESS_RATIO_NAME     = '進捗率(PCS数)';
    const SHIPMENT_QUANTITY_PCS                         = 'shipment_quantity_pcs';
    const INSPECTION_INCOMPLETE_SHIPMENT_QUANTITY_PCS   = 'inspection_incomplete_shipment_quantity_pcs';
    // CS数
    const SHIPMENT_QUANTITY_CS_PROGRESS_RATIO_NAME     = '進捗率(CS数)';
    const SHIPMENT_QUANTITY_CS                         = 'shipment_quantity_cs';
    const INSPECTION_INCOMPLETE_SHIPMENT_QUANTITY_CS   = 'inspection_incomplete_shipment_quantity_cs';
}
