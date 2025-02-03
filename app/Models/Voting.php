<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Voting extends Model
{
    use HasFactory, Notifiable, SoftDeletes, LogsActivity;

    protected $fillable = ['name', 'voting_uri', 'main_vote', 'image_url'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->useLogName('voting');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function voteInFavor()
    {
        return $this->hasMany(Vote::class)->where('vote', 'Y');
    }

    public function voteAgainst()
    {
        return $this->hasMany(Vote::class)->where('vote', 'N');
    }

    public function voteIndefinite()
    {
        return $this->hasMany(Vote::class)->where('vote', 'I');
    }
}
