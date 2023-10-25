<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    private string $nickname;
    private string $email;
    private string $password;

    public function __construct(string $nickname, string $email, string $password){
        $this->nickname = $nickname;
        $this->email = $email;
        $this->password = $password;
    }

    public function getNickname(){
        return $this->nickname;
    }
    public function __getEmail(){
        return $this->email;
    }
    public function __getPassword(){
        return $this->password;
    }

    /*private array $atributos = [];


    public function __construct(string $nickname, string $email, string $password){
        $this->atributos['nickname'] = $nickname;
        $this->atributos['email'] = $email;
        $this->atributos['password'] = $password;
    }

    public function __get($atributo){
        return $this->atributos[$atributo];
    }

    public function __set($atributo, $valor){
        $this->atributos[$atributo] = $valor;
    }*/

    public function __toString() {
        return $this->getNickname(); // O cualquier otra representación que desees
    }



}
