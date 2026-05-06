<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class CustomizedFeature extends Model
{
    /**
     * Force customized-feature models to use the dedicated SQLite database.
     */
    protected $connection = 'sqlite_custom';

    protected $guarded = [];
}
