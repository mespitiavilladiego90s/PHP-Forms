<?php
require_once './includes/ActiveRecord.php';
require_once './Models/MateriaModel.php';
class MatriculaModel extends ActiveRecord
{

    protected static $tabla = 'matriculas';
    protected static $columnasDB = ['id', 'cedula', 'id_materia', 'periodo_academico'];

    public $id;
    public $cedula;
    public $id_materia;
    public $periodo_academico;

    public static $alertas = [
        'error' => [],
        'success' => []
    ];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->cedula = $args['cedula'] ?? '';
        $this->id_materia = $args['id_materia'] ?? '';
        $this->periodo_academico = $args['periodo_academico'] ?? '';
    }

    public function validarNuevaCuenta()
    {
        self::$alertas = ['error' => [], 'success' => []]; 

        if (empty($this->cedula)) {
            self::$alertas['error'][] = 'La cédula es obligatoria';
        }

        if (!is_numeric($this->id_materia) || $this->id_materia <= 0 || !MateriaModel::find($this->id_materia)) {
            self::$alertas['error'][] = 'El ID de la materia es obligatorio, debe ser un número positivo y debe existir en la base de datos';
        }

        if (!is_numeric($this->periodo_academico) || $this->periodo_academico <= 0) {
            self::$alertas['error'][] = 'El periodo académico es obligatorio y debe ser un número positivo';
        }

        return self::$alertas;
    }

    public static function obtenerTodasMatriculas() {
        $matriculas = self::all();
        return array_map(function ($matriculas) {
            return [
                'id' => $matriculas->id,
                'cedula' => $matriculas->cedula,
                'id_materia' => $matriculas->id_materia,
                'periodo_academico' => $matriculas->periodo_academico
            ];
        }, $matriculas);
    }
}
