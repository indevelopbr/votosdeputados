<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Voto extends Model
{
    use HasFactory, Notifiable, SoftDeletes, LogsActivity;

    protected $table = 'votos';

    protected $fillable = [
        'votacao_id',
        'senador_id',
        'partido_id',
        'sigla_casa_parlamentar',
        'qualidade_voto',
        'voto_presidente'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->useLogName('voto');
    }

    public function senador()
    {
        return $this->belongsTo(Senador::class, 'senador_id', 'id')->withTrashed();
    }
}
