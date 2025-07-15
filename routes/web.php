<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Cliente;
use App\Endereco;
use Symfony\Component\HttpKernel\Client;

Route::get('/clientes', function () {
    $clientes = Cliente::all();
    foreach($clientes as $c){
        echo "<p>ID: " . $c->id . "</p>";
        echo "<p>Nome: " . $c->nome . "</p>";
        echo "<p>Telefone: " . $c->telefone . "</p>";
        // $e = Endereco::where('cliente_id', $c->id)->first();
        echo "<p>ID Cliente: " . $c->endereco->cliente_id . "</p>";
        echo "<p>Rua: " . $c->endereco->rua . "</p>";
        echo "<p>Numero: " . $c->endereco->numero . "</p>";
        echo "<p>Bairro: " . $c->endereco->bairro . "</p>";
        echo "<p>Cidade: " . $c->endereco->cidade . "</p>";
        echo "<p>UF: " . $c->endereco->uf . "</p>";
        echo "<p>CEP: " . $c->endereco->cep . "</p>";
        echo "<hr>";
    }
});

Route::get('/enderecos', function () {
    $ends = Endereco::all();
    foreach($ends as $e){
        echo "<p>ID Cliente: " . $e->cliente_id . "</p>";
        echo "<p>Nome: " . $e->cliente->nome . "</p>";
        echo "<p>Telefone: " . $e->cliente->telefone . "</p>";
        echo "<p>Rua: " . $e->rua . "</p>";
        echo "<p>Numero: " . $e->numero . "</p>";
        echo "<p>Bairro: " . $e->bairro . "</p>";
        echo "<p>Cidade: " . $e->cidade . "</p>";
        echo "<p>UF: " . $e->uf . "</p>";
        echo "<p>CEP: " . $e->cep . "</p>";
        echo "<hr>";
    }
});

Route::get('/inserir', function() {
    $c = new Cliente();
    $c->nome = "Jose";
    $c->telefone = "27 996548214";
    $c->save();

    $e = new Endereco();
    $e-> rua = "Av. do Estado";
    $e-> numero = "99";
    $e-> bairro = "Cobi de Cima";
    $e-> cidade = "Cariacroca";
    $e-> uf = "ES";
    $e-> cep = "29303-003";

    $c->endereco()->save($e);

    $c = new Cliente();
    $c->nome = "Marcio";
    $c->telefone = "27 999654752";
    $c->save();

    $e = new Endereco();
    $e-> rua = "Av. do Brasil";
    $e-> numero = "1500";
    $e-> bairro = "Nova Bahia";
    $e-> cidade = "Vila Velha";
    $e-> uf = "ES";
    $e-> cep = "29699-956";
    
    $c->endereco()->save($e);
});

Route::get('/clientes/json', function(){
    // $clientes = Cliente::all();
    $clientes = Cliente::with(['endereco'])->get();
    return $clientes->toJson();
});