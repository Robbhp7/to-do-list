<?php

namespace App\Http\Controllers;

use App\Http\Resources\Tasks\TaskResource;
use App\Repositories\Tasks\TasksRepository;
use Illuminate\Http\Request;

class TasksController extends Controller
{

    public function index(Request $request)
    {
        $items = (new TasksRepository)->all();

        if($request->ajax)
        {
            return new TaskResource($items, [], []);
        }
        return view('tasks.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ],[
            'name.required' => 'The name field is required',
        ]);

        $item = (new TasksRepository)->create($request->all());

        if($request->ajax)
        {
            return new TaskResource($item, [], []);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $item = (new TasksRepository)->find($id);

        if($request->ajax)
        {
            return new TaskResource($item, [], []);
        }

        return new TaskResource($item, [], []);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
        ],[
            'name.required' => 'The name field is required',
        ]);

        $item = (new TasksRepository)->update($id, $request->all());

        if($request->ajax)
        {
            return new TaskResource($item, [], []);
        }

        return redirect()->back();
    }

    public function updateStatus(Request $request, $id)
    {
        $item = (new TasksRepository)->update($id, $request->all(), ['method' => 'update-status']);

        if($request->ajax)
        {
            return new TaskResource($item, [], []);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $item = (new TasksRepository)->delete($id);

        if($request->ajax)
        {
            return new TaskResource($item, [], []);
        }

        return redirect()->back();
    }
}
