<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    // Add all fields you want to allow mass assignment
    protected $fillable = [
        'name',      // <-- ADD THIS
        'slug',
        'status',
        'parent_id',
        'description',
        'image',
        'banner',
        'icon',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'position',
        'is_featured',
        'show_in_menu'
    ];

    // If using casts
    protected $casts = [
        'status' => 'boolean',
        'is_featured' => 'boolean',
        'show_in_menu' => 'boolean',
    ];

    // Parent / Children
    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
