<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model {

    protected $fillable = [
        "nome",
        "sobrenome",
        "email",
        "senha"];

    protected $dates = [];

    protected $hidden = ['senha'];

    public static $rules = [
        "nome" => "required",
        "sobrenome" => "required",
        "senha" => "required",
    ];

    // Relationships

    public function telefones(){
        return $this->hasMany("App\Telefone","idUsuario");
    }

}
