<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colloquium extends Model
{

    protected $guarded = ['id'];
    protected $table    = 'Colloquia';
    public $timestamps  = false;

    /**
     * this function gets the linked training from the training table
     */
    public function training {
        return $this->belongsTo(Training::class);
    }

}
