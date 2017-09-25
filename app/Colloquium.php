<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colloquium extends Model
{
    /**
     * The colloquium is active.
     */
    const ACTIVE = 1;

    /**
     * The colloquium is canceled.
     */
    const CANCELED = 2;

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
     * Belongs to one training.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function training() {
        return $this->belongsTo(Training::class);
    }

}
