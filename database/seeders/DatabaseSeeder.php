<?php

namespace Database\Seeders;

use App\Models\LeavePermitLetter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Clear records
        DB::table('active_student_letters')->delete();
        DB::table('incoming_letter_categories')->delete();
        DB::table('incoming_letter_dispositions')->delete();
        DB::table('incoming_letters')->delete();
        DB::table('leave_permit_letters')->delete();
        DB::table('letters')->delete();
        DB::table('positions')->delete();
        DB::table('school_documents')->delete();
        DB::table('school_transfer_letters')->delete();
        DB::table('signatures')->delete();
        DB::table('sppd_letters')->delete();
        DB::table('student_certificates')->delete();
        DB::table('students')->delete();
        DB::table('users')->delete();
        DB::table('archives')->delete();

        // Clear uploaded file
        Storage::deleteDirectory('avatars');
        Storage::deleteDirectory('incoming-letters');
        Storage::deleteDirectory('school-documents');
        Storage::deleteDirectory('student-certificates');

        // Call the seeder
        $this->call([
            PositionSeeder::class,
            UserSeeder::class,
            SppdLetterSeeder::class,
            LeavePermitLetterSeeder::class,

            StudentSeeder::class,
            StudentCertificateSeeder::class,
            ActiveStudentLetterSeeder::class,
            SchoolTransferSeeder::class,

            IncomingLetterCategorySeeder::class,
            IncomingLetterSeeder::class,
            IncomingLetterDispositionSeeder::class,

            SchoolDocumentSeeder::class,
        ]);
    }
}
