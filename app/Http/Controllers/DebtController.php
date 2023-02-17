<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Domains\DebtDomain;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class DebtController extends Controller
{    
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
        if ( !Arr::get($request, 'file') ) {
            return redirect()->back()->withErrors([
                'create' => 'Nenhum arquivo foi inserido!',
            ]);
        }

        if ( $request->file->getMimeType() !== 'text/csv') {
            return redirect()->back()->withErrors([
                'create' => 'Arquivo não é do tipo csv, importação não foi realizada!',
            ]);
        }

        $this->domain->upload($request);

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
