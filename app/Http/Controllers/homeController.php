<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Cadastro;
use Illuminate\Support\Facades\DB;

class HomeController extends BaseController
{
    public function store(Request $request)
    {
        try{
                $id = $request->get('id', false);
                $Dados['name']=$request->nome;
                $Dados['telefone']=$request->telefone;
                $Dados['endereco']=$request->endereco;
                if($id){
                    $Cadastro = Cadastro::find($id);
                    $Cadastro->fill($Dados);
                    $Cadastro->save();
                }
                else{
                    Cadastro::create($Dados);
                }
                return redirect()->route('home');
        }
        catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }
            
   
    public function home(){
        $dados = DB::table('cadastro')->get();
        return view('home', compact('dados'));
    }

    public function option(){
        $dados = DB::table('cadastro')->get();
        return compact('dados');
    }

    public function delete($id){
        try{
        $head = Cadastro::find($id);
        $head->delete();
        return redirect()->route('home');
        }
        catch (\Exception $e) {
            return redirect()->route('home');
        }
    }

    public function read($id){
        $head = Cadastro::find($id);
        return view('home', array_merge(['head' => $head], $this->option()));
}



    }

