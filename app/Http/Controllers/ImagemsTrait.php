<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Auth;

trait ImagemsTrait {

    public function UploadImages($_imagens, $republica)
    {
        $m = self::IMG;


        if(!$_imagens){
            return $this->respond('500', ['status' => 'Favor selecione alguma imagem.']);
        }

        $picture = '';

        //Pega as imagens selecionadas
        $imagens = $_imagens;

        foreach ($imagens as $key=>$string_imagem) {
            $filename = '_'.$key.'_foto.jpg';
            $picture = strtotime(Carbon::now()).$filename;

            if (!is_dir(public_path() . '/documentos/users/' . Auth::user()->id)) {
               mkdir(public_path() . '/documentos/users/' . Auth::user()->id);
               mkdir(public_path() . '/documentos/users/' . Auth::user()->id . '/images');
            }

            $URL = '/documentos/users/' . Auth::user()->id . '/images/' .$picture;
            $destinationPath = public_path() . $URL;

            $img = substr($string_imagem, strpos($string_imagem, ",") + 1);
            $data = base64_decode($img);

            $success = file_put_contents($destinationPath, $data);

            $republica->imagens()
             ->create([
                 'url' => $URL,
                 ]);
            
        }
        
        return array('status' => 'Upload feito com sucesso.');
        
    }

}