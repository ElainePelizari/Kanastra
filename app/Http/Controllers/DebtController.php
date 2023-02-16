<?php

namespace App\Http\Controllers;

use App\Domains\DebtDomain;
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

    public function generateTickets() : void
    {
        $this->domain->generateTickets();
    }
}
