<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'lending_date',
        'recover_date',
    ];
}
