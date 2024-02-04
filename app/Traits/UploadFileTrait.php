<?php

namespace App\Traits;

use Livewire\WithFileUploads;

trait UploadFileTrait
{
    use WithFileUploads;

    public $photostatus = null;

    public $namefoto = null;

    public function store_file($name_file, $routedir, $id)
    {
        return $name_file->store($routedir.$id, 'public');

    }

    public function resetImage()
    {
        $this->photostatus = null;
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function cambiarPhoto()
    {
        $this->namefoto = null;

    }

    public function reloadPhoto()
    {
        $this->photostatus = false;
    }
}
