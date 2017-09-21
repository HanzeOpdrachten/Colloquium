<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{

	protected $fillable = ['name', 'color'];
	protected $table    = 'training';
  public $timestamps  = false;

  public function colloquia()
  {
    return $this->hasMany(Colloquium::class);
  }

}
