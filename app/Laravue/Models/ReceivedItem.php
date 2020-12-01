<?php
namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;
/**
   @property bigint $purchase_item_id purchase item id
@property bigint $crash_item_id crash item id
@property bigint $item_id item id
@property double $total_weight total weight
@property double $quantity quantity
@property double $sell_price sell price
@property double $profit profit
@property date $expire_date expire date
@property date $receive_date receive date
@property tinyint $status status
@property text $notes notes
@property tinyint $soft_delete soft delete
@property bigint $modifier_id modifier id
@property timestamp $created_at created at
@property timestamp $updated_at updated at
@property Modifier $user belongsTo
@property Item $item belongsTo
@property CrashItem $crashedItem belongsTo
@property PurchaseItem $purchasedItem belongsTo
   
 */
class ReceivedItem extends Model 
{
    
    /**
    * Database table name
    */
    protected $table = 'received_items';

    /**
    * Mass assignable columns
    */
    protected $fillable=['purchase_item_id',
'crash_item_id',
'item_id',
'total_weight',
'quantity',
'sell_price',
'profit',
'expire_date',
'receive_date',
'status',
'notes',
'soft_delete',
'modifier_id'];

    /**
    * Date time columns.
    */
    protected $dates=['expire_date',
'receive_date'];

    /**
    * modifier
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function modifier()
    {
        return $this->belongsTo(User::class,'modifier_id');
    }

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
    * crashItem
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function crashItem()
    {
        return $this->belongsTo(CrashedItem::class,'crash_item_id');
    }

    /**
    * purchaseItem
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function purchaseItem()
    {
        return $this->belongsTo(PurchasedItem::class,'purchase_item_id');
    }




}