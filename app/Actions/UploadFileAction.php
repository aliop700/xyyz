<?php

namespace App\Actions;

use App\File;
use Illuminate\Http\UploadedFile;
use App\Exceptions\UploadFileException;

class UploadFileAction 
{
    public function __invoke(UploadedFile $uploadedFile): File
    {
        
        
        $fileName = time().'_'.$uploadedFile->getClientOriginalName();
        $filePath = $uploadedFile->move(public_path('uploads'),$fileName);
        
        if(!$filePath) {
            throw new UploadFileException;
        }

        $file = new File;
        $file->name = $fileName;
        $file->path = '/uploads/'. $fileName;

        $file->save();

        return $file;
    }
}