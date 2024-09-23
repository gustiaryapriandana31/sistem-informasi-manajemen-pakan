<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeding extends Model
{
    use HasFactory;

    protected $table = 'feedings';
    protected $primaryKey = ['id_budidaya', 'tanggal_feeding'];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $with = ['budidaya'];

    protected $fillable = [
        'id_budidaya',
        'berat_pakan',
        'jangka_waktu',
        'tanggal_feeding'
    ];

    public function budidaya() {
        return $this->belongsTo(Budidaya::class, 'id_budidaya', 'id_budidaya');
    }
}