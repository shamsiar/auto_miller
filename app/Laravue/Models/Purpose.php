<?php
namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;
/**
   @property varchar $name name
@property varchar $reason reason
@property smallint $parent_id parent id
@property \Illuminate\Database\Eloquent\Collection $transaction hasMany
   
 */
class Purpose extends Model 
{
    
    /**
    * Database table name
    */
    protected $table = 'purposes';

    /**
    * Mass assignable columns
    */
    protected $fillable=['parent_id',
'name',
'reason',
'parent_id'];

    /**
    * Date time columns.
    */
    protected $dates=[];

    /**
    * transactions
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function transactions()
    {
        return $this->hasMany(Transaction::class,'purpose_id');
    }



}