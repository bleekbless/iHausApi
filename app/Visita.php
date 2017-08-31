<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model {

    protected $fillable = ["data", "usuario_id", "vaga_id"];

    protected $dates = ["data"];

    public static $rules = [
        "data" => "required|date",
        "usuario_id" => "numeric|required",
        "vaga_id" => "required|numeric",
    ];

    public $timestamps = false;

    public function vaga()
    {
        return $this->belongsTo("App\Vaga");
    }

    public function usuario()
    {
        return $this->belongsTo("App\Usuario");
    }


}
