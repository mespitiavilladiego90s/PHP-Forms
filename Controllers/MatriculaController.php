<?php
require_once './Models/MatriculaModel.php';

class MatriculaController
{
    public static function crear(Router $router)
    {
        $matricula = new MatriculaModel;
        $alertas = [];
        $message = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $matricula->sincronizar($_POST);
                $alertas = $matricula->validarNuevaCuenta();
                if (empty($alertas['error'])) {
                    $resultado = $matricula->guardar();
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

    public static function obtenerMatriculas()
    {
        $matricula = new MatriculaModel;
        $matriculasArray = [];

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            try {
                $matriculasArray = MatriculaModel::obtenerTodasMatriculas();
            } catch (\Throwable $th) {
                $matricula::setAlerta('error', $th->getMessage());
            }
        }

        echo json_encode($matriculasArray);
    }

    public static function actualizarMatricula()
    {
        header('Content-Type: application/json'); 

        $alertas = [];
        $matricula = new MatriculaModel;
        $datos = json_decode(file_get_contents("php://input"), true);

        try {
            if (empty($datos)) {
                echo json_encode(['error' => 'No se recibieron datos para actualizar']);
                return;
            }

            $encontrado = MatriculaModel::find($datos['id']);

            if ($encontrado) {
                $matricula->sincronizar($datos);
                $alertas = $matricula->validarNuevaCuenta();

                if (!empty($alertas['error'])) {
                    echo json_encode(['error' => $alertas['error']]);
                    return;
                }
                $matricula->guardar();
                echo json_encode(['success' => 'Matricula actualizada exitosamente!']);
            } else {
                echo json_encode(['error' => 'No se encontró la matricula con el ID proporcionado']);
            }
        } catch (\Throwable $th) {
            echo json_encode(['error' => $th->getMessage()]);
        }
    }
}
