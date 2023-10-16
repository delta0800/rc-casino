<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class DOService
{
    private $disk;
    private $folder;
    
    public function __construct()
    {
        $this->disk = Storage::disk('do');
        $this->folder = config('filesystems.disks.do.folder');
    }

    public function storeFile($filename, $contents)
    {
        return $this->disk->putFileAs($this->folder, $filename, $contents, 'public');
    }

    public function retrieveFile($filename)
    {
        return $this->disk->url($this->folder.'/'.$filename);
    }

    public function fileExists($filename)
    {
        return $this->disk->exists($filename);
    }

    public function deleteFile($filename)
    {
        return $this->disk->delete($filename);
    }

    public function generateTemporaryUrl($filename, $duration)
    {
        return $this->disk->temporaryUrl($filename, now()->addMinutes($duration));
    }
}