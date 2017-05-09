<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model {

    protected $fillable = ["nomeCidade", "estado_id"];

    protected $dates = [];

    public static $rules = [
        "nomeCidade" => "required",
        "estado_id" => "required|numeric",
    ];

    public $timestamps = false;

    public function estado()
    {
        return $this->belongsTo("App\Estado");
    }

    public function bairros()
    {
        return $this->hasMany("App\Bairro");
    }


}
