<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Debt;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class DebtController extends Controller
{
    public function show() 
    {
        $debtsResponses = Debt::get();

        return Inertia::render('Debts/Show', [
            'debtsResponses' => $debtsResponses
        ]);
    }

    public function upload(Request $request) : void
    {
        $extension = '.'.$request->file->getClientOriginalExtension();
        
        $typeFile = $request->file . $extension;

        $file = $request->file->storeAs('imports', $typeFile);

        $this->create($file);
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
}
