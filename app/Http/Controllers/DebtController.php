<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Debt;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class DebtController extends Controller
{
    public function show() : Response
    {
        $debtsResponses = Debt::get();

        return Inertia::render('Debts/Show', [
            'debtsResponses' => $debtsResponses
        ]);
    }

    public function upload(Request $request) : RedirectResponse
    {
        $extension = '.'.$request->file->getClientOriginalExtension();

        if ($extension !== '.csv') {
            return redirect()->back()->withErrors([
                'create' => 'Arquivo não é do tipo csv, importação não foi realizada!',
            ]);
        }
        
        $typeFile = $request->file . $extension;

        $file = $request->file->storeAs('imports', $typeFile);

        $this->create($file);

        return Redirect::route('import');
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

    }
}
