<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Image;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

   
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'birth' => ['required', 'string'],
            'telephone' => ['required', 'string', 'min:8'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    
    protected function create(array $data)
    {
        //envio de correo de registro correcto
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 0;                           // 2: debug, 0: sin mensajes de error
            $mail->isSMTP();                                      // usamos SMTP
            $mail->Host = getenv('MAIL_HOST');  // servidor de correo SMTP, de gmail por ejemplo
            $mail->SMTPAuth = true;                               // Habilitamos autenticación SMTP
            $mail->Username = getenv('MAIL_USERNAME');                 // SMTP cuenta
            $mail->Password = getenv('MAIL_PASSWORD');                           // SMTP clave
            $mail->SMTPSecure = getenv('MAIL_ENCRYPTION');                           // Habilitamos encriptación TLS/SSL
            $mail->Port = getenv('MAIL_PORT');                                     // el puerto TCP ( puedes verlo en tu servidor de correo)

            //Recipients
            $mail->addAddress( getenv('MAIL_USERNAME') , getenv('APP_NAME'));     // Add a recipient

            //Content
            $mail->isHTML(true);                                  // El mensaje es en HTML
            $mail->Subject = 'Se ha registrado correctamente en la Aplicacion de Mantenimiento';
            $mail->Body    = '<h1>Bienvenido/a.</h1>
                                <p>El registro se ha realizado correctamente.</p>
                                <p>Sus datos de acceso son: '.$data['email'].' y la contraseña es: '.$data['password'].'</p>
                                <p></p>
                                <p>Que tenga buen dia! Saludos.</p>';
            $mail->AltBody = 'Bienvenido/a.
                            El registro se ha realizado correctamente.
                            Sus datos de acceso son: '.$data['email'].' y la contraseña es: '.$data['password'].'
                            Que tenga buen dia! Saludos.';

            $mail->send();
        

        //Creacion de usuario fecha de nacimiento
        $partes = explode('/', $data['birth']);

        //rol
        $role = Role::where('name','Usuario')->first();
        

        $user = User::create([
            'urlavatar' =>  'default.png',
            'name' => $data['name'],
            'address' => $data['address'],
            'birth' =>  $partes[2]."-".$partes[1]."-".$partes[0],
            'telephone' => $data['telephone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        //Después de crear el usuario se crea su rol por defecto, que en este ejemplo es 'user'
        $user->roles()->attach($role);   
        return $user;  

            } catch (Exception $e) {

            }
    }
}
