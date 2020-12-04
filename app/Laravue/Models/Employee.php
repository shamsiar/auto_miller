<?php

namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property varchar $name name
 * @property varchar $emp_type emp type
 * @property int $salary salary
 * @property tinyint $status status
 * @property \Illuminate\Database\Eloquent\Collection $crashedItem hasMany
 * @property \Illuminate\Database\Eloquent\Collection $purchase hasMany
 * @property \Illuminate\Database\Eloquent\Collection $sale hasMany
 * @property \Illuminate\Database\Eloquent\Collection $stock hasMany
 */
class Employee extends Model
{

    /**
     * Database table name
     */
    protected $table = 'employees';

    /**
     * Mass assignable columns
     */
    protected $fillable = [
        'status',
        'name',
        'emp_type',
        'salary',
//        'status'
    ];

    /**
     * Date time columns.
     */
    protected $dates = [];

    /**
     * crashedItems
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function crashedItems() {
        return $this->hasMany( CrashedItem::class, 'employee_id' );
    }

    /**
     * purchases
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchases() {
        return $this->hasMany( Purchase::class, 'receiver_id' );
    }

    /**
     * sales
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sales() {
        return $this->hasMany( Sale::class, 'sold_by' );
    }

    /**
     * stocks
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stocks() {
        return $this->hasMany( Stock::class, 'transfered_by' );
    }


}