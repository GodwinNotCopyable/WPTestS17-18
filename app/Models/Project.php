<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    /**
     * Resolve the thumbnail path relative to the public disk.
     */
    public function getThumbnailPathAttribute(): ?string
    {
        if (! $this->thumbnail || Str::startsWith($this->thumbnail, ['http://', 'https://'])) {
            return null;
        }

        if (Str::startsWith($this->thumbnail, ['/storage/', 'storage/'])) {
            return Str::after(ltrim($this->thumbnail, '/'), 'storage/');
        }

        return ltrim($this->thumbnail, '/');
    }

    /**
     * Get a URL for displaying the thumbnail.
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        if (! $this->thumbnail) {
            return null;
        }

        if (Str::startsWith($this->thumbnail, ['http://', 'https://'])) {
            return $this->thumbnail;
        }

        return Storage::disk('public')->url($this->thumbnail_path ?? ltrim($this->thumbnail, '/'));
    }
}
