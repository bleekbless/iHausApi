<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model {

    protected $fillable = ["numeroTelefone", "idTipoTelefone"];

    protected $dates = [];

    public static $rules = [
        "numeroTelefone" => "required",
    ];

    public function tipoTelefone()
    {
        return $this->hasMany("App\TipoTelefone","idTipoTelefone");
    }

    public function usuario(){
        return $this->belongsTo("App\Usuario");
    }

    public function republica(){
        return $this->belongsTo("App\Republica");
    }

    public function universiade(){
        return $this->belongsTo("App\Universidade");
    }
    

}
