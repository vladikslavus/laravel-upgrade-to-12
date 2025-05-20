<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory; // Для создания тестовых данных

    protected $fillable = ['name']; // В нашем случае, чтобы могли через Seeder создать для теста

    public function latestGrade(): HasOne
    {
        return $this->hasOne(Grade::class)->latestOfMany();
    }

    public function firstGrade(): HasOne
    {
        return $this->hasOne(Grade::class)->oldestOfMany();
    }

    public function highestGrade(): HasOne
    {
        return $this->hasOne(Grade::class)->ofMany('score', 'max'); // и во внутрь пробрасываем условие
    }

    public function lowestGrade(): HasOne
    {
        return $this->hasOne(Grade::class)->ofMany('score', 'min');
    }

    public function latestValidGrade(): HasOne
    {
        // return $this->hasOne(Grade::class)->ofMany(['received_at' => 'max', 'score' => 'min']);
        // Тоже самое используя замыкание
        return $this->hasOne(Grade::class)->ofMany(['score' => 'min'], function ($query) {
            $query->where('received_at', '<=', Carbon::parse('2023-09-07'));
        });
    }

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class, 'student_id');
    }
}
