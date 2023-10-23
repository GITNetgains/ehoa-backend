<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Models\languages;
use Illuminate\Http\Request;

class languageController extends Controller
{
    function createLanguage(){
        return view('/language/language-create');
    }
    function SaveLanguage(Request $req){
        try{
            // dd($req->all());
        $validator = Validator::make($req->all(), [
            'langauge_name'=>'required|string',
            'langauge_code'=>'required|string',
            
        ]);

        if ($validator->fails()) {
         
            return redirect('/language/language-create')
                ->withErrors($validator)
                ->withInput();
        } else {
          
                $languages = new languages;
                $languages->langauge_name=ucfirst($req->langauge_name);
                $languages->langauge_code=strtolower($req->langauge_code);
                $languages->save();  
                return redirect('/language/language-list')->with('success', 'New Language added List Successfully');         
    }
} catch (\Exception $exception) {
    $data['error'] = $exception->getMessage();
    return view('error', $data);
}
}
    function Listlanguage(){
        try {
            $data['languages'] = DB::table('languages')->orderBy('language_id', 'DESC')
            ->paginate(25);
        
            return view('language/language-list',$data);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function DeleteLanguage($language_id){
        try {
            $languages = DB::table('languages')
                ->where('language_id', $language_id )
                ->delete();
            return redirect('/language/language-list');
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function EditLanguage($language_id){
        try {
            $data['languages'] = DB::table('languages')
            ->where('language_id', $language_id )
            ->first();
            // dd($data['moonphases']);
        return view('/language/edit-language',$data);
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function UpdateLanguage(Request $req){
        try {
            $validator = Validator::make($req->all(), [
                'langauge_name'=>'required|string',
                'langauge_code'=>'required|string',
            ]);
            
            if ($validator->fails()) {
                return redirect('/language/edit-language/'.$req->id)
                    ->withErrors($validator)
                    ->withInput();
            } else {
                DB::table('languages')->where('language_id', $req->id)
                ->update(
                    array(
                        'langauge_name'=>$req->langauge_name,
                        'langauge_code'=>$req->langauge_code,
                        
                    )
                );
                return redirect('/language/language-list')->with('success', 'Language Updated Successfully!');
            }
        } catch (\Exception $exception) {
            $data['error'] = $exception->getMessage();
            return view('error', $data);
        }
    }
    function createPronoun(){
        return view('/pronoun/pronoun-create');
    }
    function SavePronoun(Request $req){
        try{
            // dd($req->all());
        $validator = Validator::make($req->all(), [
            'pronoun'=>'required|string',
            
        ]);

        if ($validator->fails()) {
         
            return redirect('/pronoun/pronoun-create')
                ->withErrors($validator)
                ->withInput();
        } else {
          
                $pronouns = new pronouns;
                $pronouns->pronoun=ucfirst($req->pronoun);
               
                // $pronouns->save();  
                // return redirect('/pronoun/pronoun-list')->with('success', 'New Pronoun added List Successfully');         
    }
} catch (\Exception $exception) {
    $data['error'] = $exception->getMessage();
    return view('error', $data);
}
    }
}
