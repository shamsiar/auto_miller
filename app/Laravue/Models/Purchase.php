<?php
namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;
/**
   @property bigint $person_id person id
@property int $receiver_id receiver id
@property int $bank_id bank id
@property double $amount amount
@property double $quantity_purchased quantity purchased
@property double $quantity_received quantity received
@property varchar $token token
@property varchar $vechile_info vechile info
@property timestamp $purchase_date purchase date
@property tinyint $store_account_payment store account payment
@property text $notes notes
@property enum $status status
@property bigint $user_id user id
@property tinyint $soft_delete soft delete
@property bigint $modifier_id modifier id
@property timestamp $created_at created at
@property timestamp $updated_at updated at
@property Modifier $user belongsTo
@property User $user belongsTo
@property Bank $bank belongsTo
@property Receiver $employee belongsTo
@property Person $person belongsTo
@property \Illuminate\Database\Eloquent\Collection $purchasedItem hasMany
@property \Illuminate\Database\Eloquent\Collection $storeAccount hasMany
   
 */
class Purchase extends Model 
{
    const STATUS_PROCESSING='processing';

const STATUS_UNLOADING='unloading';

const STATUS_STOCKED='stocked';

    /**
    * Database table name
    */
    protected $table = 'purchases';

    /**
    * Mass assignable columns
    */
    protected $fillable=['person_id',
'receiver_id',
'bank_id',
'amount',
'quantity_purchased',
'quantity_received',
'token',
'vechile_info',
'purchase_date',
'store_account_payment',
'notes',
'status',
'user_id',
'soft_delete',
'modifier_id'];

    /**
    * Date time columns.
    */
    protected $dates=['purchase_date'];

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
    * user
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    /**
    * bank
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function bank()
    {
        return $this->belongsTo(Bank::class,'bank_id');
    }

    /**
    * receiver
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function receiver()
    {
        return $this->belongsTo(Employee::class,'receiver_id');
    }

    /**
    * person
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function person()
    {
        return $this->belongsTo(Person::class,'person_id');
    }

    /**
    * purchasedItems
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function purchasedItems()
    {
        return $this->hasMany(PurchasedItem::class,'purchase_id');
    }
    /**
    * storeAccounts
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function storeAccounts()
    {
        return $this->hasMany(StoreAccount::class,'purchase_id');
    }



}