<?php
namespace App\Traits;
require __DIR__.'/../../vendor/autoload.php';
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

trait SaveFileTrait
{

function savefile($photo, $folder, $name = null) {
    // Ensure the file has an extension
    $file_extension = $photo->getClientOriginalExtension();

    // If the extension is empty, use a default extension (e.g., 'txt')
    if (empty($file_extension)) {
        $file_extension = 'txt'; // Change this to the default extension you want
    }

    $fileNameWithExtension = $photo->getClientOriginalName();
    $fileName = $name ? $name : pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
    $path = $folder;

    $counter = 1;
    
    // Check if a file with the same name and extension already exists
    if (!$name):
        while (file_exists($path . '/' . $fileName . '.' . $file_extension)) {
            $fileName = $fileName . '_' . $counter;
            $counter++;
        }
    endif;

    // Append the correct file extension
    $fileName = $fileName . '.' . $file_extension;

    // Move the file to the destination folder
    $photo->move($path, $fileName);

    // Return the final file name (with extension)
    return $fileName;
}
}
