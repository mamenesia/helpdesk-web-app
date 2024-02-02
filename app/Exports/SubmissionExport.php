<?php

namespace App\Exports;

use App\Models\Submission;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class SubmissionExport implements FromCollection, WithHeadings
{
    protected $user_id;
    protected $from_date;
    protected $to_date;

    public function __construct($user_id, $from_date, $to_date)
    {
        $this->user_id = $user_id;
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    public function collection()
    {
        return DB::table('submission')
            ->join('users', 'submission.user_id', '=', 'users.id')
            ->join('users as closing_users', 'submission.closed_by', '=', 'closing_users.id')
            ->where('submission.user_id', $this->user_id)
            ->whereBetween('submission.created_at', [$this->from_date, $this->to_date])
            ->select('submission.id', 'submission.nomor_ppkb', 'submission.ppkb_ke', 'submission.service_code', 'submission.nama_kapal', 'submission.keagenan', 'submission.status', 'users.nama as user_nama', 'closing_users.nama as closed_by', 'submission.closed_at', 'submission.created_at')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nomor PPKB',
            'PPKB Ke',
            'Service Code',
            'Nama Kapal',
            'Keagenan',
            'Status',
            'Dibuat Oleh',
            'Diselesaikan Oleh',
            'Diselesaikan Pada',
            'Dibuat Pada',
        ];
    }
}
