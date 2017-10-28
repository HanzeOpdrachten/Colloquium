<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Colloquium extends Model
{
    use Notifiable;

    /**
     * The colloquium is awaiting to be accepted.
     */
    const AWAITING = 1;

    /**
     * The colloquium is accepted by planner.
     */
    const ACCEPTED = 2;

    /**
     * The colloquium is declined by planner.
     */
    const DECLINED = 3;

    /**
     * The colloquium is canceled.
     */
    const CANCELED = 4;

    /**
     * The attributes that are fillable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'training_id',
        'start_date',
        'end_date',
        'speaker',
        'location',
        'description',
        'status',
        'language',
        'email',
        'token',
        'changed'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'colloquia';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps  = false;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_date',
        'end_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'changed' => 'boolean',
    ];

    /**
     * Reformat the start date attribute.
     *
     * @param $value
     */
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    /**
     * Reformat the end date attribute.
     *
     * @param $value
     */
    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    /**
     * Route notifications for the mail channel.
     *
     * @return mixed
     */
    public function routeNotificationForMail()
    {
        return $this->email;
    }

    /**
     * Set a new unique token.
     *
     * @return string
     */
    public function setToken()
    {
        $token = str_random(10);

        if (self::where('token', '=', $token)->exists()) {
            $this->setToken();
        }

        $this->token = $token;
        $this->save();

        return $token;
    }

    /**
     * Is awaiting.
     *
     * @return bool
     */
    public function isAwaiting()
    {
        return ($this->attributes['status'] == self::AWAITING);
    }

    /**
     * Is accepted.
     *
     * @return bool
     */
    public function isAccepted()
    {
        return ($this->attributes['status'] == self::ACCEPTED);
    }

    /**
     * Is declined.
     *
     * @return bool
     */
    public function isDeclined()
    {
        return ($this->attributes['status'] == self::DECLINED);
    }

    /**
     * Is canceled.
     *
     * @return bool
     */
    public function isCanceled()
    {
        return ($this->attributes['status'] == self::CANCELED);
    }

    /** Has changed
     *
     * @return bool
     */
    public function hasChanged()
    {
      return ($this->attributes['changed'] == 1);
    }

    /**
     * Belongs to one training.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    /**
     * Has one planner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function planner()
    {
        return $this->belongsTo(User::class, 'planner_id');
    }
}
