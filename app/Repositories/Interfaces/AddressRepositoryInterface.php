<?php


namespace App\Repositories\Interfaces;


interface AddressRepositoryInterface
{
    public function create($street,$house,$country,$region,$city);
    public function getOne($id);
    public function getAll();
}
