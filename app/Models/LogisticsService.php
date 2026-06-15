<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class LogisticsService extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'icon',
        'image_path',
        'link_url',
        'description',
        'base_price',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'base_price' => 'decimal:2',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function getImageUrlAttribute(): string
    {
        $path = $this->image_path ?: 'img/service-1.jpg';

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        return asset(ltrim($path, '/'));
    }

    public function getActionUrlAttribute(): string
    {
        if (! $this->link_url) {
            return route('dashboard');
        }

        if (Str::startsWith($this->link_url, ['http://', 'https://'])) {
            return $this->link_url;
        }

        return url($this->link_url);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(ServiceOrder::class);
    }
}
