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

        $pindahprodis = PindahProdi::orderBy('created_at', 'DESC')->get();

        return view('pindah-prodi.index', [
            'pindahprodis' => $pindahprodis
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

        $pindahprodis = PindahProdi::create([
            'student_id' => $data['student_id'],
            'new_prodi' => $data['new_prodi'],
            'reason' => $data['reason'],
        ]);

        $pindahprodis->letter()->save(new Letter([
            'note' => 'Surat telah dibuat dan menunggu untuk diverifikasi'
        ]));

        LetterCreated::dispatch(PindahProdi::class, $pindahprodis);

        Activity::dispatch('membuat surat keterangan pindah sekolah');

        return to_route('pindah-prodi.index')->with('swal.success', 'Surat berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PindahProdi  $prodiTransferLetter
     * @return \Illuminate\Http\Response
     */
    public function show(PindahProdi $pindahprodis)
    {
        gate('read-pindah-prodi');

        return view('pindah-prodi.show', [
            'pindahprodi' => $pindahprodis
                ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PindahProdi  $prodiTransferLetter
     * @return \Illuminate\Http\Response
     */
    public function edit(PindahProdi $pindahprodis)
    {
        gate('update-pindah-prodi');

        return view('pindah-prodi.edit', [
            'students' => Student::all(),
            'pindahprodi' => $pindahprodis
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PindahProdi  $prodiTransferLetter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PindahProdi $pindahprodis)
    {
        gate('update-pindah-prodi');

        $data = $request->validate([
            'student_id' => ['required', 'uuid'],
            'new_prodi' => ['required', 'max:120'],
            'reason' => ['required'],
        ]);

        $pindahprodis->student_id = $data['student_id'];
        $pindahprodis->new_prodi = $data['new_prodi'];
        $pindahprodis->reason = $data['reason'];
        $pindahprodis->save();

        Activity::dispatch('memperbarui surat keterangan pindah sekolah');

        return to_route('pindah-prodi.show', ['pindahprodi' => $pindahprodis])
            ->with('swal.success', 'Surat keterangan pindah sekolah berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PindahProdi  $prodiTransferLetter
     * @return \Illuminate\Http\Response
     */
    public function destroy(PindahProdi $pindahprodis)
    {
        gate('delete-pindah-prodi');

        if ($signature = $pindahprodis->letter->signature) {
            $signature->delete();
        }
        $pindahprodis->delete();
        $pindahprodis->letter()->delete();

        Activity::dispatch('menghapus surat keterangan pindah prodi');

        return to_route('pindah-prodi.index')->with('swal.success', 'Surat keterangan pindah pindah berhasil dihapus');
    }

    public function verify(Request $request, PindahProdi $pindahprodis)
    {
        gate('update-pindah-prodi-verification');

        if ($pindahprodis->letter->verified()) {
            return back()->with('swal.warning', 'Surat sudah diverifikasi');
        } elseif ($pindahprodis->letter->rejected()) {
            return back()->with('swal.warning', 'Tidak dapat memverifikasi surat yang telah ditolak');
        }

        $data = $request->validate([
            'note' => ['nullable', 'string', 'max:1000', 'min:5'],
        ]);

        $pindahprodis->letter->verify($data['note'], [
            "Jenis" => "Surat Keterangan Pindah Prodi",
            "Nama Mahasiswa" => $pindahprodis->student->name,
            "Alasan Pindah" => $pindahprodis->reason,
        ]);

        LetterVerified::dispatch(PindahProdi::class, $pindahprodis);

        Activity::dispatch('memverifikasi surat keterangan pindah Prodi');

        return to_route('pindah-prodi.show', ['pindahprodi' => $pindahprodis])
            ->with('swal.success', 'Surat berhasil diverifikasi');
    }

    public function reject(Request $request, PindahProdi $pindahprodis)
    {
        gate('update-pindah-prodi-verification');

        if ($pindahprodis->letter->rejected()) {
            return back()->with('swal.warning', 'Surat sudah ditolak');
        } elseif ($pindahprodis->letter->verified()) {
            return back()->with('swal.warning', 'Tidak dapat menolak surat yang telah diverifikasi');
        }

        $data = $request->validate([
            'note' => ['nullable', 'string', 'max:1000', 'min:5'],
        ]);

        $pindahprodis->letter->reject($data['note']);

        LetterRejected::dispatch(PindahProdi::class, $pindahprodis);

        Activity::dispatch('menolak surat keterangan pindah sekolah');

        return to_route('pindah-prodi.show', ['pindahprodi' => $pindahprodis])
            ->with('swal.success', 'Surat telah ditolak');
    }

    public function print(PindahProdi $pindahprodis)
    {
        gate('read-pindah-prodi');

        if (!$pindahprodis->letter->verified()) {
            return back()->with('swal.warning', 'Tidak dapat mencetak surat yang tidak terverifikasi');
        }

        config(['page.title' => 'Surat Keterangan Pindah Prodi - ' . $pindahprodis->student->name]);

        $signature = $pindahprodis->letter->signature;
        $decoded = json_decode($signature->payload, true);
        $url = url(route('signature.check', ['signature' => $signature]));

        return view('pindah-prodi.print', [
            'pindahprodi' => $pindahprodis,
            'decoded' => $decoded,
            'url' => $url,
        ]);
    }
}
