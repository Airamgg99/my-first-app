<?php

namespace App\Http\Controllers\Contract_type;

use App\Http\Controllers\Controller;
use App\Models\ContractTypes\ContractType;
use App\Models\Users\User_contract_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ContractTypeController extends Controller
{
    public function index()
    {
        return view('contract_types.index');
    }

    public function create()
    {
        return view('contract_types.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $contract_type = new ContractType(($request->all()));
            $contract_type->save();

            if (isset($request['user_ids'])) {
                foreach ($request['user_ids'] as $user_id) {
                    User_contract_type::create([
                        'contract_type_id' => $contract_type->id,
                        'user_id' => $user_id
                    ]);
                }
            }

            DB::commit();
            Alert::toast('Contract type created successfully.', 'success');
            return redirect()->route('contract_types.edit', $contract_type->id);
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Error creating contract type.');
        }

        return redirect()->route('contract_types.create');
    }

    public function edit($id)
    {
        $contract_type = ContractType::find($id);

        return view('contract_types.edit', ['contract_type' => $contract_type]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $contract_type = ContractType::find($id);
            $contract_type->update($request->all());
            $user_ids = $request->input('user_ids', []);
            User_contract_type::where('contract_type_id', $contract_type->id)->whereNotIn('user_id', $user_ids)->delete();

            foreach ($user_ids as $user_id) {
                User_contract_type::updateOrCreate([
                    'contract_type_id' => $contract_type->id,
                    'user_id' => $user_id
                ]);
            }

            DB::commit();
            Alert::toast('Contract type updated successfully.', 'success');
            return redirect()->route('contract_types.edit', $contract_type->id);
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Error updating contract type.');
        }

        return redirect()->route('contract_types.edit', $contract_type->id);
    }

    public function download()
    {
        $fileName = 'contract_types.json';

        $this->makeJson();

        return Response::download(storage_path('app/download/' . $fileName), $fileName)->deleteFileAfterSend(true);
    }

    public function makeJson($zip = null)
    {
        $json = [];

        foreach (ContractType::all() as $contract_type) {
            $json[] = $contract_type->getJsonData();
        }

        $jsonContent = json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $fileName = 'contract_types.json';

        if ($zip) {
            $zip->add($jsonContent, $fileName);
            return $zip;
        } else {
            Storage::disk('download')->put($fileName, $jsonContent);
        }
    }
}
