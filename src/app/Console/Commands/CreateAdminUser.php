<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user account';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $adminUser = User::where('is_admin', true)->first();

        if ($adminUser) {
            echo "Admin user already exists.\n";
            return;
        }

        $email = 'admin@example.com';
        $password = 'admin';

        $adminUser = User::create([
            'name' => 'Admin',
            'email' => $email,
            'password' => Hash::make($password),
            'role' => User::ROLE_TEACHER,
            'is_admin' => true,
        ]);

        echo "Admin user created.\nEmail: $email\nPassword: $password\nChange the password as soon as possible!\n";
    }
}
