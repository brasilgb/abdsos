<?php

namespace App\Http\Controllers\Configuracoes;

use App\Http\Controllers\Controller;
use App\Models\Backup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

class BackupController extends Controller
{
    /**
     * @var Backup
     */
    protected $backup;

    public function __construct(Backup $backup)
    {
        $this->backup = $backup;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $backups = Backup::first();
        if ($backups) :
            return redirect()->route('backups.show', ['backup' => $backups->id_backup]);
        else :
            return redirect()->route('backups.create');
        endif;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Backup $backup)
    {
        $data = $request->all();
        $rules = [
            'local' => 'required',
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo :attribute só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $data['id_backup'] = Backup::idbackup();
        $backup->create($data);
        flash('<i class="fa fa-check"></i> Dados de backup registrados com sucesso!')->success();
        return redirect()->route('backups.show', ['backup' => Backup::idbackup() - 1]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backup  $backup
     * @return \Illuminate\Http\Response
     */
    public function show(Backup $backup)
    {
        return view('backups.edit', compact('backup'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backup  $backup
     * @return \Illuminate\Http\Response
     */
    public function edit(Backup $backup)
    {
        return redirect()->route('backups.show');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backup  $backup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Backup $backup)
    {
        $data = $request->all();
        $rules = [
            'local' => 'required',
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo :attribute só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $backup->update($data);
        flash('<i class="fa fa-check"></i> Dados de backup editados com sucesso!')->success();
        return redirect()->route('backups.show', ['backup' => $backup->id_backup]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backup  $backup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Backup $backup)
    {
        //
    }

    public function executabackup()
    {
        $horaatual = date("H:i:s", strtotime(Carbon::now()));
        $horaagendada = date("H:i:s", strtotime(Backup::first()->agendamento));
        if ($horaatual == $horaagendada) {
            $this->createbackup();
        }
    }

    public function gerabackup()
    {
        $this->createbackup();
        flash('<i class="fa fa-check"></i> Backup efetuado com sucesso!')->success();
        return redirect()->route('home');
    }

    public function createbackup()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        $backup = Backup::first();
        $host = env('DB_HOST');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $database = env('DB_DATABASE');

        $file = $backup->local . DIRECTORY_SEPARATOR . 'backup-sos.sql';

        if (!is_dir($backup->local)) {
            mkdir($backup->local, 0777, true);
        }

        if (PHP_OS_FAMILY == 'Linux') {
            // Backup do BD em Linux
            $dump = "/usr/bin/mysqldump --user={$username} --password={$password} --host={$host} {$database} --result-file={$file} 2>&1";
            exec($dump);
        }
        if (PHP_OS_FAMILY == 'Windows') {
            // Backup do BD em Windows
            $dump = "C:\webserver\mariadb\bin\mysqldump -u {$username} -p{$password} -h {$host} {$database} > {$file}";
            system($dump);
        }
        return $backup->local;
    }
}
