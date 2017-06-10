<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vaga extends Model {

    protected $fillable = ["titulo", "valor", "data", "republica_id"];

    protected $dates = [];

    public static $rules = [
        "titulo" => "required",
        "valor" => "required",
        "data" => "required",
        "republica_id" => "required|numeric",
    ];

    public $timestamps = false;

    public function republica()
    {
        return $this->belongsTo("App\Republica");
    }

    public function usuarios()
    {
        return $this->belongsToMany("App\Usuario")->withTimestamps();
    }


}
