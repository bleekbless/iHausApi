<?php namespace App\Http\Controllers;

use App\Estado;
use App\Cidade;
use App\Bairro;

trait EnderecoTrait{

    public function checaEstado($nomeEstado){

        $estado = Estado::where('nomeEstado', 'like',  $nomeEstado )->first();

        if($estado){
            return $estado;
        }else{
            $estado = new Estado();
            $estado->nomeEstado = $nomeEstado;
            $estado->save();
            return $estado;
        }
    }

    public function checaCidade($nomeCidade, $estado){

        $cidade = Cidade::where('nomeCidade', 'like', $nomeCidade )->first();

        if($cidade){
            return $cidade;
        }else{
            $cidade = $estado->cidades()->create([
                'nomeCidade' => $nomeCidade
            ]);
            return $cidade;
        }
    }

    public function checaBairro($nomeBairro, $cidade){
        
        $bairro = Bairro::where('nomeBairro', 'like', $nomeBairro )->first();

        if($bairro){

            return $bairro;

        }else{

            $bairro = $cidade->bairros()->create([
                'nomeBairro' => $nomeBairro
            ]);
            return $bairro;
        }
        
    }

}