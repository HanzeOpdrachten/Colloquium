<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
	protected $guarded = ['id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'trainings';

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps  = false;

    /**
     * Has many colloquia.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function colloquia()
    {
        return $this->hasMany(Colloquium::class);
    }

    /**
     * Belongs to many users (a.k.a. subscribers).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'mail_subscriptions', 'training_id', 'user_id', 'id');
    }
}
