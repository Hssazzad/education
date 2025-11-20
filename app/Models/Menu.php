<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected $fillable = ['title', 'url', 'icon', 'parent_id', 'sequence'];

    // dropdown menus relation
    public function children() {
        return $this->hasMany(Menu::class, 'parent_id', 'id')->orderBy('sequence');
    }
}
