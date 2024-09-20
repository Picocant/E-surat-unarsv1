<?php

namespace App\Http\Controllers;

use App\Events\Activity;
use App\Events\LetterCreated;
use App\Events\LetterRejected;
use App\Events\LetterVerified;
use App\Models\Letter;
use App\Models\PindahProdi;
use App\Models\Student;
use Illuminate\Http\Request;

class PindahProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        gate('read-pindah-prodi');

        $pindahProdi = PindahProdi::orderBy('created_at', 'DESC')->get();

        return view('pindah-prodi.index', [
            'pindahprodi' => $pindahProdi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        gate('create-pindah-prodi');

        $students = Student::all();

        return view('pindah-prodi.create', [
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
        gate('create-pindah-prodi');

        $data = $request->validate([
            'student_id' => ['required', 'uuid'],
            'new_prodi' => ['required', 'max:120'],
            'reason' => ['required'],
        ]);

        $pindahProdi = PindahProdi::create([
            'student_id' => $data['student_id'],
            'new_prodi' => $data['new_prodi'],
            'reason' => $data['reason'],
        ]);

        $pindahProdi->letter()->save(new Letter([
            'note' => 'Surat telah dibuat dan menunggu untuk diverifikasi'
        ]));

        LetterCreated::dispatch(PindahProdi::class, $pindahProdi);

        Activity::dispatch('membuat surat keterangan pindah sekolah');

        return to_route('pindah-prodi.index')->with('swal.success', 'Surat berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PindahProdi  $prodiTransferLetter
     * @return \Illuminate\Http\Response
     */
    public function show(PindahProdi $pindahProdi)
    {
        gate('read-pindah-prodi');

        return view('pindah-prodi.show', [
            'pindahprodi' => $pindahProdi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PindahProdi  $prodiTransferLetter
     * @return \Illuminate\Http\Response
     */
    public function edit(PindahProdi $pindahProdi)
    {
        gate('update-pindah-prodi');

        return view('pindah-prodi.edit', [
            'students' => Student::all(),
            'pindahprodi' => $pindahProdi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PindahProdi  $prodiTransferLetter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PindahProdi $pindahProdi)
    {
        gate('update-pindah-prodi');

        $data = $request->validate([
            'student_id' => ['required', 'uuid'],
            'new_prodi' => ['required', 'max:120'],
            'reason' => ['required'],
        ]);

        $pindahProdi->student_id = $data['student_id'];
        $pindahProdi->new_prodi = $data['new_prodi'];
        $pindahProdi->reason = $data['reason'];
        $pindahProdi->save();

        Activity::dispatch('memperbarui surat keterangan pindah sekolah');

        return to_route('pindah-prodi.show', ['pindahprodi' => $pindahProdi])
            ->with('swal.success', 'Surat keterangan pindah sekolah berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PindahProdi  $prodiTransferLetter
     * @return \Illuminate\Http\Response
     */
    public function destroy(PindahProdi $pindahProdi)
    {
        gate('delete-pindah-prodi');

        if ($signature = $pindahProdi->letter->signature) {
            $signature->delete();
        }
        $pindahProdi->delete();
        $pindahProdi->letter()->delete();

        Activity::dispatch('menghapus surat keterangan pindah sekolah');

        return to_route('pindah-prodi.index')->with('swal.success', 'Surat keterangan pindah sekolah berhasil dihapus');
    }

    public function verify(Request $request, PindahProdi $pindahProdi)
    {
        gate('update-pindah-prodi-verification');

        if ($pindahProdi->letter->verified()) {
            return back()->with('swal.warning', 'Surat sudah diverifikasi');
        } elseif ($pindahProdi->letter->rejected()) {
            return back()->with('swal.warning', 'Tidak dapat memverifikasi surat yang telah ditolak');
        }

        $data = $request->validate([
            'note' => ['nullable', 'string', 'max:1000', 'min:5'],
        ]);

        $pindahProdi->letter->verify($data['note'], [
            "Jenis" => "Surat Keterangan Pindah Prodi",
            "Nama Mahasiswa" => $pindahProdi->student->name,
            "Alasan Pindah" => $pindahProdi->reason,
        ]);

        LetterVerified::dispatch(PindahProdi::class, $pindahProdi);

        Activity::dispatch('memverifikasi surat keterangan pindah Prodi');

        return to_route('pindah-prodi.show', ['pindahprodi' => $pindahProdi])
            ->with('swal.success', 'Surat berhasil diverifikasi');
    }

    public function reject(Request $request, PindahProdi $pindahProdi)
    {
        gate('update-prodi-transfer-letter-verification');

        if ($pindahProdi->letter->rejected()) {
            return back()->with('swal.warning', 'Surat sudah ditolak');
        } elseif ($pindahProdi->letter->verified()) {
            return back()->with('swal.warning', 'Tidak dapat menolak surat yang telah diverifikasi');
        }

        $data = $request->validate([
            'note' => ['nullable', 'string', 'max:1000', 'min:5'],
        ]);

        $pindahProdi->letter->reject($data['note']);

        LetterRejected::dispatch(PindahProdi::class, $pindahProdi);

        Activity::dispatch('menolak surat keterangan pindah sekolah');

        return to_route('prodi-transfer-letter.show', ['prodiTransferLetter' => $prodiTransferLetter])
            ->with('swal.success', 'Surat telah ditolak');
    }

    public function print(PindahProdi $pindahProdi)
    {
        gate('read-prodi-transfer-letter');

        if (!$pindahProdi->letter->verified()) {
            return back()->with('swal.warning', 'Tidak dapat mencetak surat yang tidak terverifikasi');
        }

        config(['page.title' => 'Surat Keterangan Pindah Sekolah - ' . $pindahProdi->student->name]);

        $signature = $pindahProdi->letter->signature;
        $decoded = json_decode($signature->payload, true);
        $url = url(route('signature.check', ['signature' => $signature]));

        return view('prodi-transfer-letter.print', [
            'prodiTransferLetter' => $pindahProdi,
            'decoded' => $decoded,
            'url' => $url,
        ]);
    }
}
