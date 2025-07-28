<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoriesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Category::select('id', 'name', 'slug', 'description', 'status', 'image', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Slug', 'Description', 'Status', 'Image', 'Created At'];
    }
}
