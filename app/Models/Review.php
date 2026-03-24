<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['menu_id', 'user_name', 'comment', 'stars'];
    public function menu()
{
    return $this->belongsTo(Menu::class);
}
}
