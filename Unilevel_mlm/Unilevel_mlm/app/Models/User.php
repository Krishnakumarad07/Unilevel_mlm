<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'email',
        'password',
        'referral_code',
        'referred_by',
        'level',
        'total_referrals',
    ];

    protected static function boot()
    {
        parent::boot();

        // Auto-generate referral code on creating
        static::creating(function ($user) {
            $user->referral_code = strtoupper(Str::random(6));
        });

        // Increment total_referrals and set level
        static::created(function ($user) {
            if ($user->referred_by) {
                $referrer = self::find($user->referred_by);
                if ($referrer) {
                    $referrer->increment('total_referrals');
                    $user->level = $referrer->level + 1;
                    $user->save();
                }
            }
        });
    }

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    // Recursive function to get all downlines
    public function downlines()
    {
        $downlines = [];
        foreach ($this->referrals as $referral) {
            $downlines[] = [
                'user' => $referral,
                'downlines' => $referral->downlines(),
            ];
        }
        return $downlines;
    }
}
