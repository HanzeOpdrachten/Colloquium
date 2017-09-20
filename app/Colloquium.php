<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colloquium extends Model
{

    protected $fillable = [
        'title', 'training_id', 'start_date', 'end_date',  'speaker',  'location',  'description',  'status',  'language'
    ];
    protected $table    = 'Colloquia';
    public $timestamps  = false;

    /**
     * this function gets the linked training from the training table
     */
    public function training() {
        return $this->belongsTo(Training::class);
    }

}
