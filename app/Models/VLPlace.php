<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VLPlace extends Model
{
    use HasFactory;
    public $table = 'VLPlace';
    public $primaryKey = 'id_place';
    public $timestamps = false;
}