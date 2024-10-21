<?php

namespace App\Models\Iptv;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class DealerInvoice
 *
 * @property float $amount
 * @property int $dealer_id
 */
class DealerInvoice extends BaseModel
{
    protected $fillable = [
        'amount',
        'dealer_id',
    ];

    public function dealer(): BelongsTo
    {
        return $this->belongsTo(Dealer::class);
    }
}
