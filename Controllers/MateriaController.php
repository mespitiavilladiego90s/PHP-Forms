<?php
require_once './Models/MateriaModel.php';

class MateriaController
{
    public static function crear(Router $router)
    {
        $materia = new MateriaModel;
        $alertas = [];
        $message = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $materia->sincronizar($_POST);
                $alertas = $materia->validarNuevaCuenta();
                if (empty($alertas['error'])) {
                    $resultado = $materia->guardar();
                    if ($resultado) {
                        $message = 'Successfully added into your database!';
                    } else {
                        $alertas['error'][] = 'Error occurred while saving.';
                    }
                }
            } catch (\Throwable $th) {
                $alertas['error'][] = $th->getMessage();
            }
        }



        $router->render('/forms/forms', [
            'alertas' => $alertas,
            'message' => $message
        ]);
    }

    public static function obtenerMaterias()
    {
        $materia = new MateriaModel;
        $materiasArray = [];

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            try {
                $materiasArray = MateriaModel::obtenerTodasMaterias();
            } catch (\Throwable $th) {
                $materia::setAlerta('error', $th->getMessage());
            }
        }

        echo json_encode($materiasArray);
    }

    public static function actualizarMateria()
    {
        header('Content-Type: application/json'); 

        $alertas = [];
        $materia = new MateriaModel;
        $datos = json_decode(file_get_contents("php://input"), true);

        try {
            if (empty($datos)) {
                echo json_encode(['error' => 'No se recibieron datos para actualizar']);
                return;
            }

            $encontrado = MateriaModel::find($datos['id']);

            if ($encontrado) {
                $materia->sincronizar($datos);
                $alertas = $materia->validarNuevaCuenta();

                if (!empty($alertas['error'])) {
                    echo json_encode(['error' => $alertas['error']]);
                    return;
                }
                $materia->guardar();
                echo json_encode(['success' => 'Materia actualizada exitosamente!']);
            } else {
                echo json_encode(['error' => 'No se encontró la materia con el ID proporcionado']);
            }
        } catch (\Throwable $th) {
            echo json_encode(['error' => $th->getMessage()]);
        }
    }
}
