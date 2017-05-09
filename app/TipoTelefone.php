<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoTelefone extends Model {

    protected $fillable = ["descricao"];

    protected $dates = [];

    public static $rules = [
        // Validation rules
        "descricao" => "required"
    ];

    // Relationships

}
