<?php
require_once './includes/router.php';
require_once './includes/db.php'; 
require_once './includes/ActiveRecord.php'; 
require_once './includes/funciones.php';

ActiveRecord::setDB(Database::getConnection());

$router = new Router();

// Formulario para estudiante
$router->get('/', 'EstudianteController@crear'); 
$router->post('/crear-estudiante', 'EstudianteController@crear');
$router->get('/obtenerestudiantes', 'EstudianteController@obtenerEstudiantes');
$router->put('/actualizarestudiante', 'EstudianteController@actualizarEstudiante');

// Formulario para materia
$router->get('/', 'MateriaController@crear'); 
$router->post('/crear-materia', 'MateriaController@crear');
$router->get('/obtenermaterias', 'MateriaController@obtenerMaterias');
$router->put('/actualizarmateria', 'MateriaController@actualizarMateria');

// Formulario para matriculas
$router->get('/', 'MatriculaController@crear'); 
$router->post('/crear-matricula', 'MatriculaController@crear');
$router->get('/obtenermatriculas', 'MatriculaController@obtenerMatriculas');
$router->put('/actualizarmatricula', 'MatriculaController@actualizarMatricula');

$router->comprobarRutas();
