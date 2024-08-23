<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Models\Jobs\Job;
use App\Models\Users\User_job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class JobController extends Controller
{
    public function index()
    {
        return view('jobs.index');
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $job = new Job($request->all());
            $job->save();

            if (isset($request['user_ids'])) {
                foreach ($request['user_ids'] as $user_id) {
                    User_job::create([
                        'job_id' => $job->id,
                        'user_id' => $user_id
                    ]);
                }
            }

            DB::commit();
            Alert::toast('Job created successfully.', 'success');
            return redirect()->route('jobs.edit', $job->id);
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Error creating job.');
        }

        return redirect()->route('jobs.create');
    }

    public function edit($id)
    {
        $job = Job::find($id);

        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $job = Job::find($id);
            $job->update($request->all());
            $user_ids = $request->input('user_ids', []);
            User_job::where('job_id', $job->id)->whereNotIn('user_id', $user_ids)->delete();

            foreach ($user_ids as $user_id) {
                User_job::updateOrCreate([
                    'job_id' => $job->id,
                    'user_id' => $user_id
                ]);
            }

            DB::commit();
            Alert::toast('Job updated successfully.', 'success');
            return redirect()->route('jobs.edit', $job->id);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            Alert::error('Error updating job.');
        }

        return redirect()->route('jobs.edit', $job->id);
    }

    public function download()
    {
        $fileName = 'jobs.json';

        $this->makeJson();

        return Response::download(storage_path('app/download/' . $fileName), $fileName)->deleteFileAfterSend(true);
    }

    public function makeJson($zip = null)
    {
        $json = [];

        foreach (Job::all() as $job) {
            $json[] = $job->getJsonData();
        }

        $jsonContent = json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $fileName = 'jobs.json';

        if ($zip) {
            $zip->add($jsonContent, $fileName);
            return $zip;
        } else {
            Storage::disk('download')->put($fileName, $jsonContent);
        }
    }
}
