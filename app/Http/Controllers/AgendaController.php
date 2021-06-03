<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Cliente;
use App\Models\User;
use App\Models\Email;
use App\Models\Mensagem;
use App\Models\Empresa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class AgendaController extends Controller
{
    /**
     * @var Agenda
     * @var User
     * @var Email
     * @var Cliente
     * @var Mensagem
     * @var Empresa
     * @var status
     */
    protected $agenda;
    protected $user;
    protected $email;
    protected $cliente;
    protected $mensagem;
    protected $empresa;

    public function __construct(Agenda $agenda, User $user, Email $email, Cliente $cliente, Mensagem $mensagem, Empresa $empresa)
    {
        $this->agenda = $agenda;
        $this->user = $user;
        $this->email = $email;
        $this->cliente = $cliente;
        $this->mensagem = $mensagem;
        $this->empresa = $empresa;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $term = '';
        $agendas = $this->agenda->orderBy('id_agenda', 'DESC')->paginate(15);
        return view('agendas.index', compact('agendas', 'term'));
    }

    /**
     * Busca de agendamentos por data
     */
    // public function busca(Request $request)
    // {
    //     $term = Carbon::createFromFormat("d/m/Y", $request->input('term'))->format("Y-m-d");
    //     $agendas = $this->agenda->where('data', $term)->get();
    //     return view('agendas.index', compact('agendas', 'term'));
    // }
    public function busca(Request $request)
    {
        $status = $request->status;
        $term = $request->term;
        $empresa = $this->empresa->get()->first();
        $mensagem = $this->mensagem->get()->first();
        if (!empty($empresa['empresa']) && !empty($mensagem['recebimento_recibo'])) :
            $link_blank = true;
        else :
            $link_blank = false;
        endif;

        if (!empty($term)) :
            $term = Carbon::createFromFormat("d/m/Y", $term)->format("Y-m-d");
            $agendas = $this->agenda->where('data', $term)->paginate(15);
        endif;
        if (!empty($status)) :
            $agendas = $this->agenda->orderby('id_agenda', 'DESC')->where('status', $status)->paginate(15);
        endif;
        return view('agendas.index', compact('agendas', 'term', 'link_blank'));
    }
    /**
     * Busca por status
     */
    public function status(Request $request)
    {
        $status = $request->status;
        $term = '';
        $empresa = Empresa::get()->first();
        $mensagem = Mensagem::get()->first();
        if (!empty($empresa['empresa']) && !empty($mensagem['recebimento_recibo'])) :
            $link_blank = true;
        else :
            $link_blank = false;
        endif;
        $agendas = Agenda::where('status', $status)->paginate(15);
        return view('agendas.index', compact('agendas', 'term', 'link_blank'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $email = Email::first();
        $users = $this->user->where('funcao', 3)->get();
        return view('agendas.create', compact('users', 'email'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'cliente_id' => 'required',
            'tecnico_id' => 'required',
            'data' => 'required',
            'hora' => 'required',
            'servico' => 'required',
            'detalhes' => 'required',
            'observacoes' => 'nullable'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo :attribute só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $data['id_agenda'] = Agenda::idagenda();
        $data['data'] = Carbon::createFromFormat("d/m/Y", $request->data)->format("Y-m-d");
        $data['status'] = 1;
        $this->agenda->create($data);
        if ($request->getemail == true) :
            return redirect()->route('agendas.enviaremail', ['agendaid' => Agenda::idagenda() - 1, 'clienteid' => $request->cliente_id]);
        else :
            flash('<i class="fa fa-check"></i> Agenda salva com sucesso!')->success();
            return redirect()->route('agendas.index');
        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Agenda $agenda)
    {
        $email = Email::first();
        $users = $this->user->where('funcao', 3)->get();
        return view('agendas.edit', compact('agenda', 'users', 'email'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Agenda $agenda)
    {
        return redirect()->route('agendas.show', ['agenda' => $agenda->id_agenda]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $agenda)
    {
        $data = $request->all();

        $rules = [
            'cliente_id' => 'required',
            'tecnico_id' => 'required',
            'data' => 'required',
            'hora' => 'required',
            'servico' => 'required',
            'detalhes' => 'required',
            'status' => 'required',
            'observacoes' => 'nullable'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo :attribute só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        try {
            $data['data'] = Carbon::createFromFormat("d/m/Y", $request->data)->format("Y-m-d");
            $agenda->update($data);
            if ($request->getemail == true) :
                return redirect()->route('agendas.enviaremail', ['agendaid' => $request->id_agenda, 'clienteid' => $request->cliente_id]);
            else :
                flash('<i class="fa fa-check"></i> Agenda salva com sucesso!')->success();
                return redirect()->route('agendas.show', ['agenda' => $agenda->id_agenda]);
            endif;
        } catch (\Exception $e) {
            $message = 'Erro ao inserir agenda!';
            if (env('APP_DEBUG')) {
                $message = $e->getMessage();
            }
            flash($message)->warning();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        flash('<i class="fa fa-check"></i> Agenda removido com sucesso!')->success();
        return redirect()->route('agendas.index');
    }

    public function enviaremail(Request $request)
    {
        $status = function ($stat) {
            switch ($stat) {
                case '1':
                    return 'Aguardando atendimento';
                    break;
                case '2':
                    return 'Em atendimento';
                    break;
                case '3':
                    return 'Cancelado';
                    break;
                case '4':
                    return 'Concluído';
                    break;
            }
        };
        $emaildata = Email::first();
        $agenda = Agenda::where('id_agenda', $request->agendaid)->get()->first();
        $mensagem = Mensagem::first();
        $tecnico = User::where('id', $agenda['tecnico_id'])->get()->first();
        $cliente = Cliente::where('id_cliente', $request->clienteid)->get()->first();
        $empresa = Empresa::first();

        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();
            $mail->CharSet   = 'UTF-8';                                  //Send using SMTP
            $mail->Host       = $emaildata->servidor;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $emaildata->usuario;                     //SMTP username
            $mail->Password   = $emaildata->senha;                               //SMTP password
            $mail->SMTPSecure = $emaildata->seguranca == 'TLS' ? PHPMailer::ENCRYPTION_STARTTLS : PHPMailer::ENCRYPTION_SMTPS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = $emaildata->porta;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom($emaildata->usuario, '');
            $mail->addAddress($cliente->email, $cliente->cliente);     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
            $logoimg = $empresa->logo ? public_path('storage/thumbnail/' . $empresa->logo) : public_path('storage/images/logo_padrao.jpg');
            $mail->AddEmbeddedImage($logoimg, 'logoimg', $logoimg);

            //Content
            $statusmsg = $status($agenda->status);
            $data = date("d/m/Y",strtotime($agenda->data));
            $hora = date("H:i", strtotime($agenda->hora));
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "Atualização do agendamento de Serviços";
            $body = view('agendas.email', compact('agenda', 'mensagem', 'tecnico','cliente', 'empresa', 'status'));
            $mail->AltBody = 'Para conseguir essa e-mail corretamente, use um visualizador de e-mail com suporte a HTML';
            $mail->MsgHTML($body);

            if (!$mail->send()) {
                flash('<i class="fa fa-check"></i> E-mail ao cliente não enviado!')->warning($mail->ErrorInfo);
                return back();
            } else {
                flash('<i class="fa fa-check"></i> E-mail ao cliente enviado com sucesso!')->success();
                return back();
            }
        } catch (Exception $e) {
            flash('<i class="fa fa-check"></i> O e-mail não foi enviado corretamente Verifique as configurações do servidor de e-mail e tente novamente!')->warning();
            return back();
        }
    }
}
