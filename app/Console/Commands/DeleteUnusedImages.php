<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

// php artisan images:delete-unused

class DeleteUnusedImages extends Command
{
    protected $signature = 'images:delete-unused';
    protected $description = 'Delete unused images in the public/images folder';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $allImages = Storage::disk('public')->files('images');
        $usedImages = Product::pluck('image')->toArray();

        foreach ($allImages as $imagePath) {
            $imageName = basename($imagePath);
            if (!in_array('images/' . $imageName, $usedImages)) {
                Storage::disk('public')->delete('images/' . $imageName);
                $this->info("Deleted unused image: $imageName");
            }
        }
        $this->info("Trying to delete: images/" . $imageName);
        $this->info('Unused images deleted successfully.');
        return Command::SUCCESS;
    }
}
