<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagem extends Model {

    protected $fillable = ["url"];

    protected $dates = [];

    public static $rules = [
        "url" => "required",
        "republica_id" => "required|numeric",
    ];

    public function republica()
    {
        return $this->belongsTo("App\Republica");
    }


}
