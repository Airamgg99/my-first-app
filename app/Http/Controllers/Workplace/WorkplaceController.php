<?php

namespace App\Http\Controllers\Workplace;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users\User_workplace;
use App\Models\Workplaces\Workplace;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class WorkplaceController extends Controller
{
    public function index()
    {
        return view('workplaces.index');
    }

    public function create()
    {
        return view('workplaces.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $workplace = new Workplace($request->all());
            $workplace->save();

            if (isset($request['user_ids'])) {
                foreach ($request['user_ids'] as $user_id) {
                    User_workplace::create([
                        'workplace_id' => $workplace->id,
                        'user_id' => $user_id
                    ]);
                }
            }

            DB::commit();
            Alert::toast('Workplace created successfully.', 'success');
            return redirect()->route('workplaces.edit', $workplace->id);
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Error creating workplace.');
        }
        return redirect()->route('workplaces.create');
    }

    public function edit($id)
    {
        $workplace = Workplace::find($id);

        return view('workplaces.edit', ['workplace' => $workplace]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $workplace = Workplace::find($id);
            $workplace->update($request->all());
            $user_ids = $request->input('user_ids', []);
            User_workplace::where('workplace_id', $workplace->id)->whereNotIn('user_id', $user_ids)->delete();

            foreach ($user_ids as $user_id) {
                User_workplace::updateOrCreate([
                    'workplace_id' => $workplace->id,
                    'user_id' => $user_id
                ]);
            }

            DB::commit();
            Alert::toast('Workplace updated successfully.', 'success');
            return redirect()->route('workplaces.edit', $workplace->id);
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Error updating workplace.');
        }

        return redirect()->route('workplaces.edit', $workplace->id);
    }

    public function download()
    {
        $fileName = 'workplaces.json';

        $this->makeJson();

        return Response::download(storage_path('app/download/' . $fileName), $fileName)->deleteFileAfterSend(true);
    }

    public function makeJson($zip = null)
    {
        $json = [];

        foreach (Workplace::all() as $workplace) {
            $json[] = $workplace->getJsonData();
        }

        $jsonContent = json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $fileName = 'workplaces.json';

        if ($zip) {
            $zip->add($jsonContent, $fileName);
            return $zip;
        } else {
            Storage::disk('download')->put($fileName, $jsonContent);
        }
    }
}
