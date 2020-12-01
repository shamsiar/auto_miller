<?php
namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;
/**
   @property bigint $sale_id sale id
@property bigint $item_id item id
@property double $quantity quantity
@property double $weight weight
@property double $cost_price cost price
@property double $unit_price unit price
@property double $total_amount total amount
@property double $profit profit
@property text $notes notes
@property Item $item belongsTo
@property Sale $sale belongsTo
   
 */
class SaleItem extends Model 
{
    
    /**
    * Database table name
    */
    protected $table = 'sale_items';

    /**
    * Mass assignable columns
    */
    protected $fillable=['notes',
'sale_id',
'item_id',
'quantity',
'weight',
'cost_price',
'unit_price',
'total_amount',
'profit',
'notes'];

    /**
    * Date time columns.
    */
    protected $dates=[];

    /**
    * item
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function item()
    {
        return $this->belongsTo(Item::class,'item_id');
    }

    /**
    * sale
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function sale()
    {
        return $this->belongsTo(Sale::class,'sale_id');
    }




}