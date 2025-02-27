<?php

namespace App\Exports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\FromCollection;

class EventExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect(Event::getAllEvents());
    }

    public function headings(): array
    {
        return ['id', 'title', 'description', 'date', 'user_id', 'category_id'];
    }
}
