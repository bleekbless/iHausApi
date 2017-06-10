<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class ImagemsController extends Controller {

    const MODEL = "App\Imagem";

    use RESTActions;


    public function UploadImages(Request $request, $republica)
    {
        $m = $this::MODEL;


        if(!$request->hasFile('imagens')){
            echo base_path();
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

            $m::create(['url' => $URL, 'republica_id']);

            $republica->imagem()
             ->save($m::create([
                 'url' => $url['numeroTelefone'],
                 ]));
            
        }
        
        return array('status' => 'Upload feito com sucesso.');
        
    }

}
