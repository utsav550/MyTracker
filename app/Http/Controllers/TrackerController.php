<?php

namespace App\Http\Controllers;

use App\Models\tracker;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class TrackerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userid = session('ADMIN_ID');
        $date = date('Y.m.d');

        $petani = tracker::where(['user_id' => $userid, 'date' => $date])->get();

        return view('admin.work', ['petani' => $petani]);
    }

    public function work()
    {
        $userid = session('ADMIN_ID');
        $date = date('Y.m.d');

        $petani = tracker::where(['user_id' => $userid, 'date' => $date])->get();

        return view('admin.work', ['petani' => $petani]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        $userid = session('ADMIN_ID');
        $date = date('Y.m.d');
        $friend = 0;

        if ($request->post('f1') != null) {
            $friend = $friend + 1;
        }
        if ($request->post('f2') != null) {
            $friend = $friend + 1;
        }
        $result = tracker::where(['user_id' => $userid, 'date' => $date])->get();
        if (isset($result['0']->id)) {
            $trackerid = $result['0']->id;


            $model2 = tracker::where('id', $trackerid)
                ->update(
                    [
                        'day' => $request->post('score'),
                        'spent' => $request->post('spent'),
                        'work' => $request->post('hours'),
                        'friend' => $friend
                    ],
                );
            return redirect('admin/tracker');
        } else {

            $model = new tracker();
            $model->date = $date;
            $model->user_id = $userid;
            $model->spent = $request->post('spent');
            $model->day = $request->post('score');
            $model->work = $request->post('hours');
            $model->friend = $friend;
            $model->save();
            return redirect('admin/tracker');
        }
    }


    public function day()
    {
        $userid = session('ADMIN_ID');
        $date = date('Y.m.d');

        $items = tracker::select('*')
            ->whereBetween(
                'created_at',
                [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()]
            )
            ->get()
            ->toArray();

        print_r($items);
        echo "hello";
        exit();

        $petani = tracker::where(['user_id' => $userid, 'date' => $date])->get();

        return view('admin.work', ['petani' => $petani]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tracker  $tracker
     * @return \Illuminate\Http\Response
     */
    public function show(tracker $tracker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tracker  $tracker
     * @return \Illuminate\Http\Response
     */
    public function edit(tracker $tracker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tracker  $tracker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tracker $tracker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tracker  $tracker
     * @return \Illuminate\Http\Response
     */
    public function destroy(tracker $tracker)
    {
        //
    }
}
