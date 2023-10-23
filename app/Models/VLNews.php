<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VLNews extends Model
{
    use HasFactory;
    public $table = 'VLNews';
    public $primaryKey = 'id_new';
    public $timestamps = false;
}
