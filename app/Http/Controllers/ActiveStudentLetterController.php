<?php

namespace App\Http\Controllers;

use App\Events\Activity;
use App\Events\LetterCreated;
use App\Events\LetterRejected;
use App\Events\LetterVerified;
use App\Models\ActiveStudentLetter;
use App\Models\Letter;
use App\Models\Student;
use Illuminate\Http\Request;

class ActiveStudentLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        gate('read-active-student-letter');

        $activeStudentLetters = ActiveStudentLetter::with(['student'])->orderBy('created_at', 'DESC')->get();

        return view('active-student-letter.index', [
            'activeStudentLetters' => $activeStudentLetters
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        gate('create-active-student-letter');

        $students = Student::orderBy('created_at', 'DESC')->get();

        return view('active-student-letter.create', [
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
        gate('create-active-student-letter');

        $data = $request->validate([
            'student_id' => ['required', 'uuid'],
            'purpose' => ['required'],
        ]);

        $activeStudentLetter = ActiveStudentLetter::create([
            'student_id' => $data['student_id'],
            'purpose' => $data['purpose'],
        ]);

        $activeStudentLetter->letter()->save(new Letter([
            'note' => 'Surat telah dibuat dan menunggu untuk diverifikasi'
        ]));

        LetterCreated::dispatch(ActiveStudentLetter::class, $activeStudentLetter);
        Activity::dispatch('membuat surat keterangan siswa aktif');

        return to_route('active-student-letter.index')->with('swal.success', 'Surat berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActiveStudentLetter  $activeStudentLetter
     * @return \Illuminate\Http\Response
     */
    public function show(ActiveStudentLetter $activeStudentLetter)
    {
        gate('read-active-student-letter');

        return view('active-student-letter.show', [
            'activeStudentLetter' => $activeStudentLetter
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActiveStudentLetter  $activeStudentLetter
     * @return \Illuminate\Http\Response
     */
    public function edit(ActiveStudentLetter $activeStudentLetter)
    {
        gate('update-active-student-letter');

        $students = Student::orderBy('created_at', 'DESC')->get();

        return view('active-student-letter.edit', [
            'activeStudentLetter' => $activeStudentLetter,
            'students' => $students
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ActiveStudentLetter  $activeStudentLetter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActiveStudentLetter $activeStudentLetter)
    {
        gate('update-active-student-letter');

        $data = $request->validate([
            'student_id' => ['required', 'uuid'],
            'purpose' => ['required'],
        ]);

        $activeStudentLetter->student_id = $data['student_id'];
        $activeStudentLetter->purpose = $data['purpose'];
        $activeStudentLetter->save();

        Activity::dispatch('memperbarui surat keterangan siswa aktif');

        return to_route('active-student-letter.show', ['activeStudentLetter' => $activeStudentLetter])
            ->with('swal.success', 'Surat berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActiveStudentLetter  $activeStudentLetter
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActiveStudentLetter $activeStudentLetter)
    {
        gate('delete-active-student-letter');

        if ($signature = $activeStudentLetter->letter->signature) {
            $signature->delete();
        }
        $activeStudentLetter->delete();
        $activeStudentLetter->letter()->delete();

        Activity::dispatch('menghapus surat keterangan siswa aktif');

        return to_route('active-student-letter.index')->with('swal.success', 'Surat keterangan aktif berhasil dihapus');
    }

    public function verify(Request $request, ActiveStudentLetter $activeStudentLetter)
    {
        gate('update-active-student-letter-verification');

        if ($activeStudentLetter->letter->verified()) {
            return back()->with('swal.warning', 'Surat sudah diverifikasi');
        } elseif ($activeStudentLetter->letter->rejected()) {
            return back()->with('swal.warning', 'Tidak dapat memverifikasi surat yang telah ditolak');
        }

        $data = $request->validate([
            'note' => ['nullable', 'string', 'max:1000', 'min:5'],
        ]);

        $activeStudentLetter->letter->verify($data['note'], [
            "Jenis" => "Surat Keterangan Siswa Aktif",
            "Ditujukan Kepada" => $activeStudentLetter->student->name,
            "Dibuat Untuk" => $activeStudentLetter->purpose,
        ]);

        LetterVerified::dispatch(ActiveStudentLetter::class, $activeStudentLetter);

        Activity::dispatch('memverifikasi surat keterangan siswa aktif');

        return to_route('active-student-letter.show', ['activeStudentLetter' => $activeStudentLetter])
            ->with('swal.success', 'Surat berhasil diverifikasi');
    }

    public function reject(Request $request, ActiveStudentLetter $activeStudentLetter)
    {
        gate('update-active-student-letter-verification');

        if ($activeStudentLetter->letter->rejected()) {
            return back()->with('swal.warning', 'Surat sudah ditolak');
        } elseif ($activeStudentLetter->letter->verified()) {
            return back()->with('swal.warning', 'Tidak dapat menolak surat yang telah diverifikasi');
        }

        $data = $request->validate([
            'note' => ['nullable', 'string', 'max:1000', 'min:5'],
        ]);

        $activeStudentLetter->letter->reject($data['note']);

        LetterRejected::dispatch(ActiveStudentLetter::class, $activeStudentLetter);

        Activity::dispatch('menolak surat keterangan siswa aktif');

        return to_route('active-student-letter.show', ['activeStudentLetter' => $activeStudentLetter])
            ->with('swal.success', 'Surat telah ditolak');
    }

    public function print(ActiveStudentLetter $activeStudentLetter)
    {
        gate('read-active-student-letter');

        if (!$activeStudentLetter->letter->verified()) {
            return back()->with('swal.warning', 'Tidak dapat mencetak surat yang tidak terverifikasi');
        }

        config(['page.title' => 'Surat Keterangan Siswa Aktif - ' . $activeStudentLetter->student->name]);

        $signature = $activeStudentLetter->letter->signature;
        $decoded = json_decode($signature->payload, true);
        $url = url(route('signature.check', ['signature' => $signature]));

        return view('active-student-letter.print', [
            'activeStudentLetter' => $activeStudentLetter,
            'decoded' => $decoded,
            'url' => $url
        ]);
    }
}
