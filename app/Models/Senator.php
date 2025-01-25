<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Senator extends Model
{
    use HasFactory, SoftDeletes, Notifiable, LogsActivity;

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'uf',
        'image_profile',
        'facebook',
        'instagram',
        'twitter',
        'site',
        'birth_date',
        're_election',
        'party_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->useLogName('senador');
    }

    public function party()
    {
        return $this->belongsTo(Party::class);
    }

    public function getReElection()
    {
        return Carbon::parse($this->re_election)->format('Y');
    }
}
