<?php

use App\Http\Controllers\AbrasilController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OrdemController;
use App\Http\Controllers\PecaController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\Configuracoes\BackupController;
use App\Http\Controllers\Configuracoes\EmpresaController;
use App\Http\Controllers\Configuracoes\EmailController;
use App\Http\Controllers\Configuracoes\FerramentaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Configuracoes\MensagemController;
use App\Http\Controllers\Relatorios\OrdemController as RelOrdem;
use App\Http\Controllers\Relatorios\PecaController as RelPeca;
use App\Http\Controllers\Relatorios\AgendaController as RelAgenda;
use App\Http\Controllers\Relatorios\FinanceiroController;
use App\Http\Controllers\TarefaController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

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
Route::group(['middleware' => ['auth']], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::post('clientes/autocomplete', [ClienteController::class, 'autocomplete'])->name('clientes.autocomplete');
    Route::post('clientes/busca', [ClienteController::class, 'busca'])->name('clientes.busca');
    Route::resource('clientes', ClienteController::class);

    Route::get('ordens/enviaremail/{ordemid}/{clienteid}', [OrdemController::class, 'enviaremail'])->name('ordens.enviaremail');
    Route::get('ordens/reciboentrega/{orden}', [OrdemController::class, 'reciboentrega'])->name('ordens.reciboentrega');
    Route::get('ordens/reciborecebe/{orden}', [OrdemController::class, 'reciborecebe'])->name('ordens.reciborecebe');
    Route::get('ordens/ordemcliente/{cliente}', [OrdemController::class, 'ordemcliente'])->name('ordens.ordemcliente');
    Route::post('ordens/autocomplete', [OrdemController::class, 'autocomplete'])->name('ordens.autocomplete');
    Route::post('ordens/busca', [OrdemController::class, 'busca'])->name('ordens.busca');
    Route::get('ordens/status/{status}', [OrdemController::class, 'status'])->name('ordens.status');
    Route::get('ordens/pagamento/{pagamento}', [OrdemController::class, 'pagamento'])->name('ordens.pagamento');
    Route::resource('ordens', OrdemController::class);

    Route::get('agendas/enviaremail/{agendaid}/{clienteid}', [AgendaController::class, 'enviaremail'])->name('agendas.enviaremail');
    Route::post('agendas/autocomplete', [AgendaController::class, 'autocomplete'])->name('agendas.autocomplete');
    Route::post('agendas/busca', [AgendaController::class, 'busca'])->name('agendas.busca');
    Route::get('agendas/status/{status}', [AgendaController::class, 'status'])->name('agendas.status');
    Route::resource('agendas', AgendaController::class);

    Route::prefix('tarefas')->name('tarefas.')->group(function () {
        Route::post('busca', [TarefaController::class, 'busca'])->name('busca');
        Route::get('aberta/{tarefa}', [TarefaController::class, 'aberta'])->name('aberta');
    });
    Route::resource('tarefas', TarefaController::class);

    Route::get('pecas/delpecord/{peca}', [PecaController::class, 'delpecord'])->name('pecas.delpecord');
    Route::post('pecas/pecasordens', [PecaController::class, 'pecasordens'])->name('pecas.pecasordens');
    Route::post('pecas/autocomplete', [PecaController::class, 'autocomplete'])->name('pecas.autocomplete');
    Route::post('pecas/busca', [PecaController::class, 'busca'])->name('pecas.busca');
    Route::get('pecas/situacao/{situacao}', [PecaController::class, 'situacao'])->name('pecas.situacao');
    Route::resource('pecas', PecaController::class);

    Route::get('configuracoes/gerabackup', [BackupController::class, 'gerabackup'])->name('configuracoes.gerabackup');
    Route::get('configuracoes/executabackup', [BackupController::class, 'executabackup'])->name('configuracoes.executabackup');
    Route::resource('configuracoes/backups', BackupController::class);

    Route::resource('configuracoes/empresas', EmpresaController::class);
    Route::resource('configuracoes/emails', EmailController::class);
    Route::resource('configuracoes/mensagens', MensagemController::class)->parameters(['mensagens' => 'mensagem']);


    Route::post('configuracoes/ferramentas/gretiquetas', [FerramentaController::class, 'gretiquetas'])->name('ferramentas.gretiquetas');
    Route::get('configuracoes/ferramentas/licenca', [FerramentaController::class, 'licenca'])->name('ferramentas.licenca');
    Route::resource('configuracoes/ferramentas', FerramentaController::class);

    Route::post('usuarios/autocomplete', [UsuarioController::class, 'autocomplete'])->name('usuarios.autocomplete');
    Route::post('usuarios/busca', [UsuarioController::class, 'busca'])->name('usuarios.busca');
    Route::resource('usuarios', UsuarioController::class);

    Route::get('relatorios/ordens', [RelOrdem::class, 'index'])->name('relatorios.ordens');
    Route::get('relatorios/pecas', [RelPeca::class, 'index'])->name('relatorios.pecas');
    Route::get('relatorios/agendas', [RelAgenda::class, 'index'])->name('relatorios.agendas');
    Route::get('relatorios/financeiro', [FinanceiroController::class, 'index'])->name('relatorios.financeiro');

    Route::resource('abrasil', AbrasilController::class);
});
Auth::routes();
