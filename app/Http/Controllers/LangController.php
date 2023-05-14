<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LangController extends Controller
{
    public function changeLang(){
        if (session('locale') == "sk"){
            session(['locale' => "en"]);
        } else {
            session(['locale' => "sk"]);
        }
        return redirect()->back();
    }

    public function returnLang($lang){
        App::setLocale($lang);
        return view('welcome');
    }

    public function translate($lang, $path = null)
    {
        $translatedString = trans('project.test', []);
        return response()->json(['message' => $translatedString]);
    }
}
