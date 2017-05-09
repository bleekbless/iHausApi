<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model {

    protected $fillable = ["nomeEstado"];

    protected $dates = [];

    public static $rules = [
        "nomeEstado" => "required",
    ];

    public $timestamps = false;

    // Relationships

    public function cidades()
    {
        return $this->hasMany("App\Cidade");
    }

}
