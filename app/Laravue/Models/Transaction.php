<?php
namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;
/**
   @property enum $transaction_type transaction type
@property double $amount amount
@property timestamp $date date
@property smallint $purpose_id purpose id
@property int $bank_id bank id
@property bigint $person_id person id
@property varchar $account account
@property bigint $user_id user id
@property tinyint $soft_delete soft delete
@property bigint $modifier_id modifier id
@property timestamp $created_at created at
@property timestamp $updated_at updated at
@property Modifier $user belongsTo
@property User $user belongsTo
@property Person $person belongsTo
@property Bank $bank belongsTo
@property Purpose $purpose belongsTo
   
 */
class Transaction extends Model 
{
    const TRANSACTION_TYPE_CREDIT='credit';

const TRANSACTION_TYPE_DEBIT='debit';

    /**
    * Database table name
    */
    protected $table = 'transactions';

    /**
    * Mass assignable columns
    */
    protected $fillable=['transaction_type',
'amount',
'date',
'purpose_id',
'bank_id',
'person_id',
'account',
'user_id',
'soft_delete',
'modifier_id'];

    /**
    * Date time columns.
    */
    protected $dates=['date'];

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
    * person
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function person()
    {
        return $this->belongsTo(Person::class,'person_id');
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
    * purpose
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function purpose()
    {
        return $this->belongsTo(Purpose::class,'purpose_id');
    }




}