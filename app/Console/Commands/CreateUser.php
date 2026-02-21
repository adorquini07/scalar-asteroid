<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create 
                            {name? : El nombre completo} 
                            {email? : El correo electrónico} 
                            {password? : La contraseña} 
                            {rol? : El rol (admin, registradora, visor)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea un nuevo usuario pasándole los datos directamente o de forma interactiva';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Obtener datos por argumento, o preguntar si no se pasaron
        $name = $this->argument('name') ?? $this->ask('Escribe el nombre del usuario');
        $email = $this->argument('email') ?? $this->ask('Escribe el correo electrónico');

        // Validar que el correo no exista
        if (User::where('email', $email)->exists()) {
            $this->error("El correo {$email} ya está registrado en la base de datos.");
            return self::FAILURE;
        }

        $password = $this->argument('password') ?? $this->secret('Escribe la contraseña');

        $roles_validos = ['admin', 'registradora', 'visor'];
        $rol = $this->argument('rol');

        if (!$rol || !in_array($rol, $roles_validos)) {
            $rol = $this->choice(
                'Selecciona el rol del usuario',
                $roles_validos,
                2 // Por defecto el índice 2 ('visor')
            );
        }

        // Crear el usuario
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'rol' => $rol,
        ]);

        $this->info("✅ ¡Usuario '{$user->name}' ({$user->email}) creado exitosamente con el rol de '{$user->rol}'!");

        return self::SUCCESS;
    }
}
