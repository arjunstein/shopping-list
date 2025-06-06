<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    // Set rule for some attributes when saving & updating
    protected static function booted()
    {
        static::saving(function ($model) {
            $model->name = Str::title($model->name);
            $model->description = ucfirst($model->description);
        });
    }
}
