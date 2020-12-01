<?php
namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;
/**
   @property bigint $purchase_id purchase id
@property bigint $item_id item id
@property double $quantity_purchased quantity purchased
@property double $quantity_received quantity received
@property double $total_cost total cost
@property double $cost_per_unit cost per unit
@property date $expire_date expire date
@property double $amount amount
@property timestamp $created_at created at
@property timestamp $updated_at updated at
@property Item $item belongsTo
@property Purchase $purchase belongsTo
@property \Illuminate\Database\Eloquent\Collection $crashedItem hasMany
@property \Illuminate\Database\Eloquent\Collection $receivedItem hasMany
   
 */
class PurchasedItem extends Model 
{
    
    /**
    * Database table name
    */
    protected $table = 'purchased_items';

    /**
    * Mass assignable columns
    */
    protected $fillable=['purchase_id',
'item_id',
'quantity_purchased',
'quantity_received',
'total_cost',
'cost_per_unit',
'expire_date',
'amount'];

    /**
    * Date time columns.
    */
    protected $dates=['expire_date'];

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
    * purchase
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function purchase()
    {
        return $this->belongsTo(Purchase::class,'purchase_id');
    }

    /**
    * crashedItems
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function crashedItems()
    {
        return $this->hasMany(CrashedItem::class,'purchase_item_id');
    }
    /**
    * receivedItems
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function receivedItems()
    {
        return $this->hasMany(ReceivedItem::class,'purchase_item_id');
    }



}