<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
// use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\Model;
class DemoMongo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $connection = 'mongodb';
    // protected $collection = '860987054429532';
    protected $collection = 'FT106';
    
    protected $fillable = [
        '_id', 'imei','uid','dtm','seq','sysv'
    ];
}

 