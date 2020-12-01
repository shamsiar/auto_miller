<?php
namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;
/**
   @property bigint $person_id person id
@property bigint $sale_id sale id
@property bigint $purchase_id purchase id
@property double $transaction_amount transaction amount
@property double $balance balance
@property timestamp $transaction_date transaction date
@property text $note note
@property timestamp $created_at created at
@property timestamp $updated_at updated at
@property Purchase $purchase belongsTo
@property Sale $sale belongsTo
@property Person $person belongsTo
   
 */
class StoreAccount extends Model 
{
    
    /**
    * Database table name
    */
    protected $table = 'store_accounts';

    /**
    * Mass assignable columns
    */
    protected $fillable=['person_id',
'sale_id',
'purchase_id',
'transaction_amount',
'balance',
'transaction_date',
'note'];

    /**
    * Date time columns.
    */
    protected $dates=['transaction_date'];

    /**
    * purchase
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function purchase()
    {
        return $this->belongsTo(Purchase::class,'purchase_id');
    }

    /**
    * sale
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function sale()
    {
        return $this->belongsTo(Sale::class,'sale_id');
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