<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoRepublica extends Model {

    protected $table = 'tipoRepublicas';
    protected $fillable = ["descricao"];

    protected $dates = [];

    public static $rules = [
        "descricao" => "required",
    ];

    public function republicas()
    {
        return $this->hasMany("App\Republica");
    }


}
