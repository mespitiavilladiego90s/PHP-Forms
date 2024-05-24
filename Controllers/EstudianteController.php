<?php
require_once './Models/EstudianteModel.php';

class EstudianteController
{
    public static function crear(Router $router)
    {
        $estudiante = new EstudianteModel;
        $alertas = [];
        $message = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $estudiante->sincronizar($_POST);
                $alertas = $estudiante->validarNuevaCuenta();
                if (empty($alertas['error'])) {
                    $resultado = $estudiante->guardar();
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

    public static function obtenerEstudiantes()
    {
        $estudiante = new EstudianteModel;
        $estudiantesArray = [];

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            try {
                $estudiantesArray = EstudianteModel::obtenerTodosEstudiantes();
            } catch (\Throwable $th) {
                $estudiante::setAlerta('error', $th->getMessage());
            }
        }

        echo json_encode($estudiantesArray);
    }

    public static function actualizarEstudiante()
    {
        header('Content-Type: application/json'); 

        $alertas = [];
        $estudiante = new EstudianteModel;
        $datos = json_decode(file_get_contents("php://input"), true);

        try {
            if (empty($datos)) {
                echo json_encode(['error' => 'No se recibieron datos para actualizar']);
                return;
            }

            $encontrado = EstudianteModel::find($datos['id']);

            if ($encontrado) {
                $estudiante->sincronizar($datos);
                $alertas = $estudiante->validarNuevaCuenta();

                if (!empty($alertas['error'])) {
                    echo json_encode(['error' => $alertas['error']]);
                    return;
                }
                $estudiante->guardar();
                echo json_encode(['success' => 'Estudiante actualizado exitosamente!']);
            } else {
                echo json_encode(['error' => 'No se encontró el estudiante con el ID proporcionado']);
            }
        } catch (\Throwable $th) {
            echo json_encode(['error' => $th->getMessage()]);
        }
    }
}
