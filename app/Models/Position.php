<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = ['name'];


    public function employees()
    {
        return $this->hasMany(UserProfile::class);
    }

    public function comfortCategories()
    {
        return $this->belongsToMany(ComfortCategory::class, 'position_comfort_category');
    }
}
