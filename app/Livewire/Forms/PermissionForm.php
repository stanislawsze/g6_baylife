<?php

namespace App\Livewire\Forms;

use App\Models\RolePermission;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PermissionForm extends Form
{
    public ?RolePermission $role;

    public $isConvoyManager = false;
    public $isAtmManager = false;
    public $isTeamManager = false;
    public $isSalaryManager = false;
    public $isRoleManager = false;
    public $isWebhookManager = false;
    public $salaryPatrol = 0;
    public $salaryMission = 0;
    public $salaryBonus = 0;

    public function setRole(RolePermission $role): void
    {
        $this->role = $role;
        $this->isConvoyManager = $this->role->hasConvoyPermission();
        $this->isAtmManager = $this->role->hasRolePermission();
        $this->isTeamManager = $this->role->hasTeamPermission();
        $this->isSalaryManager = $this->role->hasSalaryPermission();
        $this->isRoleManager = $this->role->hasRolePermission();
        $this->isWebhookManager = $this->role->hasWebhookPermission();
        $this->salaryPatrol = $this->role->salary->salary_patrol;
        $this->salaryMission = $this->role->salary->salary_mission;
        $this->salaryBonus = $this->role->salary->salary_bonus;
    }

    public function update()
    {
        $this->role->update([
            'convoy_manager' => $this->isConvoyManager,
            'atm_manager' => $this->isAtmManager,
            'team_manager' => $this->isTeamManager,
            'salary_manager' => $this->isSalaryManager,
            'role_manager' => $this->isRoleManager,
            'webhook_manager' => $this->isWebhookManager,
        ]);
        $this->role->salary->update([
            'salary_patrol' => $this->salaryPatrol,
            'salary_mission' => $this->salaryMission,
            'salary_bonus'=> $this->salaryBonus
        ]);
        toastify()->success('Rôle mis à jour avec succès');
        return redirect(route('roles.index'));
    }
}
