<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model {

    protected $fillable = ["logradouro", "numero", "complemento", "numeroApto", "bairro_id"];

    protected $dates = [];

    public static $rules = [
        "logradouro" => "required",
        "numero" => "required",
        "complemento" => "nullable",
        "numeroApto" => "nullable",
        "bairro_id" => "required|numeric",
    ];

    public function universidades()
    {
        return $this->hasMany("App\Universidade");
    }

    public function bairro()
    {
        return $this->belongsTo("App\Bairro");
    }

    public function republicas()
    {
        return $this->hasMany("App\Republica");
    }


}
