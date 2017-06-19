<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model {

    protected $fillable = ["numeroTelefone", "tipoTelefone_id"];

    protected $dates = [];

    public static $rules = [
        "numeroTelefone" => "required",
    ];

    public function tipoTelefone()
    {
        return $this->belongsTo("App\TipoTelefone");
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
