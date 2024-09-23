<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pakan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function budidayas() {
        return $this->hasMany(Budidaya::class);
    }
}