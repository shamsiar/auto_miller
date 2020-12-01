<?php
namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;
/**
   @property varchar $name name
@property varchar $location location
@property tinyint $status status
@property \Illuminate\Database\Eloquent\Collection $stock hasMany
   
 */
class Godown extends Model 
{
    
    /**
    * Database table name
    */
    protected $table = 'godowns';

    /**
    * Mass assignable columns
    */
    protected $fillable=['status',
'name',
'location',
'status'];

    /**
    * Date time columns.
    */
    protected $dates=[];

    /**
    * stocks
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function stocks()
    {
        return $this->hasMany(Stock::class,'godown_id');
    }



}