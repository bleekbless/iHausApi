<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Universidade extends Model {

    protected $fillable = ["nomeUniversidade", "endereco_id", "cnpj"];

    protected $dates = [];

    protected $hidden = ['cnpj'];

    public static $rules = [
        "nomeUniversidade" => "required",
        "cnpj" => "required | unique:universidades",
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
