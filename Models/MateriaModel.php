<?php
require_once './includes/ActiveRecord.php';

class MateriaModel extends ActiveRecord
{
    protected static $tabla = 'materias';
    protected static $columnasDB = ['id', 'name', 'credits'];
    public $id;
    public $name;
    public $credits;
    public static $alertas = [
        'error' => [],
        'success' => []
    ];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->credits = $args['credits'] ?? '';
    }

    public function validarNuevaCuenta()
    {
        self::$alertas = ['error' => [], 'success' => []]; 

        
        if (empty($this->name)) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }

        if (!is_numeric($this->credits) || $this->credits <= 0) {
            self::$alertas['error'][] = 'Los créditos son obligatorios y deben ser un número positivo';
        }

        return self::$alertas;
    }

    public static function obtenerTodasMaterias() {
        $materias = self::all();
        return array_map(function ($materias) {
            return [
                'id' => $materias->id,
                'name' => $materias->name,
                'credits' => $materias->credits
            ];
        }, $materias);
    }
    
}
