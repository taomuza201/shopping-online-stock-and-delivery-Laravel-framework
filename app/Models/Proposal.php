<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;
    protected $table = 'proposals';
    protected $primaryKey = 'proposals_id';

    protected $fillable = [
        'proposals_name',
        'proposals_about',
        'proposals_price_cost',
        'proposals_price',
        'proposals_amount',
        'proposals_cover_photo',
        'proposals_story',
        'proposals_owner_id',
    ];

}
