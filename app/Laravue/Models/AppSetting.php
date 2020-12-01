<?php
namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;
/**
   @property varchar $key key
@property text $value value
   
 */
class AppSetting extends Model 
{
    
    /**
    * Database table name
    */
    protected $table = 'app_settings';

    /**
    * Mass assignable columns
    */
    protected $fillable=['value',
'key',
'value'];

    /**
    * Date time columns.
    */
    protected $dates=[];




}