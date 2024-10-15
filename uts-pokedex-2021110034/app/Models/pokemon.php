<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pokemon extends Model
{
    protected $guarded = ['id'];
    protected $table = 'pokemon';
    public $timestamps = FALSE;
}
