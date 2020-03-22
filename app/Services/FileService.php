<?php


namespace App\Services;


use App\Services\Interfaces\FileServiceInterface;
use Image;

class FileService implements FileServiceInterface
{



    private $carPhotoPath;
    private $carFullPhotoPath;
    private $customerPhotoPath;


    public function __construct()
    {

        $this->carPhotoPath = public_path(DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'cars'.DIRECTORY_SEPARATOR);
        $this->carFullPhotoPath = public_path(DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'fullPhotoCars'.DIRECTORY_SEPARATOR);
        $this->customerPhotoPath = public_path(DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'fullCustomerPhoto'.DIRECTORY_SEPARATOR);
    }

    public function makeCarPhoto($file)
    {
        $this->makeDirForCarPhoto();



        $filename = time() . '-' . str_random(4) . '.jpg';

        //fit - поместиться
        Image::make($file)->fit(350, 202, function ($constraint) {
            $constraint->upsize();
        })->save($this->carPhotoPath . $filename);

        Image::make($file)->fit(1200, 720, function ($constraint) {
            $constraint->upsize();
        })->save($this->carFullPhotoPath . $filename);

        return $filename;

    }

    private function makeDirForCarPhoto()
    {
        if (!is_dir($this->carPhotoPath)) {
            mkdir($this->carPhotoPath, 0777);
        }
        if (!is_dir($this->carFullPhotoPath)) {
            mkdir($this->carFullPhotoPath, 0777);
        }
    }

    private function makeDirForCustomerOffersFiles()
    {
        if (!is_dir($this->customerPhotoPath)) {
            mkdir($this->customerPhotoPath, 0777);
        }
    }





}
