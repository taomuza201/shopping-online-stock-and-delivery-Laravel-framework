<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal_tag extends Model
{
    use HasFactory;
    protected $table = 'proposal_tags';
    protected $primaryKey = 'proposal_tags_id';
}
