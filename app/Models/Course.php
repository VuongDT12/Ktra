<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'description',
        'image',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    protected static function booted()
    {
        static::creating(function ($course) {
            if (empty($course->slug)) {
                $course->slug = static::generateUniqueSlug($course->name);
            }
        });

        static::updating(function ($course) {
            if (empty($course->slug)) {
                $course->slug = static::generateUniqueSlug($course->name, $course->id);
            }
        });
    }

    protected static function generateUniqueSlug(string $name, ?int $exceptId = null): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $count = 1;

        while (static::where('slug', $slug)
            ->when($exceptId !== null, fn ($query) => $query->where('id', '<>', $exceptId))
            ->exists()) {
            $slug = sprintf('%s-%d', $original, $count++);
        }

        return $slug;
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('order');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopePriceBetween($query, $min, $max)
    {
        return $query->when($min !== null, fn ($query) => $query->where('price', '>=', $min))
            ->when($max !== null, fn ($query) => $query->where('price', '<=', $max));
    }
}
