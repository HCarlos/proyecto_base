<?php

namespace App\Http\Controllers\Funciones;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
//use Intervention\Image\Image;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;
//use Intervention\Image\ImageManagerStatic as Img;

class FuncionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function toMayus($str=""){
        return strtr(strtoupper($str), "áéíóúñ", "ÁÉÍÓÚÑ");
    }

    public function showFile($root="/archivos/",$archivo=""){
        $public_path = public_path();
        $url = $public_path."/storage/".$root.$archivo;
        if (Storage::exists($archivo))
        {
            return response()->download($url);
        }
        abort(404);
    }

    public function string_to_tsQuery(String $string, String $type){
        $str = explode(' ',$string);
        //dd($str);
        $string = '';
        $i = 1;
        foreach ($str as $value){
            if ( strlen($value) >= 4 ){
                $vector = '';
                if ($string!=''){
                    $vector = $type;
                }
                $string = $string.$vector.$value;
            }
            ++$i;
        }
        return $string;
    }
    // get IP, Host or IdEmp
    public function getIHE($type=0){
        switch ($type){
            case 0:
                return 1;
                beark;
            case 1:
                return $_SERVER['REMOTE_ADDR'];
                beark;
            case 2:
                return gethostbyaddr($_SERVER['REMOTE_ADDR']);
                beark;
        }
    }

    public function setDateTo6Digit($fecha){
        if(is_null($fecha)){
            $fecha = Carbon::today()->toDateString();
        }
//        dd(Carbon::now());
        $fecha = str_replace('20','',$fecha);
        $fecha = str_replace('-','',$fecha);
        return $fecha;
    }

    public function getFechaFromNumeric($number){
        return
            '20'.substr($number,0,2).'-'.
            substr($number,2,2).'-'.
            substr($number,4,2)
            ;
    }

    public function fechaEspanol($f){
        $f = explode('-',substr($f,0,10));
        return $f[2].'-'.$f[1].'-'.$f[0];
    }

    public function fechaEspanolComplete($f,$type=false){
        $f = explode('-',substr($f,0,10));
        $f =  $f[2].'-'.$f[1].'-'.$f[0];
        return !$type ? $f.' 00:00:00' : $f.' 23:59:59';
    }

    public function fechaDateTimeFormat($f,$type=false){
        $f = explode('-',substr($f,0,10));
        $f = $f[0].'-'.$f[1].'-'.$f[2];
        return !$type ? $f.' 00:00:00' : $f.' 23:59:59';
    }

    public function validImage($model, $storage, $root){
        $ext = ['jpg','jpeg','gif','png'];
        for ($i=0;$i<4;$i++){
            $p1 = $model->id.'.'.$ext[$i];
            $e1 = Storage::disk($storage)->exists($p1);
            if ($e1) {
                $model->update(['root'=>$root,'filename'=>$p1]);
            }
        }
    }

    public function deleteImages($model,$storage){
        $ext = ['jpg','jpeg','gif','png','xls','xlsx','doc','docx','ppt','pptx','txt','mp4'];
        for ($i=0;$i<4;$i++){
            $p1 = $model->id.'.'.$ext[$i];
            $e1 = Storage::disk($storage)->exists($p1);
            if ($e1) {
                Storage::disk($storage)->delete($p1);
            }
        }
    }

    public function run($imagePath,$filename="foo")
    {
        $image = Image::make($imagePath)
            ->fit(300,300);
        $image->encode('png');
        $width = $image->getWidth();
        $height = $image->getHeight();
        $mask = Image::canvas($width, $height);
        $mask->circle($width, $width/2, $height/2, function ($draw) {
            $draw->background('#fff');
        });
        $image->mask($mask, false);
        $image->save(public_path(env('PROFILE_ROOT')).'/'.$filename);
        return $image;
    }


}
