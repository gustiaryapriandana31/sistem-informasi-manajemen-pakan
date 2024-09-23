<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    use HasFactory;

    protected $table = 'panens';
    protected $primaryKey = ['id_budidaya', 'tanggal_panen'];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $with = ['budidaya'];

    protected $fillable = [
        'id_budidaya',
        'bobot_akhir_ikan',
        'tanggal_panen'
    ];

    public function budidaya() {
        return $this->belongsTo(Budidaya::class, 'id_budidaya', 'id_budidaya');
    }
}