<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products_log extends Model
{
    use HasFactory;
    protected $table = 'products_logs';
    protected $primaryKey = 'products_logs_id';
}
