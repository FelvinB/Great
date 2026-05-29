<?php

namespace App\Http\Controllers;

use App\Service\StudentService;
use Illuminate\Http\Request;

class StudentController
{
    public function __construct(
        private StudentService $student
    ) {}

    public function show()
    {
        return $this->student->get();
    }

    public function create(Request $request)
    {
        $student_data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'age' => 'required',
        ]);

        return $this->student->create($student_data);
    }

    public function delete($id)
    {
        return $this->student->delete($id);
    }
}