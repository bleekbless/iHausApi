<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model {

    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        "numeroTelefone" => "required",
    ];

    public function tipoTelefone()
    {
        return $this->hasMany("App\TipoTelefone","idTipoTelefone");
    }


}
