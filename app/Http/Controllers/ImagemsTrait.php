<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Auth;

trait ImagemsTrait {

    public function UploadImages(Request $request, $republica)
    {
        $m = self::IMG;


        if(!$request->hasFile('imagens')){
            return $this->respond('500', ['status' => 'Erro. Favor selecione alguma imagem.']);
        }

        $picture = '';

        //Pega as imagens selecionadas
        $imagens = $request->file('imagens');

        foreach ($imagens as $imagem) {
            $filename = '_foto.jpg';
            $extension = $imagem->getClientOriginalExtension();
            $picture = strtotime(Carbon::now()).$filename;
            $URL = '\public\documentos\usuarios\\' . 'ID' . '\imagens\fotos';
            $destinationPath = base_path() . $URL;
            $imagem->move($destinationPath, $picture);

            $republica->imagens()
             ->create([
                 'url' => $URL.'\\'.$picture,
                 ]);
            
        }
        
        return array('status' => 'Upload feito com sucesso.');
        
    }

}