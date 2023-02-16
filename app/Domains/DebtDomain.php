<?php

namespace App\Domains;

use DateTime;
use Exception;
use Carbon\Carbon;
use App\Models\Debt;
use OpenBoleto\Agente;
use App\Mail\TicketUser;
use OpenBoleto\Banco\Itau;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

class DebtDomain
{
    public $cedente;

    public function __construct()
    {
        $this->cedente = new Agente('KANASTRA GESTAO DE RECURSOS', '44.870.662/0001-98', 'Avenida Dos Vinhedos', '38.411-848', 'Uberlandia', 'MG');
    }

    public function all() : Collection
    {
        $debtsResponses = Debt::get();

        return $debtsResponses;
    }

    public function upload(Request $request) : bool
    {
        $extension = '.'.$request->file->getClientOriginalExtension();

        if ($extension !== '.csv') {
            $response = false;
            return $response;
        }
        
        $typeFile = $request->file . $extension;

        $file = $request->file->storeAs('imports', $typeFile);

        $this->create($file);

        return $response = true;
    }

    public function create($file) : void
    {
        $file = Storage::disk('public')->readStream($file);
        $content = [];
    
        try {
            DB::beginTransaction();
            $header = fgetcsv($file);

            while(($line = fgetcsv($file)) !== false) {
                $fileContent = array_combine($header, $line);

                $content[] = [
                    'debtId' => intval($fileContent['debtId']),
                    'name' => $fileContent['name'],
                    'cpf' => $fileContent['governmentId'],
                    'email' => $fileContent['email'],
                    'debtAmount' =>  floatval($fileContent['debtAmount']),
                    'debtDueDate' => $fileContent['debtDueDate'],
                    'status_ticket' => false,
                    'paid' => false,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
            Debt::insert($content);
            DB::commit();
            fclose($file);
        } catch (\Throwable $ex) {
            DB::rollback();
        }
    }

    public function generateTickets() : void
    {
        try {
            DB::beginTransaction();
            $debts = Debt::where('status_ticket', false)->get();
            $cedente = $this->cedente;

            $debts->each( function($debt) use($cedente) {
                $sacado = new Agente($debt->name, $debt->cpf, 'ABC 302 Bloco N', '72000-000', 'Brasília', 'DF');
                $boleto = new Itau(array(
                    'dataVencimento' => new DateTime($debt->debtDueDate),
                    'valor' => $debt->debtAmount,
                    'sequencial' => 12345678,
                    'sacado' => $sacado,
                    'cedente' => $cedente,
                    'agencia' => 1724, 
                    'carteira' => 112,
                    'conta' => 12345   
                ));
                $boletoHtml = $boleto->getOutput();
                Mail::to($debt)->send(new TicketUser($boletoHtml));
                $debt->status_ticket = true;
                $debt->save();

            });
            DB::commit();
            
        } catch (Exception $ex) {
            DB::rollback();
        }
    }
}