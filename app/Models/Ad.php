<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price'];

    protected $hidden = ['id', 'created_at', 'updated_at'];

    public function links()
    {
        return $this->hasMany('App\Models\Link');
    }
}
