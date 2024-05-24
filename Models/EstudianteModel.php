<?php
require_once './includes/ActiveRecord.php';

class EstudianteModel extends ActiveRecord
{

    // Base de datos
    protected static $tabla = 'estudiantes';
    protected static $columnasDB = ['id', 'name', 'date', 'sex', 'email'];

    public $id;
    public $name;
    public $date;
    public $sex;
    public $email;

    public static $alertas = [
        'error' => [],
        'success' => []
    ];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->date = $args['date'] ?? '';
        $this->sex = $args['sex'] ?? '';
        $this->email = $args['email'] ?? '';
    }

    public function validarNuevaCuenta()
    {
        self::$alertas = ['error' => [], 'success' => []]; 
        
        if (empty($this->name) || !is_string($this->name)) {
            self::$alertas['error'][] = 'El nombre es Obligatorio';
        }
        if (empty($this->date) || !is_string($this->date)) {
            self::$alertas['error'][] = 'La fecha es Obligatoria';
        }
        if (!is_string($this->sex) || ($this->sex != "Masculino" && $this->sex != "Femenino")) {
            self::$alertas['error'][] = 'El sexo es invalido';
        }
        if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El email es invalido o está vacio';
        }
    
        return self::$alertas;
    }

    public static function obtenerTodosEstudiantes() {
        $estudiantes = self::all();
        return array_map(function ($estudiante) {
            return [
                'id' => $estudiante->id,
                'name' => $estudiante->name,
                'date' => $estudiante->date,
                'sex' => $estudiante->sex,
                'email' => $estudiante->email
            ];
        }, $estudiantes);
    }
    


}
