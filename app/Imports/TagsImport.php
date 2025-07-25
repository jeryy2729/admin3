<?php

namespace App\Imports;

use App\Models\Tag;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TagsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Trim the tag name
        $name = trim($row['name']);

        // Only insert if tag doesn't already exist
        if (!Tag::where('name', $name)->exists()) {
            return new Tag([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $row['description'] ?? null,
                'status' => $row['status'] ?? 1,
            ]);
        }

        // Else return null (no insert)
        return null;
    }
}
