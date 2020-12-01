<?php

namespace App\Laravue\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * Database table name
     */
    protected $table = 'categories';

    /**
     * Mass assignable columns
     */
    protected $fillable=['name',
        'parent_id',
        'unit',
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
     * items
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(Item::class,'category_id');
    }



}
