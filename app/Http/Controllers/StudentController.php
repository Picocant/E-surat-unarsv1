<?php

namespace App\Http\Controllers;

use App\Events\Activity;
use App\Models\Student;
use App\Models\StudentCertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        gate('read-student');

        $students = Student::orderBy('created_at', 'DESC')->get();

        return view('student.index', [
            'students' => $students,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        gate('create-student');

        return view('student.create', [
            'genders' => Student::GENDERS,
            'status' => Student::STATUS,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        gate('create-student');

        $data = $request->validate([
            'name' => ['required', 'max:50'],
            'student_number' => ['required', 'max:50', Rule::unique('students', 'student_number')],
            'date_of_bird' => ['required', 'date'],
            'gender' => ['required', Rule::in(Student::GENDERS)],
            'address' => ['required'],
            'father' => ['required', 'max:50'],
            'mother' => ['required', 'max:50'],
            'guardian' => ['nullable', 'max:50'],
            'fakultas' => ['required', 'max:50'],
            'prodi' => ['required', 'max:50'],
            'status' => ['required', Rule::in(Student::STATUS)],
        ]);

        Student::create([
            'name' => $data['name'],
            'student_number' => $data['student_number'],
            'date_of_bird' => $data['date_of_bird'],
            'gender' => $data['gender'],
            'address' => $data['address'],
            'father' => $data['father'],
            'mother' => $data['mother'],
            'guardian' => $data['guardian'],
            'fakultas' => $data['fakultas'],
            'prodi' => $data['prodi'],
            'status' => $data['status'],
        ]);

        Activity::dispatch('membuat data mahasiswa');

        return to_route('student.index')->with('swal.success', 'Data Mahasiswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        gate('read-student');

        return view('student.show', [
            'student' => $student
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        gate('update-student');

        return view('student.edit', [
            'student' => $student,
            'genders' => Student::GENDERS,
            'status' => Student::STATUS
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        gate('update-student');

        $data = $request->validate([
            'name' => ['required', 'max:50'],
            'student_number' => ['required', 'max:50', Rule::unique('students', 'student_number')->ignore($student->id)],
            'date_of_bird' => ['required', 'date'],
            'gender' => ['required', Rule::in(Student::GENDERS)],
            'address' => ['required'],
            'father' => ['required', 'max:50'],
            'mother' => ['required', 'max:50'],
            'guardian' => ['nullable', 'max:50'],
            'fakultas' => ['required', 'max:50'],
            'prodi' => ['required', 'max:50'],
            'status' => ['required', Rule::in(Student::STATUS)],
        ]);

        $student->name = $data['name'];
        $student->student_number = $data['student_number'];
        $student->date_of_bird = $data['date_of_bird'];
        $student->gender = $data['gender'];
        $student->address = $data['address'];
        $student->father = $data['father'];
        $student->mother = $data['mother'];
        $student->guardian = $data['guardian'];
        $student->fakultas = $data['fakultas'];
        $student->prodi = $data['prodi'];
        $student->status = $data['status'];
        $student->save();

        Activity::dispatch('memperbarui data siswa');

        return to_route('student.show', ['student' => $student])->with('swal.success', 'Data Mahasiswa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        gate('delete-student');

        $student->delete();

        if ($student->student_certificate != null) {
            $studentCertificate = StudentCertificate::where('student_id', $student->id)->first();
            Storage::delete($studentCertificate->file);
            $studentCertificate->delete();
        }
        $student->school_transfer_letters()->delete();

        Activity::dispatch('menghapus data Mahasiswa');

        return to_route('student.index')->with('swal.success', 'Data Mahasiswa berhasil dihapus');
    }
}
