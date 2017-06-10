<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Universidade extends Model {

    protected $fillable = ["nomeUniversidade", "endereco_id"];

    protected $dates = [];

    public static $rules = [
        "nomeUniversidade" => "required",
        "cnpj" => "required",
        "endereco_id" => "required|numeric",
    ];

    public function endereco()
    {
        return $this->belongsTo("App\Endereco");
    }

    public function telefones()
    {
        return $this->hasMany("App\Telefone");
    }

    public function republicas(){
        return $this->hasMany("App\Republica");
    }


}
