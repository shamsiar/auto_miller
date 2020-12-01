<?php
namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;
/**
   @property bigint $person_id person id
@property bigint $item_id item id
@property double $quantity quantity
@property double $weight weight
@property enum $transfer_type transfer type
@property int $transfer_id transfer id
@property int $transfered_by transfered by
@property timestamp $transfered_date transfered date
@property int $godown_id godown id
@property enum $status status
@property bigint $user_id user id
@property text $notes notes
@property timestamp $created_at created at
@property timestamp $updated_at updated at
@property User $user belongsTo
@property Godown $godown belongsTo
@property TransferedBy $employee belongsTo
@property Item $item belongsTo
@property Person $person belongsTo
   
 */
class Stock extends Model 
{
    const STATUS_IN='in';

const STATUS_OUT='out';

const TRANSFER_TYPE_PURCHASE='purchase';

const TRANSFER_TYPE_RECEIVE='receive';

const TRANSFER_TYPE_SALE='sale';

    /**
    * Database table name
    */
    protected $table = 'stocks';

    /**
    * Mass assignable columns
    */
    protected $fillable=['person_id',
'item_id',
'quantity',
'weight',
'transfer_type',
'transfer_id',
'transfered_by',
'transfered_date',
'godown_id',
'status',
'user_id',
'notes'];

    /**
    * Date time columns.
    */
    protected $dates=['transfered_date'];

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
    * godown
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function godown()
    {
        return $this->belongsTo(Godown::class,'godown_id');
    }

    /**
    * transferedBy
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function transferedBy()
    {
        return $this->belongsTo(Employee::class,'transfered_by');
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
    * person
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function person()
    {
        return $this->belongsTo(Person::class,'person_id');
    }




}