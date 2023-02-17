<?php

namespace App\Http\Controllers;

use App\Domains\DebtDomain;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class DebtController extends Controller
{    
    public $cedente;
    private $domain;

    public function __construct()
    {
        $this->domain = new DebtDomain();
    }

    public function show() : Response
    {
        $debtsResponses = $this->domain->all();

        return Inertia::render('Debts/Show', [
            'debtsResponses' => $debtsResponses
        ]);
    }

    public function upload(Request $request) : RedirectResponse
    {
        $response = $this->domain->upload($request);

        if ( !$response ) {
            return redirect()->back()->withErrors([
                'create' => 'Arquivo não é do tipo csv, importação não foi realizada!',
            ]);
        }

        return Redirect::route('import');
    }

    public function generateTickets() : JsonResponse | RedirectResponse
    {
        $response = $this->domain->generateTickets();

        if ( !$response ) {
            return response()->json(['message' => 'Não há novos boletos a serem gerados!'], 404);
        }
        return Redirect::route('show');
    }

    public function returnBank(Request $request) : JsonResponse
    {
        $response = $this->domain->returnBank($request);

        if (!$response) {
            return response()->json(
                [
                    'message' => 'Retorno falhou, tente novamente!',
                    'data' => []
                ], 404
            );
        }

        return response()->json(
            [
                'message' => 'Retorno realizado com sucesso!',
                'data' => $response
            ], 200
        );
    }
}
