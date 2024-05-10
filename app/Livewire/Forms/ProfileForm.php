<?php

namespace App\Livewire\Forms;

use App\Models\Employee;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProfileForm extends Form
{
    #[Validate('required')]
    public $phone;
    #[Validate('required')]
    public $birthday;
    #[Validate('required')]
    public $origines;
    #[Validate('required')]
    public $pistolSN;
    #[Validate('required')]
    public $shotgunSN;
    #[Validate('required')]
    public $torchSN;
    #[Validate('required')]
    public $batonSN;
    #[Validate('required')]
    public $tazerSN;

    public function setProfile(Employee $employee)
    {
        $this->phone = $employee->phone;
        $this->birthday = $employee->birthday ? $employee->birthday->format('Y-m-d') : date('Y-m-d');
        $this->origines = $employee->origines;
        $this->pistolSN = $employee->pistol_sn;
        $this->shotgunSN = $employee->shotgun_sn;
        $this->torchSN = $employee->torch_sn;
        $this->batonSN = $employee->baton_sn;
        $this->tazerSN = $employee->tazer_sn;
    }
    public function save($id)
    {
        Employee::updateOrCreate([
            'user_id' => $id
        ], [
           'phone' => $this->phone,
           'birthday' => $this->birthday,
           'origines' => $this->origines,
           'pistol_sn' => $this->pistolSN,
           'shotgun_sn' => $this->shotgunSN,
           'torch_sn' => $this->torchSN,
           'baton_sn' => $this->batonSN,
           'tazer_sn' => $this->tazerSN,
        ]);
    }
}
