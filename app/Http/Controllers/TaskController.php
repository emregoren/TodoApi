<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Resources\TaskResource;
use App\Models\Tasks;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return $this->apiResponse(TaskResource::collection(Tasks::all()), 'Tasks fetched');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function store(TaskStoreRequest $request)
    {
        $input = $request->all();
        $task = Tasks::create($input);

        return $this->apiResponse(
            $task,
            'task created',
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        return $this->apiResponse(new TaskResource(Tasks::find($id)), 'Tasks fetched');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Tasks $tasks
     * @return JsonResponse
     */
    public function update(Request $request, Tasks $tasks)
    {
        $input = $request->all();
        $task = Tasks::update($input);

        return $this->apiResponse(
            $task,
            'task updated',
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tasks $tasks
     * @return JsonResponse
     */
    public function destroy(Tasks $tasks)
    {
        $tasks->delete();
        return $this->apiResponse(null, 'Tasks deleted');

    }
}
