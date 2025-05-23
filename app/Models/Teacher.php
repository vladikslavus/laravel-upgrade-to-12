<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function monitor()
    {
        // 1-й параметр это конечная модель/ 2-q через какую модель
        return $this->hasOneThrough(Monitor::class, Classroom::class); // Порядок обязателен, мы через монитора получам связь с классом
    }
}
