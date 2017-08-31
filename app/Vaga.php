<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vaga extends Model {

    protected $fillable = ["titulo", "valor", "tipo", "republica_id", "vaga_garagem"];

    protected $dates = ["data"];

    public static $rules = [
        "titulo" => "required|string",
        "valor" => "required|numeric",
        "tipo" => "required|string",
        "data" => "required|date",
        "republica_id" => "required|numeric",
        "vaga_garagem" => "boolean"
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

    public function visitas()
    {
        return $this->hasMany("App\Visita");
    }


}
