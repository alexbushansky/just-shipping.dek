<?php


namespace App\Services\Interfaces;


use App\Http\Requests\DialogRequest;

interface DialogServiceInterface
{
        public function getAllDialogs();
        public function getOffersDialogs();
        public function storeDialog(DialogRequest $request);
}
