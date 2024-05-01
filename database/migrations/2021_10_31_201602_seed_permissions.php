<?php

use Illuminate\Support\Str;
use Illuminate\Database\Migrations\Migration;

class SeedPermissions extends Migration
{
    public function createPermission($p)
    {
        $permissions = [
            "view $p list",
            "view $p details",
            "create $p",
            "update $p",
            "delete $p",
        ];

        foreach ($permissions as $permission) {
            \App\Models\Permission::create([
                'group'=>Str::plural($p),
                'name'=>$permission
            ]);
        }
    }
    public function up()
    {
        $permissions = [
            //all permission goes here
        ];



        foreach ($permissions as $p) {
            $this->createPermission($p);
        }
    }
}
