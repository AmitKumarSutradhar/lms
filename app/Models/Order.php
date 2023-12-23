<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class,'user_id','id');
    }

    public function payment(){
        return $this->belongsTo(Payment::class,'payment_id','id');
    }

    public function course(){
        return $this->belongsTo(Course::class,'course_id','id');
    }

    public function instructor(){
        return $this->belongsTo(User::class,'instructor_id','id');
    }
}
