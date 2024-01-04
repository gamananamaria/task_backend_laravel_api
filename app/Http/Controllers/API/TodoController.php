<?php

namespace App\Http\Controllers\API;

use App\Models\API\Todo;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $todo = Todo::orderBy('id', 'desc')->get();
        return response()->json($todo, 200);
    }

 
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       

        $validator = Validator::make($request->all(), [ 
            'nume_task' => 'required',
            'completed' => 'required',
        ]);

        if ($validator->fails()) {
            $errorMessage = $validator->errors()->first();
            $response = [
                'status'  => false,
                'message' => $errorMessage,
            ];
            return response()->json($response, 401);
        }

        $todo = Todo::create($request->all());
        
        return response()->json(['message' => "A fost adaugat", "data" => $todo ], 200);
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id_task)
    {   
        $todo = Todo::findOrFail($id_task);
        return response()->json(['message' => "Informatii despre task-ul cu id-ul".$id_task, "data" => $todo ], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'nume_task' => 'required',
            'completed' => 'required'
        ]);
   
        if($validator->fails()){
            $errorMessage = $validator->errors()->first();
            $response = [
                'status'  => false,
                'message' => $errorMessage,
            ];
            return response()->json($response, 401);    
        }
        $todo = Todo::findOrFail($id);   
        $todo->nume_task = $input['nume_task'];
        $todo->completed = $input['completed'];
        $todo->save();
   
        return response()->json(['message' => "A fost modificat", 'data' => $todo], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);        
        $todo->delete();
        return response()->json(['message' => "A fost sters", 'data' => $todo], 200);
    }
}
