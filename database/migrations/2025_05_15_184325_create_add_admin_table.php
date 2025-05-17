<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        $admin = [
            'name' => 'NC-Admin',
            'email' => 'ncadmin@nationalcare.com',
            'password' => Hash::make('NCadmin12345678'),
        ];

        User::create($admin);
    }

    public function down(): void
    {
        User::where('email', 'ncadmin@nationalcare.com')->delete();
    }
};
