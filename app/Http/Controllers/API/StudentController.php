<?php

namespace App\Http\Controllers\API;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentCollection;
use App\Http\Resources\StudentResource;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::latest()->paginate(5);
        // return response()->json(['students' => $students], 200);
        return (new StudentCollection($students))
                ->response()
                ->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'first_name' => 'required|string|max:10',
            'last_name' => 'required|string|max:20',
            'gender' => 'required',
            'joined_year' => 'required',
            'teacher_id' => 'required',
            'classroom_id' => 'required',
        ]);

        $student = Student::create($request->all());
        // return response()->json($student, 201);
        return (new StudentResource($student))
                ->response()
                ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $this->validate($request, [
            'first_name' => 'required|string|max:10',
            'last_name' => 'required|string|max:20',
            'gender' => 'required',
            'joined_year' => 'required',
            'teacher_id' => 'required',
            'classroom_id' => 'required',
        ]);
        $student = Student::findOrFail($id);
        if (!$student) {
            return response()->json(['message' => "Student not found"], 404);
        }
        $student->update($request->all());
        return response()->json(['message' => "Student updated successfuly"], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        // return response()->json(null, 204);
        return ['message' => 'user deleted'];
    }
}
