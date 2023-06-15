<?php

namespace App\ModuleA;


class ModuleARepository
{
    public function create($data)
    {
        $moduleA = new ModuleA($data,true);
        $moduleA->owner_id = \Auth::id() ?? null;
        $moduleA->save();

        return $moduleA;
    }

    public function fetchModuleAByOwner($ownerId)
    {
        return ModuleA::where('owner_id', $ownerId);
    }
}