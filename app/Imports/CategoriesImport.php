<?php

namespace App\Imports;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoriesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $name = trim($row['name']);

        if (!Category::where('name', $name)->exists()) {
            $slug = Str::slug($name);
            $imagePath = null;

            // Download image from URL if valid
            if (!empty($row['image']) && filter_var($row['image'], FILTER_VALIDATE_URL)) {
                try {
                    $imageContents = file_get_contents($row['image']);
                    $extension = pathinfo($row['image'], PATHINFO_EXTENSION);
                    $filename = time() . '_' . Str::random(10) . '.' . $extension;
                    $storagePath = 'uploads/categories/' . $filename;
                    Storage::disk('public')->put($storagePath, $imageContents);
                    $imagePath = $storagePath;
                } catch (\Exception $e) {
                    $imagePath = null; // You can log this error if needed
                }
            }

            return new Category([
                'name' => $name,
                'slug' => $slug,
                'description' => $row['description'] ?? null,
                'status' => $row['status'] ?? 1,
                'image' => $imagePath,
            ]);
        }

        return null;
    }
}
