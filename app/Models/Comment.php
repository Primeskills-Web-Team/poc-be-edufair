<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
 
    const REJECTED = 0;
    const APPROVED = 1;
    const PENDING = 2;
    
    protected $guarded = [];
}
