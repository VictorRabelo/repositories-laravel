<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => '/v1'], function () {

    // Autentificação
    Route::group(['prefix' => '/auth'], function () {
        Route::get('/me', 'Auth\AuthController@me')->middleware('auth:api', 'scope:admin');
        Route::get('/logout', 'Auth\AuthController@logout')->middleware('auth:api');
        Route::post('/login', 'Auth\AuthController@login');
        Route::put('/alter-password', 'Auth\AuthController@alterSenha')->middleware('auth:api', 'scope:admin');
    });

    Route::group(['prefix' => '/clientes'], function () {

        Route::get('/', 'Cliente\ClienteController@index')->middleware(['auth:api', 'scope:admin']);
        Route::get('/total', 'Cliente\ClienteController@total')->middleware(['auth:api', 'scope:admin']);
        Route::get('/{id}', 'Cliente\ClienteController@show')->middleware(['auth:api', 'scope:admin']);

        Route::post('/', 'Cliente\ClienteController@store')->middleware(['auth:api', 'scope:diretor,admin']);

        Route::put('/{id}', 'Cliente\ClienteController@update')->middleware(['auth:api', 'scope:diretor,admin']);

        Route::delete('/{id}', 'Cliente\ClienteController@destroy')->middleware(['auth:api', 'scope:diretor,admin']);
    });

    Route::group(['prefix' => '/fornecedores'], function () {

        Route::get('/', 'Fornecedor\FornecedorController@index')->middleware(['auth:api', 'scope:admin']);
        Route::get('/{id}', 'Fornecedor\FornecedorController@show')->middleware(['auth:api', 'scope:admin']);

        Route::post('/', 'Fornecedor\FornecedorController@store')->middleware(['auth:api', 'scope:diretor,admin']);

        Route::put('/{id}', 'Fornecedor\FornecedorController@update')->middleware(['auth:api', 'scope:diretor,admin']);

        Route::delete('/{id}', 'Fornecedor\FornecedorController@destroy')->middleware(['auth:api', 'scope:diretor,admin']);
    });

    Route::group(['prefix' => '/categorias'], function () {

        Route::get('/', 'Categoria\CategoriaController@index')->middleware(['auth:api', 'scope:admin']);
        Route::get('/{id}', 'Categoria\CategoriaController@show')->middleware(['auth:api', 'scope:admin']);

        Route::post('/', 'Categoria\CategoriaController@store')->middleware(['auth:api', 'scope:diretor,admin']);

        Route::put('/{id}', 'Categoria\CategoriaController@update')->middleware(['auth:api', 'scope:diretor,admin']);

        Route::delete('/{id}', 'Categoria\CategoriaController@destroy')->middleware(['auth:api', 'scope:diretor,admin']);
    });

    Route::group(['prefix' => '/produtos'], function () {

        Route::get('/', 'Produto\ProdutoController@index')->middleware(['auth:api', 'scope:admin']);
        Route::get('/estoque', 'Produto\ProdutoController@estoque')->middleware(['auth:api', 'scope:admin']);
        Route::get('/masculino', 'Produto\ProdutoController@perfumeMasculino')->middleware(['auth:api', 'scope:admin']);
        Route::get('/feminino', 'Produto\ProdutoController@perfumeFeminino')->middleware(['auth:api', 'scope:admin']);
        Route::get('/pago', 'Produto\ProdutoController@pago')->middleware(['auth:api', 'scope:admin']);
        Route::get('/enviados', 'Produto\ProdutoController@enviados')->middleware(['auth:api', 'scope:admin']);
        Route::get('/vendidos', 'Produto\ProdutoController@vendidos')->middleware(['auth:api', 'scope:admin']);

        Route::get('/{id}', 'Produto\ProdutoController@show')->middleware(['auth:api', 'scope:admin']);

        Route::post('/', 'Produto\ProdutoController@store')->middleware(['auth:api', 'scope:admin']);

        Route::post('/masculino', 'Produto\ProdutoController@storeDolarMasculino')->middleware(['auth:api', 'scope:admin']);

        Route::post('/feminino', 'Produto\ProdutoController@storeDolarFeminino')->middleware(['auth:api', 'scope:admin']);

        Route::put('/{id}', 'Produto\ProdutoController@update')->middleware(['auth:api', 'scope:admin']);

        Route::delete('/{id}', 'Produto\ProdutoController@destroy')->middleware(['auth:api', 'scope:admin']);
    });

    Route::group(['prefix' => '/estoques'], function () {

        Route::get('/', 'Estoque\EstoqueController@index')->middleware(['auth:api', 'scope:admin']);
        Route::get('/especifico', 'Estoque\EstoqueController@especifico')->middleware(['auth:api', 'scope:admin']);
        Route::get('/em-estoque', 'Estoque\EstoqueController@estoque')->middleware(['auth:api', 'scope:admin']);

        Route::get('/{id}', 'Estoque\EstoqueController@show')->middleware(['auth:api', 'scope:admin']);

        Route::post('/', 'Estoque\EstoqueController@store')->middleware(['auth:api', 'scope:admin']);

        Route::put('/{id}', 'Estoque\EstoqueController@update')->middleware(['auth:api', 'scope:admin']);

        Route::delete('/{id}', 'Estoque\EstoqueController@destroy')->middleware(['auth:api', 'scope:admin']);
    });

    Route::group(['prefix' => '/vendas'], function () {

        Route::get('/', 'Venda\VendaController@index')->middleware(['auth:api', 'scope:admin']);
        Route::get('/all', 'Venda\VendaController@all')->middleware(['auth:api', 'scope:admin']);
        Route::get('/dia', 'Venda\VendaController@vendasDoDia')->middleware(['auth:api', 'scope:admin']);
        Route::get('/mes', 'Venda\VendaController@vendasDoMes')->middleware(['auth:api', 'scope:admin']);
        Route::get('/especifica', 'Venda\VendaController@vendaEspecifica')->middleware(['auth:api', 'scope:admin']);
        Route::get('/total', 'Venda\VendaController@total')->middleware(['auth:api', 'scope:admin']);
        Route::get('/a-receber', 'Venda\VendaController@aReceber')->middleware(['auth:api', 'scope:admin']);
        Route::get('/{id}', 'Venda\VendaController@show')->middleware(['auth:api', 'scope:admin']);

        Route::post('/', 'Venda\VendaController@store')->middleware(['auth:api', 'scope:admin']);
        Route::post('/create-receber', 'Venda\VendaController@createReceber')->middleware(['auth:api', 'scope:admin']);

        Route::put('/{id}', 'Venda\VendaController@update')->middleware(['auth:api', 'scope:admin']);
        Route::put('/{id}/receber', 'Venda\VendaController@updateReceber')->middleware(['auth:api', 'scope:admin']);

        Route::delete('/{id}', 'Venda\VendaController@destroy')->middleware(['auth:api', 'scope:admin']);
    });

    Route::group(['prefix' => '/despesas'], function () {

        Route::get('/', 'Despesa\DespesaController@index')->middleware(['auth:api', 'scope:admin']);
        Route::get('/movimentacao', 'Despesa\DespesaController@movimentacao')->middleware(['auth:api', 'scope:admin']);
        Route::get('/{id}', 'Despesa\DespesaController@show')->middleware(['auth:api', 'scope:admin']);

        Route::post('/', 'Despesa\DespesaController@store')->middleware(['auth:api', 'scope:admin']);

        Route::put('/{id}', 'Despesa\DespesaController@update')->middleware(['auth:api', 'scope:admin']);

        Route::delete('/{id}', 'Despesa\DespesaController@destroy')->middleware(['auth:api', 'scope:admin']);
    });

    Route::group(['prefix' => '/dolars'], function () {

        Route::get('/', 'Dolar\DolarController@index')->middleware(['auth:api', 'scope:admin']);
        Route::get('/{id}', 'Dolar\DolarController@show')->middleware(['auth:api', 'scope:admin']);

        Route::post('/', 'Dolar\DolarController@store')->middleware(['auth:api', 'scope:admin']);

        Route::put('/{id}', 'Dolar\DolarController@update')->middleware(['auth:api', 'scope:admin']);

        Route::delete('/{id}', 'Dolar\DolarController@destroy')->middleware(['auth:api', 'scope:admin']);
    });

    Route::group(['prefix' => '/movition'], function () {

        Route::get('/', 'Movition\MovitionController@index')->middleware(['auth:api', 'scope:admin']);
        Route::get('/all', 'Movition\MovitionController@all')->middleware(['auth:api', 'scope:admin']);
        Route::get('/especifico', 'Movition\MovitionController@especifico')->middleware(['auth:api', 'scope:admin']);
        Route::get('/total', 'Movition\MovitionController@total')->middleware(['auth:api', 'scope:admin']);
        Route::get('/geral', 'Movition\MovitionController@geral')->middleware(['auth:api', 'scope:admin']);
        Route::get('/eletronico', 'Movition\MovitionController@eletronico')->middleware(['auth:api', 'scope:admin']);

        Route::get('/{id}', 'Movition\MovitionController@show')->middleware(['auth:api', 'scope:admin']);

        Route::post('/', 'Movition\MovitionController@store')->middleware(['auth:api', 'scope:admin']);

        Route::put('/{id}', 'Movition\MovitionController@update')->middleware(['auth:api', 'scope:admin']);

        Route::delete('/{id}', 'Movition\MovitionController@destroy')->middleware(['auth:api', 'scope:admin']);
    });

    Route::group(['prefix' => '/historico'], function () {

        Route::get('/', 'Historico\HistoricoController@index')->middleware(['auth:api', 'scope:admin']);
        Route::get('/geral', 'Historico\HistoricoController@geral')->middleware(['auth:api', 'scope:admin']);
        Route::get('/eletronico', 'Historico\HistoricoController@eletronico')->middleware(['auth:api', 'scope:admin']);

        Route::get('/{id}', 'Historico\HistoricoController@show')->middleware(['auth:api', 'scope:admin']);

        Route::post('/', 'Historico\HistoricoController@store')->middleware(['auth:api', 'scope:admin']);

        Route::put('/{id}', 'Historico\HistoricoController@update')->middleware(['auth:api', 'scope:admin']);

        Route::delete('/{id}', 'Historico\HistoricoController@destroy')->middleware(['auth:api', 'scope:admin']);
    });

    Route::group(['prefix' => '/relatorios'], function () {

        Route::get('/vendas', 'Relatorio\RelatorioController@vendas')->middleware(['auth:api', 'scope:admin']);

        Route::get('/clientes', 'Relatorio\RelatorioController@clientes')->middleware(['auth:api', 'scope:admin']);

        Route::get('/estoque', 'Relatorio\RelatorioController@estoque')->middleware(['auth:api', 'scope:admin']);

        Route::get('/vendidos', 'Relatorio\RelatorioController@vendidos')->middleware(['auth:api', 'scope:admin']);
    });
});
