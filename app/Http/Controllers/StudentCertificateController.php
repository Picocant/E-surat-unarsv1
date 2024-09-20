<?php

namespace App\Http\Controllers;

use App\Events\Activity;
use App\Models\Archive;
use App\Models\Student;
use App\Models\StudentCertificate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

class StudentCertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        gate('read-student-certificate');

        $studentCertificates = StudentCertificate::with('student')->orderBy('created_at', 'DESC')->get();

        return view('student-certificate.index', [
            'studentCertificates' => $studentCertificates
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        gate('create-student-certificate');

        $students = Student::doesntHave('student_certificate')->get();

        return view('student-certificate.create', [
            'students' => $students
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
        gate('create-student-certificate');

        $data = $request->validate([
            'student_id' => ['required', 'uuid'],
            'number' => ['required', 'max:100'],
            'date' => ['required', 'date'],
            'academic_year' => ['required', 'regex:/([0-9]{4}\/[0-9]{4})/'],
            'file' => ['required', 'file', 'max:10240', 'mimetypes:application/pdf']
        ]);

        if (!$request->file('file')->isValid()) {
            return back()->with('swal.warning', 'Gagal mengupload file');
        }

        if (StudentCertificate::where('student_id', $data['student_id'])->count() != 0) {
            return back()->with('swal.warning', 'Arsip ijazah siswa sudah ditambahkan');
        }

        $studentCertificate = StudentCertificate::create([
            'student_id' => $data['student_id'],
            'number' => $data['number'],
            'date' => $data['date'],
            'academic_year' => $data['academic_year'],
            'file' => $request->file('file')->storePublicly('student-certificates'),
        ]);

        $studentCertificate->archive()->save(new Archive());

        Activity::dispatch('membuat arsip ijazah siswa');

        return to_route('student-certificate.index')->with('swal.success', 'Arsip ijazah siswa berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentCertificate  $studentCertificate
     * @return \Illuminate\Http\Response
     */
    public function show(StudentCertificate $studentCertificate)
    {
        gate('read-student-certificate');

        return view('student-certificate.show', [
            'studentCertificate' => $studentCertificate
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentCertificate  $studentCertificate
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentCertificate $studentCertificate)
    {
        gate('update-student-certificate');

        $students = Student::doesntHave('student_certificate')->orWhereHas('student_certificate', function (Builder $builder) use (&$studentCertificate) {
            $builder->where('student_id', $studentCertificate->student_id);
        })->get();

        return view('student-certificate.edit', [
            'students' => $students,
            'studentCertificate' => $studentCertificate
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentCertificate  $studentCertificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentCertificate $studentCertificate)
    {
        gate('update-student-certificate');

        $data = $request->validate([
            'student_id' => ['required', 'uuid'],
            'number' => ['required', 'max:100'],
            'date' => ['required', 'date'],
            'academic_year' => ['required', 'regex:/([0-9]{4}\/[0-9]{4})/'],
            'file' => ['nullable', 'file', 'max:10240', 'mimetypes:application/pdf']
        ]);

        if (StudentCertificate::where('student_id', $data['student_id'])->where('student_id', '!=', $studentCertificate->student_id)->count() != 0) {
            return back()->with('swal.warning', 'Arsip ijazah siswa sudah ditambahkan');
        }

        $studentCertificate->student_id = $data['student_id'];
        $studentCertificate->number = $data['number'];
        $studentCertificate->date = $data['date'];
        $studentCertificate->academic_year = $data['academic_year'];
        if ($request->file('file')) {
            Storage::delete($studentCertificate->file);
            $studentCertificate->file = $request->file('file')->storePublicly('student-certificates');
        }
        $studentCertificate->save();

        Activity::dispatch('memperbarui arsip ijazah siswa');

        return to_route('student-certificate.show', ['studentCertificate' => $studentCertificate])->with('swal.success', 'Arsip ijazah siswa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentCertificate  $studentCertificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentCertificate $studentCertificate)
    {
        gate('delete-student-certificate');

        $studentCertificate->delete();

        Activity::dispatch('menghapus arsip ijazah siswa');

        return to_route('student-certificate.index')->with('swal.success', 'Arsip ijazah siswa berhasil dihapus');
    }
}
