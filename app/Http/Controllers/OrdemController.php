<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Ordem;
use App\Models\Cliente;
use App\Models\Email;
use App\Models\Empresa;
use App\Models\Mensagem;
use App\Models\Peca;
use App\Models\Ordempeca;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDF;
use Illuminate\Support\Str;
use App\Models\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class OrdemController extends Controller
{
    /**
     * @var Ordem
     */
    protected $ordem;
    protected $cliente;
    protected $empresa;
    protected $mensagem;
    protected $peca;

    public function __construct(Ordem $ordem, Cliente $cliente, Empresa $empresa, Mensagem $mensagem, Peca $peca)
    {
        $this->ordem = $ordem;
        $this->cliente = $cliente;
        $this->empresa = $empresa;
        $this->mensagem = $mensagem;
        $this->peca = $peca;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $empresa = $this->empresa->get()->first();
        $mensagem = $this->mensagem->get()->first();
        if (!empty($empresa['empresa']) && !empty($mensagem['recebimento_recibo'])) :
            $link_blank = true;
        else :
            $link_blank = false;
        endif;
        $term = '';
        $ordens = $this->ordem->orderby('id_ordem', 'DESC')->paginate(15);
        return view('ordens.index', compact('ordens', 'term', 'link_blank'));
    }

    /**
     * Busca de ordens
     */
    public function busca(Request $request)
    {
        $empresa = $this->empresa->get()->first();
        $mensagem = $this->mensagem->get()->first();
        if (!empty($empresa['empresa']) && !empty($mensagem['recebimento_recibo'])) :
            $link_blank = true;
        else :
            $link_blank = false;
        endif;
        $term = $request->input('term');
        $status = $request->input('status');
        if (!empty($term)) :
            $ordens = $this->ordem->where('id_ordem', $term)->paginate(15);
        endif;
        if (!empty($status)) :
            $ordens = $this->ordem->orderby('id_ordem', 'DESC')->where('status', $request->input('status'))->paginate(15);
        endif;
        return view('ordens.index', compact('ordens', 'term', 'link_blank'));
    }

    /**
     * Busca de status
     */
    public function status(Request $request)
    {
        $empresa = $this->empresa->get()->first();
        $mensagem = $this->mensagem->get()->first();
        if (!empty($empresa['empresa']) && !empty($mensagem['recebimento_recibo'])) :
            $link_blank = true;
        else :
            $link_blank = false;
        endif;
        $status = $request->status;
        $term = false;
        if (!empty($status)) :
            $ordens = $this->ordem->orderby('id_ordem', 'DESC')->where('status', $status)->paginate(15);
        endif;
        return view('ordens.index', compact('ordens', 'term', 'link_blank'));
    }

    /**
     * Busca de pagamento
     */
    public function pagamento(Request $request)
    {
        $empresa = $this->empresa->get()->first();
        $mensagem = $this->mensagem->get()->first();
        if (!empty($empresa['empresa']) && !empty($mensagem['recebimento_recibo'])) :
            $link_blank = true;
        else :
            $link_blank = false;
        endif;
        $pagamento = $request->pagamento;
        $term = false;
        if (!empty($pagamento)) :
            $ordens = $this->ordem->orderby('id_ordem', 'DESC')->where('pagamento', $pagamento)->paginate(15);
        endif;
        return view('ordens.index', compact('ordens', 'term', 'link_blank'));
    }

    /**
     * Busca de ordens
     */
    public function ordemcliente($cliente)
    {

        if (!empty($empresa['empresa']) && !empty($mensagem['recebimento_recibo'])) :
            $link_blank = true;
        else :
            $link_blank = false;
        endif;
        $term = 'clientes';
        $ordens = $this->ordem->where('cliente_id', $cliente)->paginate(15);
        return view('ordens.index', compact('ordens', 'term', 'link_blank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ordens = $this->ordem->orderby('id_ordem', 'ASC')->get();
        if ($ordens->count() > 0) :
            foreach ($ordens as $next) :
                $proxordem = $next->id_ordem;
            endforeach;
        else :
            $proxordem = 1;
        endif;
        return view('ordens.create', compact('proxordem'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Ordem $ordem)
    {
        $data = $request->all();
        $rules = [
            'cliente_id' => 'required',
            'equipamento' => 'required',
            'modelo' => 'required',
            'senha' => 'required',
            'defeito' => 'required',
            'estado' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo :attribute só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $data['id_ordem'] = Ordem::idordem();
        $data['previsao'] = Carbon::createFromFormat("d/m/Y", $request->previsao)->format("Y-m-d");
        $ordem->create($data);
        flash('<i class="fa fa-check"></i> Ordem de serviço criada com sucesso!')->success();
        return redirect()->route('ordens.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ordem  $ordem
     * @return \Illuminate\Http\Response
     */
    public function show(Ordem $orden)
    {
        $email = Email::first();
        $users = User::where('funcao', 3)->get();
        $ordens = Ordempeca::where('id_ordem', $orden->id_ordem)->get();
        return view('ordens.edit', compact('orden', 'ordens', 'users', 'email'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ordem  $ordem
     * @return \Illuminate\Http\Response
     */
    public function edit(Ordem $ordem)
    {
        return redirect()->route('ordens.show', ['ordem' => $ordem->id_ordem]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ordem  $ordem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ordem $orden)
    {

        $data = $request->all();
        $rules = [
            'cliente_id' => 'required',
            'equipamento' => 'required',
            'modelo' => 'required',
            'senha' => 'required',
            'defeito' => 'required',
            'estado' => 'required',
            'acessorios' => 'nullable',
            'observacoes' => 'nullable',
            'previsao' => 'nullable',
            'orcamento' => 'nullable',
            'valorcamento' => 'nullable',
            'servico' => 'nullable',
            'valservico' => 'nullable',
            'valtotal' => 'nullable',
            'status' => 'nullable', //orcamento,comunicado, entregue
            'pagamento' => 'nullable', // 1 - Aberto, 2 - Somente peças, 3 - Somente serviços, 4 - Totalotal
            'dt_entrega' => 'nullable',
            'tecnico' => 'nullable'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo :attribute só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        try {
            $data['previsao'] = Carbon::createFromFormat("d/m/Y", $request->previsao)->format("Y-m-d");
            $orden->update($data);

            if ($request->getemail == true) :
                return redirect()->route('ordens.enviaremail', ['ordemid' => Ordem::idordem() - 1, 'clienteid' => $request->cliente_id]);
            else :
                flash('<i class="fa fa-check"></i> Ordem alterada com sucesso!')->success();
                return redirect()->route('ordens.show', ['orden' => $orden->id_ordem]);
            endif;

        } catch (\Exception $e) {
            $message = 'Erro ao inserir ordem!';
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
     * @param  \App\Models\Ordem  $ordem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ordem $orden)
    {
        $orden->delete();
        flash('<i class="fa fa-check"></i> Ordem removida com sucesso!')->success();
        return redirect()->route('ordens.index');
    }

    /**
     * Autocomplete campo cliente
     */
    public function autocomplete(Request $request)
    {
        $term = $request->input('term');
        if ($term == '') :
            $ordens = $this->ordem->orderby('id_ordem', 'ASC')->select('id_ordem')->limit(5)->get();
        else :
            $ordens = $this->ordem->orderby('id_ordem', 'ASC')->select('id_ordem')->where('id_ordem', 'LIKE', $term . '%')->get();
        endif;

        foreach ($ordens as $ordem) {
            $response[] = ['value' => $ordem->id_ordem];
        }
        return response()->json($response);
    }

    /**
     * Imprime recibos de Ordens de serviço
     */
    public function reciborecebe(Ordem $orden)
    {
        $empresa = $this->empresa->get()->first();
        $mensagem = $this->mensagem->get()->first();
        if (!empty($empresa['empresa']) && !empty($mensagem['recebimento_recibo'])) :
            $this->recibo($orden, 'ordens.reciborecebe');
        else :
            flash('<i class="fa fa-check"></i> Preencha os dados da empresa e mensagens de sistema!')->warning();
            return redirect()->route('ordens.index');
        endif;
    }

    public function reciboentrega(Ordem $orden)
    {
        $empresa = $this->empresa->get()->first();
        $mensagem = $this->mensagem->get()->first();
        if (!empty($empresa['empresa']) && !empty($mensagem['recebimento_recibo'])) :
            $this->recibo($orden, 'ordens.reciboentrega');
        else :
            flash('<i class="fa fa-check"></i> Preencha os dados da empresa e mensagens de sistema!')->warning();
            return redirect()->route('ordens.index');
        endif;
    }

    public function recibo($orden, $recibo)
    {
        $ordens = $this->ordem->where('id_ordem', $orden->id_ordem)->get()->first();
        $empresa = $this->empresa->get()->first();
        $mensagem = $this->mensagem->get()->first();
        $data = [
            'ordens' => $ordens,
            'empresa' => $empresa,
            'mensagem' => $mensagem
        ];

        $pdf = PDF::loadView($recibo, $data);

        // download PDF file with download method
        return $pdf->stream('recibo.pdf');
    }

    public function enviaremail(Request $request)
    {
        $emaildata = Email::first();
        $ordem = Ordem::where('id_ordem', $request->ordemid)->first();
        $mensagem = Mensagem::first();
        $tecnico = User::where('id', $ordem->tecnico)->first();
        $cliente = Cliente::where('id_cliente', $request->clienteid)->first();
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
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "Conclusão de serviço de manutenção";
            $body = view('ordens.email', compact('ordem', 'mensagem', 'tecnico', 'cliente', 'empresa'));
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
