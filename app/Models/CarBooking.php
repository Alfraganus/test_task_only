<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBooking extends Model
{
    use HasFactory;

    protected $fillable = ['car_id', 'employee_id', 'start_time', 'end_time'];


    public function car()
    {
        return $this->belongsTo(Car::class);
    }


    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class,'user_id','employee_id ');
    }
}
