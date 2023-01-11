<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContractShipment extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'contract_shipments';
    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class)->with('chiefdom');
    }

    /**
     * @return BelongsTo
     */
    public function squad(): BelongsTo
    {
        return $this->belongsTo(Squad::class);
    }

    /**
     * @return BelongsTo
     */
    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class, 'exit_product_type_id');
    }

    /**
     * @return BelongsTo
     */
    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }

    /**
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'exit_city_id');
    }

    /**
     * @return BelongsTo
     */
    public function arrivalLocation(): BelongsTo
    {
        return $this->belongsTo(ArrivalLocation::class, 'arrival_location_id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'exit_user_id');
    }
}
