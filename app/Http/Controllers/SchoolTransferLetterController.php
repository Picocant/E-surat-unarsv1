<?php

namespace App\Http\Controllers;

use App\Events\Activity;
use App\Events\LetterCreated;
use App\Events\LetterRejected;
use App\Events\LetterVerified;
use App\Models\Letter;
use App\Models\SchoolTransferLetter;
use App\Models\Student;
use Illuminate\Http\Request;

class SchoolTransferLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        gate('read-school-transfer-letter');

        $schoolTransferLetters = SchoolTransferLetter::orderBy('created_at', 'DESC')->get();

        return view('school-transfer-letter.index', [
            'schoolTransferLetters' => $schoolTransferLetters
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        gate('create-school-transfer-letter');

        $students = Student::all();

        return view('school-transfer-letter.create', [
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
        gate('create-school-transfer-letter');

        $data = $request->validate([
            'student_id' => ['required', 'uuid'],
            'new_school' => ['required', 'max:120'],
            'reason' => ['required'],
        ]);

        $schoolTransferLetter = SchoolTransferLetter::create([
            'student_id' => $data['student_id'],
            'new_school' => $data['new_school'],
            'reason' => $data['reason'],
        ]);

        $schoolTransferLetter->letter()->save(new Letter([
            'note' => 'Surat telah dibuat dan menunggu untuk diverifikasi'
        ]));

        LetterCreated::dispatch(SchoolTransferLetter::class, $schoolTransferLetter);

        Activity::dispatch('membuat surat keterangan pindah sekolah');

        return to_route('school-transfer-letter.index')->with('swal.success', 'Surat berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolTransferLetter  $schoolTransferLetter
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolTransferLetter $schoolTransferLetter)
    {
        gate('read-school-transfer-letter');

        return view('school-transfer-letter.show', [
            'schoolTransferLetter' => $schoolTransferLetter
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolTransferLetter  $schoolTransferLetter
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolTransferLetter $schoolTransferLetter)
    {
        gate('update-school-transfer-letter');

        return view('school-transfer-letter.edit', [
            'students' => Student::all(),
            'schoolTransferLetter' => $schoolTransferLetter
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SchoolTransferLetter  $schoolTransferLetter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchoolTransferLetter $schoolTransferLetter)
    {
        gate('update-school-transfer-letter');

        $data = $request->validate([
            'student_id' => ['required', 'uuid'],
            'new_school' => ['required', 'max:120'],
            'reason' => ['required'],
        ]);

        $schoolTransferLetter->student_id = $data['student_id'];
        $schoolTransferLetter->new_school = $data['new_school'];
        $schoolTransferLetter->reason = $data['reason'];
        $schoolTransferLetter->save();

        Activity::dispatch('memperbarui surat keterangan pindah sekolah');

        return to_route('school-transfer-letter.show', ['schoolTransferLetter' => $schoolTransferLetter])
            ->with('swal.success', 'Surat keterangan pindah sekolah berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolTransferLetter  $schoolTransferLetter
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolTransferLetter $schoolTransferLetter)
    {
        gate('delete-school-transfer-letter');

        if ($signature = $schoolTransferLetter->letter->signature) {
            $signature->delete();
        }
        $schoolTransferLetter->delete();
        $schoolTransferLetter->letter()->delete();

        Activity::dispatch('menghapus surat keterangan pindah sekolah');

        return to_route('school-transfer-letter.index')->with('swal.success', 'Surat keterangan pindah sekolah berhasil dihapus');
    }

    public function verify(Request $request, SchoolTransferLetter $schoolTransferLetter)
    {
        gate('update-school-transfer-letter-verification');

        if ($schoolTransferLetter->letter->verified()) {
            return back()->with('swal.warning', 'Surat sudah diverifikasi');
        } elseif ($schoolTransferLetter->letter->rejected()) {
            return back()->with('swal.warning', 'Tidak dapat memverifikasi surat yang telah ditolak');
        }

        $data = $request->validate([
            'note' => ['nullable', 'string', 'max:1000', 'min:5'],
        ]);

        $schoolTransferLetter->letter->verify($data['note'], [
            "Jenis" => "Surat Keterangan Pindah Sekolah",
            "Nama Siswa" => $schoolTransferLetter->student->name,
            "Alasan Pindah" => $schoolTransferLetter->reason,
        ]);

        LetterVerified::dispatch(SchoolTransferLetter::class, $schoolTransferLetter);

        Activity::dispatch('memverifikasi surat keterangan pindah sekolah');

        return to_route('school-transfer-letter.show', ['schoolTransferLetter' => $schoolTransferLetter])
            ->with('swal.success', 'Surat berhasil diverifikasi');
    }

    public function reject(Request $request, SchoolTransferLetter $schoolTransferLetter)
    {
        gate('update-school-transfer-letter-verification');

        if ($schoolTransferLetter->letter->rejected()) {
            return back()->with('swal.warning', 'Surat sudah ditolak');
        } elseif ($schoolTransferLetter->letter->verified()) {
            return back()->with('swal.warning', 'Tidak dapat menolak surat yang telah diverifikasi');
        }

        $data = $request->validate([
            'note' => ['nullable', 'string', 'max:1000', 'min:5'],
        ]);

        $schoolTransferLetter->letter->reject($data['note']);

        LetterRejected::dispatch(SchoolTransferLetter::class, $schoolTransferLetter);

        Activity::dispatch('menolak surat keterangan pindah sekolah');

        return to_route('school-transfer-letter.show', ['schoolTransferLetter' => $schoolTransferLetter])
            ->with('swal.success', 'Surat telah ditolak');
    }

    public function print(SchoolTransferLetter $schoolTransferLetter)
    {
        gate('read-school-transfer-letter');

        if (!$schoolTransferLetter->letter->verified()) {
            return back()->with('swal.warning', 'Tidak dapat mencetak surat yang tidak terverifikasi');
        }

        config(['page.title' => 'Surat Keterangan Pindah Sekolah - ' . $schoolTransferLetter->student->name]);

        $signature = $schoolTransferLetter->letter->signature;
        $decoded = json_decode($signature->payload, true);
        $url = url(route('signature.check', ['signature' => $signature]));

        return view('school-transfer-letter.print', [
            'schoolTransferLetter' => $schoolTransferLetter,
            'decoded' => $decoded,
            'url' => $url,
        ]);
    }
}
