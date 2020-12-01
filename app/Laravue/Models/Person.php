<?php
namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;
/**
   @property varchar $name name
@property varchar $mobile mobile
@property varchar $phone phone
@property varchar $company company
@property text $address address
@property varchar $email email
@property varchar $image image
@property int $bank_id bank id
@property varchar $bank_account bank account
@property tinyint $status status
@property tinyint $soft_delete soft delete
@property bigint $modifier_id modifier id
@property timestamp $created_at created at
@property timestamp $updated_at updated at
@property Modifier $user belongsTo
@property Bank $bank belongsTo
@property \Illuminate\Database\Eloquent\Collection $hastype belongsToMany
@property \Illuminate\Database\Eloquent\Collection $purchase hasMany
@property \Illuminate\Database\Eloquent\Collection $sale hasMany
@property \Illuminate\Database\Eloquent\Collection $stock hasMany
@property \Illuminate\Database\Eloquent\Collection $storeAccount hasMany
@property \Illuminate\Database\Eloquent\Collection $transaction hasMany
   
 */
class Person extends Model 
{
    
    /**
    * Database table name
    */
    protected $table = 'people';

    /**
    * Mass assignable columns
    */
    protected $fillable=['name',
'mobile',
'phone',
'company',
'address',
'email',
'image',
'bank_id',
'bank_account',
'status',
'soft_delete',
'modifier_id'];

    /**
    * Date time columns.
    */
    protected $dates=[];

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
    * bank
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function bank()
    {
        return $this->belongsTo(Bank::class,'bank_id');
    }

    /**
    * hastypes
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function hastypes()
    {
        return $this->belongsToMany(PersonHastype::class,'person_has_types');
    }
    /**
    * purchases
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function purchases()
    {
        return $this->hasMany(Purchase::class,'person_id');
    }
    /**
    * sales
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function sales()
    {
        return $this->hasMany(Sale::class,'person_id');
    }
    /**
    * stocks
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function stocks()
    {
        return $this->hasMany(Stock::class,'person_id');
    }
    /**
    * storeAccounts
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function storeAccounts()
    {
        return $this->hasMany(StoreAccount::class,'person_id');
    }
    /**
    * transactions
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function transactions()
    {
        return $this->hasMany(Transaction::class,'person_id');
    }



}