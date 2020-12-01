<?php
namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;
/**
   @property varchar $name name
@property varchar $item_type item type
@property text $details details
@property int $category_id category id
@property tinyint $status status
@property varchar $image image
@property tinyint $soft_delete soft delete
@property bigint $modifier_id modifier id
@property timestamp $created_at created at
@property timestamp $updated_at updated at
@property Modifier $user belongsTo
@property Category $category belongsTo
@property \Illuminate\Database\Eloquent\Collection $purchasedItem hasMany
@property \Illuminate\Database\Eloquent\Collection $receivedItem hasMany
@property \Illuminate\Database\Eloquent\Collection $saleItem hasMany
@property \Illuminate\Database\Eloquent\Collection $stock hasMany
   
 */
class Item extends Model 
{
    
    /**
    * Database table name
    */
    protected $table = 'items';

    /**
    * Mass assignable columns
    */
    protected $fillable=['name',
'item_type',
'details',
'category_id',
'status',
'image',
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
    * category
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    /**
    * purchasedItems
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function purchasedItems()
    {
        return $this->hasMany(PurchasedItem::class,'item_id');
    }
    /**
    * receivedItems
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function receivedItems()
    {
        return $this->hasMany(ReceivedItem::class,'item_id');
    }
    /**
    * saleItems
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class,'item_id');
    }
    /**
    * stocks
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function stocks()
    {
        return $this->hasMany(Stock::class,'item_id');
    }



}