<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conveniencia extends Model {

    protected $fillable = ["descricaoConveniencia"];

    protected $dates = [];

    public static $rules = [
        "descricaoConveniencia" => "required",
    ];

    public function republicas()
    {
        return $this->belongsToMany("App\Republica")->withTimestamps();
    }


}
