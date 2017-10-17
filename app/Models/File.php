<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class File extends Model
{
    use NodeTrait;

    protected $guarded = ['id'];


}
