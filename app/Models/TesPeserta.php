<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TesPeserta extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'email', 'pre_test', 'post_test'];
}
