<?php
namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;
/**
   @property varchar $name name
@property varchar $image image
@property \Illuminate\Database\Eloquent\Collection $personhass belongsToMany
   
 */
class Type extends Model 
{
    
    /**
    * Database table name
    */
    protected $table = 'types';

    /**
    * Mass assignable columns
    */
    protected $fillable=['image',
'name',
'image'];

    /**
    * Date time columns.
    */
    protected $dates=[];

    /**
    * personhasses
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function personhasses()
    {
        return $this->belongsToMany(Personhass::class,'person_has_types');
    }



}