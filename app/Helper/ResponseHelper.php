<?php

namespace App\Helper;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ResponseHelper
{
    public static function uploadImage($file, string $subdirectory = 'jobs')
    {
       
        // Validate the file is an image
        if (!str_starts_with($file->getMimeType(), 'image/')) {
            throw new \InvalidArgumentException('Uploaded file is not an image');
        }

        $ext = strtolower($file->getClientOriginalExtension());
        $imageName = Str::random(15) . '.' . $ext;
        $storagePath = public_path("storage/{$subdirectory}");
        
        // Create directory if it doesn't exist
        if (!File::exists($storagePath)) {
            File::makeDirectory($storagePath, 0755, true);
        }
        
        $fullPath = "{$storagePath}/{$imageName}";
        $publicPath = "storage/{$subdirectory}/{$imageName}";

        // Handle SVG , Intervention can't process it
        if ($ext === 'svg') {
                // Force storing SVG as raw content
            $svgContent = file_get_contents($file->getRealPath());

            if (!$svgContent) {
                throw new \Exception('Could not read SVG content from uploaded file.');
            }

            file_put_contents("{$storagePath}/{$imageName}", $svgContent);
            return $publicPath;

        } else {

            try {
                $manager = new ImageManager(new Driver());
                $image = $manager->read($file);
                $image->scaleDown(width: 800, height: 800);
                $image->save($fullPath, quality: 80);
            } catch (\Exception $e) {
                $file->move($storagePath, $imageName);
            }
        }

        return $publicPath;
    }
    
    // ResponseHelper::deleteImage('storage/jobs/filename.jpg');
    public static function deleteImage(string $path): bool
    {
        $fullPath = public_path($path);
        
        if (File::exists($fullPath)) {
            return File::delete($fullPath);
        }
        
        return false;
    }
}