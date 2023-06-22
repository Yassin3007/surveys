<?php

namespace App\Imports;

use App\Models\Attachment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class AttachsImport implements ToModel, WithChunkReading, ShouldQueue
{
    use Queueable ;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
    public function model(array $row )
    {
        if (!empty(array_filter($row))) {
            $data = new Attachment([
                'event_id'=>$this->id,
                'circle' => $row[0],
                'name' => $row[7]." ".$row[8]." ".$row[9]." ".$row[10],
                'gender' => $row[2],
                'registration_letter' => $row[3],
                'registration_number' => $row[4],
                'registration_date' => $row[5],
                'nationality_number' => $row[6],
                'first' => $row[7],
                'second' => $row[8],
                'third' => $row[9],
                'forth' => $row[10],
                'family' => $row[11],
                'birth_date' => $row[12],
                'job' => $row[13],
                'region' => $row[14],
                'registration_status' => $row[15],
                'civil_no' => $row[16],
                'box' => $row[17],
            ]);
        }



        return $data ;

    }
    public function batchSize(): int
    {
        return 400; // تعيين حجم الدفعة المستوردة
    }

    public function chunkSize(): int
    {
        return 400; // تعيين حجم الفتشانك (Chunk) المستخدم
    }
}
