<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budidaya extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_budidaya';
    public $incrementing = false;
    protected $keyType = 'string';
    
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['ikan', 'pakan'];

    protected $fillable = [
        'id_budidaya',
        'nama_budidaya',
        'id_ikan',
        'id_pakan',
        'jumlah_tebar_ikan',
        'bobot_awal_ikan',
        'lama_budidaya',
        'tanggal_tebar',
    ];

    public function ikan() {
        return $this->belongsTo(Ikan::class, 'id_ikan');
    }
    
    public function pakan() {
        return $this->belongsTo(Pakan::class, 'id_pakan');
    }

    public function feedings() {
        return $this->hasMany(Feeding::class, 'id_budidaya', 'id_budidaya');
    }
    
    public function panen() {
        return $this->hasOne(Panen::class, 'id_budidaya', 'id_budidaya');
    }
}