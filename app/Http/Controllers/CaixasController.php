<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Caixas as Caixas;
use App\Contas as Contas;
Use Carbon\Carbon;
use Auth;
use DateTime;
use Log;

class CaixasController extends Controller
{
    public function index(){
      $caixas = Caixas::whereRaw('date(created_at) = ?', [Carbon::today()])
                      ->where('filial_id', Auth::user()->trabalho_id)
                      ->paginate(15);
      $deletados = 0;
      if (!isset($caixas[0])){
        $messages = "É preciso abrir o caixa";
        return redirect()->action('CaixasController@new_a')->withErrors($messages);
      }
      Log::info('Vendo movimentação de caixa da filial -> "'.Auth::user()->trabalho_id.'", para -> ID:'.Auth::user()->contato->id.' nome:'.Auth::user()->contato->nome.' Usuario ID:'.Auth::user()->id.' ip:'.request()->ip());
      return view('caixa.index')->with('caixas', $caixas)->with('deletados', $deletados);
    }

    public function new_a(){
      Log::info('Criando movimentação de caixa da filial -> "'.Auth::user()->trabalho_id.'", para -> ID:'.Auth::user()->contato->id.' nome:'.Auth::user()->contato->nome.' Usuario ID:'.Auth::user()->id.' ip:'.request()->ip());
      return view('caixa.new');
    }

    public function search(request $request){
      if (!empty($request->data)){
        $data = $request->data;
      } else {
        $data = Carbon::today();
      }

      $caixas = caixas::query();
      if ($request->tipo){
        $caixas = $caixas->orWhere('tipo', $request->tipo);
      }
      $caixas = $caixas->whereRaw('date(created_at) = ?', [$data]);

      if (is_array(Auth::user()->perms) and Auth::user()->perms["admin"]==1 and $request->deletados){
          $deletados = Caixas::onlyTrashed()
                          ->whereRaw('date(created_at) = ?', [$data])
                          ->get();
      } else {
        $deletados = 0;
      }

      $caixas = $caixas->paginate(15);
      Log::info('Vendo movimentação de caixa da filial -> "'.Auth::user()->trabalho_id.'", com busca -> "data:'.$data.', tipo:'.$request->tipo.'" para -> ID:'.Auth::user()->contato->id.' nome:'.Auth::user()->contato->nome.' Usuario ID:'.Auth::user()->id.' ip:'.request()->ip());

      return view('caixa.index')->with('caixas', $caixas)->with('deletados', $deletados);
    }

    public function new_do(request $request ){
      #
      #PRECISA SER TORNADO CLASSE!!!! TO DO!
      #
      $abertura = Caixas::whereRaw('date(created_at) = ?', [Carbon::today()])
                      ->orderBy('created_at', 'aaaa')
                      ->where('filial_id', Auth::user()->trabalho_id)
                      ->where('tipo', '0')
                      ->first();
      $fechamento = Caixas::whereRaw('date(created_at) = ?', [Carbon::today()])
                      ->orderBy('created_at', 'aaaa')
                      ->where('filial_id', Auth::user()->trabalho_id)
                      ->where('tipo', '1')
                      ->first();

      if (is_null($abertura)){
        if ($request->tipo!="0"){
          $messages = "Caixa ainda não aberto!";
          return redirect()->action('CaixasController@new_a')->withErrors($messages);
        }
      }
      if (!is_null($abertura)){
        if ($request->tipo=="0" and is_null($fechamento)){
          $messages = "Caixa ja aberto!";
          return redirect()->action('CaixasController@new_a')->withErrors($messages);
        }

        if (!is_null($fechamento)){
          if ($request->tipo=="0" and strtotime($abertura->created_at) > strtotime($fechamento->created_at)){
            $messages = "Caixa ja aberto";
            return redirect()->action('CaixasController@new_a')->withErrors($messages);
          }
          if (!empty($fechamento) and $request->tipo=="1" and strtotime($abertura->created_at) < strtotime($fechamento->created_at)){
            $messages = "Caixa já fechado!";
            return redirect()->action('CaixasController@new_a')->withErrors($messages);
          }
          if (!empty($fechamento) and $request->tipo=="2" and strtotime($abertura->created_at) < strtotime($fechamento->created_at)){
            $messages = "Caixa já fechado!";
            return redirect()->action('CaixasController@new_a')->withErrors($messages);
          }
        }
      }

      $movimentacao = new Caixas;
      $movimentacao->filial_id = Auth::user()->trabalho->id;
      $movimentacao->funcionario_id = Auth::user()->contato->id;
      $movimentacao->vendas_id="0";
      $movimentacao->pag = "0";
      $movimentacao->tipo = $request->tipo;
      $movimentacao->valor = $request->valor;
      if ($request->forma=="0"){
        $movimentacao->forma="0";
      } elseif ($request->forma=="1") {
        $movimentacao->forma="1";
      }

      if ($request->tipo=="1") {
        $conta = new Contas;
        $conta->contatos_id = Auth::user()->trabalho->id;
        $conta->nome = "Fechamento de Caixa";
        $conta->valor = $request->valor;
        $conta->vencimento = Carbon::now();
        $conta->descricao = Auth::user()->contato->nome." em ".Carbon::now();
        $conta->tipo = "1";
        $conta->estado = "1";
        $conta->save();
        $conta->referente = $conta->id;
        $conta->save();
      }
      if ($request->tipo=="0") {
        $conta = new Contas;
        $conta->contatos_id = Auth::user()->trabalho->id;
        $conta->nome = "Abertura de Caixa";
        $conta->valor = $request->valor;
        $conta->vencimento = Carbon::now();
        $conta->descricao = Auth::user()->contato->nome." em ".Carbon::now();
        $conta->tipo = "0";
        $conta->estado = "1";
        $conta->save();
        $conta->referente = $conta->id;
        $conta->save();
      }
      $movimentacao->save();
      Log::info('Salvando movimentação de caixa da filial -> "'.Auth::user()->trabalho_id.'",com dados -> "'.$request.'" para -> ID:'.Auth::user()->contato->id.' nome:'.Auth::user()->contato->nome.' Usuario ID:'.Auth::user()->id.' ip:'.request()->ip());

      return redirect()->action('CaixasController@index');
    }

    public function delete($id){
      $movimentacao = Caixas::withTrashed()->find($id);
      if ($movimentacao->trashed()) {
        Log::info('Restaurando movimentação de caixa -> "'.$caixa.'" da filial -> "'.Auth::user()->trabalho_id.'", para -> ID:'.Auth::user()->contato->id.' nome:'.Auth::user()->contato->nome.' Usuario ID:'.Auth::user()->id.' ip:'.request()->ip());
        $movimentacao->restore();
      } else {
        Log::info('Deletando movimentação de caixa -> "'.$caixa.'" da filial -> "'.Auth::user()->trabalho_id.'", para -> ID:'.Auth::user()->contato->id.' nome:'.Auth::user()->contato->nome.' Usuario ID:'.Auth::user()->id.' ip:'.request()->ip());
        $movimentacao->delete();
      }
      return redirect()->action('CaixasController@index');
    }
}