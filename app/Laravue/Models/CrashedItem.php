<?php
namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;
/**
   @property bigint $purchase_item_id purchase item id
@property int $employee_id employee id
@property double $quantity quantity
@property double $status status
@property varchar $token token
@property text $notes notes
@property timestamp $created_at created at
@property timestamp $updated_at updated at
@property Employee $employee belongsTo
@property PurchaseItem $purchasedItem belongsTo
@property \Illuminate\Database\Eloquent\Collection $receivedItem hasMany
   
 */
class CrashedItem extends Model 
{
    
    /**
    * Database table name
    */
    protected $table = 'crashed_items';

    /**
    * Mass assignable columns
    */
    protected $fillable=['purchase_item_id',
'employee_id',
'quantity',
'status',
'token',
'notes'];

    /**
    * Date time columns.
    */
    protected $dates=[];

    /**
    * employee
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
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

    /**
    * receivedItems
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function receivedItems()
    {
        return $this->hasMany(ReceivedItem::class,'crash_item_id');
    }



}