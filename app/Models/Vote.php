<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Vote extends Model
{
    use HasFactory, SoftDeletes, Notifiable, LogsActivity;

    public $fillable = [
        'voting_id',
        'senator_id',
        'vote',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->useLogName('votes');
    }

    public function senator()
    {
        return $this->belongsTo(Senator::class);
    }

    public function voting()
    {
        return $this->belongsTo(Voting::class);
    }
}
