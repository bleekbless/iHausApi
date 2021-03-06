<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notifiable;
use App\Http\Traits\UuidsTrait;

class Usuario extends Model implements CanResetPasswordContract {

    use CanResetPassword, Notifiable, UuidsTrait;

    protected $fillable = [
        "nome",
        "sobrenome",
        "email",
        "password",
        "notificationToken"
        ];

    protected $dates = [];

    protected $hidden = ['password'];

    public static $rules = [
        "nome" => "required",
        "sobrenome" => "required",
        "password" => "required | same:repeatPass",
        "email" => "required | unique:usuarios"
    ];

    public $incrementing = false;

    // Relationships

    public function telefones(){
        return $this->hasMany("App\Telefone","idUsuario");
    }

    public function republicas(){
        return $this->hasMany("App\Republica");
    }

    public function vagas()
    {
        return $this->belongsToMany("App\Vaga")->withTimestamps();
    }

    public function visitas()
    {
        return $this->hasMany("App\Visita");
    }
    
    public function isAdmin()
    {
        return $this->admin;
    }


}
