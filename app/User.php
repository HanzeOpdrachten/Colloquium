<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const ADMIN = 1;
    const PLANNER = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Check if the user is an administrator.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return ($this->attributes['role'] == self::ADMIN);
    }

    /**
     * Check if the user is a planner.
     *
     * @return bool
     */
    public function isPlanner()
    {
        return ($this->attributes['role'] == self::PLANNER);
    }

    /**
     * Belongs to many trainings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subscriptions()
    {
        return $this->belongsToMany(Training::class, 'mail_subscriptions', 'user_id', 'training_id', 'id');
    }

    /**
     * Check if the user is subscribed to the given training.
     *
     * @param Training $training
     * @return mixed
     */
    public function isSubscribed(Training $training)
    {
        return ($this->subscriptions->contains($training));
    }
}
