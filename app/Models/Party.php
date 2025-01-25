<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Party extends Model
{
    use HasFactory, SoftDeletes, Notifiable, LogsActivity;

    protected $fillable = ['id', 'name', 'acronym', 'image_logo', 'foundation_date', 'extinction_date'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->useLogName('party');
    }
}
