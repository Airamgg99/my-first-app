<?php

namespace App\Http\Controllers\Admin;

use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jobs\Job;
use App\Models\Roles\Role;
use App\Models\Statuses\Status;
use App\Models\Users\User_contract_type;
use App\Models\Users\User_job;
use App\Models\Users\User_workplace;
use App\Models\Workplaces\Workplace;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        $roles = Role::all();
        $status = Status::all();
        $workplace = Workplace::all();
        $job = Job::all();

        return view('users.create', ['roles' => $roles, 'statuses' => $status, 'workplaces' => $workplace, 'jobs' => $job]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create($request->except('image'));
            if (isset($request['workplace_id'])) {
                foreach ($request['workplace_id'] as $workplace_id) {
                    User_workplace::create([
                        'user_id' => $user->id,
                        'workplace_id' => $workplace_id
                    ]);
                }
            }
            if (isset($request['job_id'])) {
                foreach ($request['job_id'] as $job_id) {
                    User_job::create([
                        'user_id' => $user->id,
                        'job_id' => $job_id
                    ]);
                }
            }
            if (isset($request['contract_type_id'])) {
                foreach ($request['contract_type_id'] as $contract_type_id) {
                    User_contract_type::create([
                        'user_id' => $user->id,
                        'contract_type_id' => $contract_type_id
                    ]);
                }
            }

            $imageName = '';
            if ($request->hasFile('image')) {
                $userUUID = $user->uuid;
                $image = $request->file('image')->get();
                $imageName = $userUUID . '.png';

                Storage::disk('users')->put($imageName, $image);
                $user->image = $imageName;
                $user->save();
            }

            DB::commit();
            Alert::toast('User created successfully.', 'success');
            return redirect()->route('users.edit', $user->id);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            Alert::toast('Error creating user.', 'error');
        }

        return redirect()->route('users.create');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $status = Status::all();
        $workplace = Workplace::all();
        $job = Job::all();

        return view('users.edit', ['user' => $user, 'roles' => $roles, 'statuses' => $status, 'workplaces' => $workplace, 'jobs' => $job]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);

            $user->update($request->all());

            if ($request->hasFile('image')) {
                if ($user->image) {
                    Storage::disk('users')->delete($user->image);
                }

                $userUUID = $user->uuid;
                $image = $request->file('image');
                if ($image) {
                    $imageName = $userUUID . '.png';
                    Storage::disk('users')->put($imageName, $image->get());
                    $user->image = $imageName;
                    $user->save();
                }
            }

            DB::commit();
            Alert::toast('User updated successfully.', 'success');
            return redirect()->route('users.edit', $user->id);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            Alert::toast('Error updating user.', 'error');
        }

        return redirect()->route('users.edit', $user->id);
    }

    public function download()
    {
        $fileName = 'users.json';

        $this->makeJson();

        return Response::download(storage_path('app/download/' . $fileName), $fileName)->deleteFileAfterSend(true);
    }

    public function makeJson($zip = null)
    {
        $json = [];

        foreach (User::all() as $user) {
            $json[] = $user->getJsonData();
        }

        $jsonContent = json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $fileName = 'users.json';

        if ($zip) {
            $zip->add($jsonContent, $fileName);
            return $zip;
        } else {
            Storage::disk('download')->put($fileName, $jsonContent);
        }
    }
}
