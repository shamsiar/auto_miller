<?php
namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;
/**
   @property varchar $name name
@property varchar $branch branch
@property text $location location
@property tinyint $status status
@property \Illuminate\Database\Eloquent\Collection $person hasMany
@property \Illuminate\Database\Eloquent\Collection $purchase hasMany
@property \Illuminate\Database\Eloquent\Collection $sale hasMany
@property \Illuminate\Database\Eloquent\Collection $transaction hasMany
   
 */
class Bank extends Model 
{
    
    /**
    * Database table name
    */
    protected $table = 'banks';

    /**
    * Mass assignable columns
    */
    protected $fillable=[
        'name',
        'branch',
        'location',
        'status'
    ];

    /**
    * Date time columns.
    */
    protected $dates=[];

    /**
    * people
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function people()
    {
        return $this->hasMany(Person::class,'bank_id');
    }
    /**
    * purchases
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function purchases()
    {
        return $this->hasMany(Purchase::class,'bank_id');
    }
    /**
    * sales
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function sales()
    {
        return $this->hasMany(Sale::class,'bank_id');
    }
    /**
    * transactions
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function transactions()
    {
        return $this->hasMany(Transaction::class,'bank_id');
    }



}