<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Type\Decimal;

class DebtController extends Controller
{
    public function upload(Request $request)
    {
        $extension = '.'.$request->file->getClientOriginalExtension();
        
        $typeFile = $request->file . $extension;

        $file = $request->file->storeAs('imports', $typeFile);

        $this->create($file);
        // return Inertia::render('ImportFile');
    }

    public function create($file)
    {
        $file = Storage::disk('public')->readStream($file);
        
        try {

            DB::beginTransaction();

            $header = fgetcsv($file);

            dump($header);

            while(($line = fgetcsv($file)) !== false) {
                $fileContent = array_combine($header, $line);
                dump($fileContent);
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

                dump($content);

                $result = Debt::insert($content);
                dd($result);
            }
            
            fclose($file);

            DB::commit();

            dd('finalizou');

        } catch (\Throwable $exception) {
            dd('caiu no catch', $exception);
            DB::rollback();
        }
    }
}
