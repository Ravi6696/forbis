<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlockedUser extends BaseModel
{
    use SoftDeletes;
    //
}