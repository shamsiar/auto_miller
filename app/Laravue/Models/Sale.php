<?php
namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;
/**
   @property bigint $person_id person id
@property int $sold_by sold by
@property int $bank_id bank id
@property double $amount amount
@property double $profit profit
@property varchar $discount discount
@property date $sale_date sale date
@property bigint $user_id user id
@property tinyint $soft_delete soft delete
@property bigint $modifier_id modifier id
@property timestamp $created_at created at
@property timestamp $updated_at updated at
@property Modifier $user belongsTo
@property User $user belongsTo
@property Bank $bank belongsTo
@property SoldBy $employee belongsTo
@property Person $person belongsTo
@property \Illuminate\Database\Eloquent\Collection $saleItem hasMany
@property \Illuminate\Database\Eloquent\Collection $storeAccount hasMany
   
 */
class Sale extends Model 
{
    
    /**
    * Database table name
    */
    protected $table = 'sales';

    /**
    * Mass assignable columns
    */
    protected $fillable=['person_id',
'sold_by',
'bank_id',
'amount',
'profit',
'discount',
'sale_date',
'user_id',
'soft_delete',
'modifier_id'];

    /**
    * Date time columns.
    */
    protected $dates=['sale_date'];

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
    * soldBy
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function soldBy()
    {
        return $this->belongsTo(Employee::class,'sold_by');
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
    * saleItems
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class,'sale_id');
    }
    /**
    * storeAccounts
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function storeAccounts()
    {
        return $this->hasMany(StoreAccount::class,'sale_id');
    }



}