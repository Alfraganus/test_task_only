<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionComfortCategory extends Model
{
    use HasFactory;

    protected $table = 'position_comfort_category';

    protected $fillable = [
        'position_id',
        'comfort_category_id',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function comfortCategory()
    {
        return $this->belongsTo(ComfortCategory::class);
    }
}
