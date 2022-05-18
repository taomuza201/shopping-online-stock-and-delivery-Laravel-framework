<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoldDetail extends Model
{
    use HasFactory;
    protected $table = 'hold_details';
    protected $primaryKey = 'hold_details_id';
}
