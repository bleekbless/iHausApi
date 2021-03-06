<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Republica extends Model {

    protected $fillable = ["nomeRepublica", "curso", "quantidadeQuartos", "quantidadeMoradores", "descricao", "tipo_republica","universidade_id","endereco_id","usuario_id"];

    protected $dates = [];

    public static $rules = [
        "nomeRepublica" => "required",
        "curso" => "required",
        "quantidadeQuartos" => "required",
        "quantidadeMoradores" => "required",
        "descricao" => "required",
        "tipo_republica" => "required|numeric",
        "endereco_id" => "required|numeric",
        "usuario_id" => "required|string",
    ];


    public function vagas()
    {
        return $this->hasMany("App\Vaga");
    }

    public function imagens()
    {
        return $this->hasMany("App\Imagem");
    }

    public function telefones()
    {
        return $this->hasMany("App\Telefone");
    }

    public function tipoRepublica()
    {
        return $this->belongsTo("App\TipoRepublica");
    }

    public function universidade()
    {
        return $this->belongsTo("App\Universidade");
    }

    public function endereco()
    {
        return $this->belongsTo("App\Endereco");
    }

    public function usuario()
    {
        return $this->belongsTo("App\Usuario");
    }

    public function conveniencias()
    {
        return $this->belongsToMany("App\Conveniencia")->withTimestamps();
    }

}
