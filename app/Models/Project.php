<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $casts = [
        'technologies' => 'array',
        'published' => 'boolean',
        'order' => 'integer',
        'github_id' => 'integer',
        'stargazers_count' => 'integer',
        'forks_count' => 'integer',
    ];

    protected $fillable = [
        'user_id',
        'title',
        'github_id',
        'name',
        'html_url',
        'description',
        'long_description',
        'image',
        'github_url',
        'live_url',
        'technologies',
        'status',
        'order',
        'language',
        'stargazers_count',
        'forks_count',
    ];

    /**
     * Accessors for GitHub data display.
     */
    public function getTitleAttribute(): string
    {
        return $this->name ?? $this->title ?? 'Untitled Project';
    }

    /** Local scope to optionally filter published projects. */
    public function scopePublished($query)
    {
        $table = $query->getModel()->getTable();
        if (Schema::hasColumn($table, 'published')) {
            return $query->where('published', true);
        }
        return $query;
    }
}
