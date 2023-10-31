<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VLPlaceCoordinate extends Model
{
    use HasFactory;
    public $table = 'VLPlaceCoordinate';
    public $primaryKey = 'id_coordinate';
    public $timestamps = false;
}
