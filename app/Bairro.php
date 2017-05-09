<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Bairro extends Model {

    protected $fillable = ["nomeBairro", "cidade_id"];

    protected $dates = [];

    public static $rules = [
        "nomeBairro" => "required",
        "cidade_id" => "required|numeric",
    ];

    public $timestamps = false;

    public function cidade()
    {
        return $this->belongsTo("App\Cidade");
    }

    public function enderecos()
    {
        return $this->hasMany("App\Endereco");
    }


}
