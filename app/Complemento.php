<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complemento extends Model {

    protected $fillable = ["descricao"];

    protected $dates = [];

    public static $rules = [
        "descricao" => "required",
    ];

    public function enderecos()
    {
        return $this->hasMany("App\Endereco");
    }


}
