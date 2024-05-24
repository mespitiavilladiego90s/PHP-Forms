CREATE TABLE IF NOT EXISTS estudiantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(60) NOT NULL,
    date DATE NOT NULL,
    sex VARCHAR(10) NOT NULL,
    email VARCHAR(60) NOT NULL
);

CREATE TABLE IF NOT EXISTS materias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(60) NOT NULL,
    credits int NOT NULL
);

CREATE TABLE IF NOT EXISTS matriculas (
    id INT AUTO_INCREMENT,
    cedula VARCHAR(10) NOT NULL,
    id_materia int NOT NULL,
    periodo_academico int NOT NULL,
     PRIMARY KEY (id),
    FOREIGN KEY (id_materia) REFERENCES materias(id)
);

