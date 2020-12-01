<?php
namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;
/**
   @property int $type_id type id
@property Type $type belongsTo
   
 */
class PersonHasType extends Model 
{
    
    /**
    * Database table name
    */
    protected $table = 'person_has_types';

    /**
    * Mass assignable columns
    */
    protected $fillable = [
        'person_id',
        'type_id'
    ];

    /**
    * Date time columns.
    */
    protected $dates=[];

    /**
    * type
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function type()
    {
        return $this->belongsTo(Type::class,'type_id');
    }

    public function person()
    {
        return $this->belongsTo(Person::class,'person_id');
    }




}