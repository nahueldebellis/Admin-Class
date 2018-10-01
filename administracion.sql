CREATE DATABASE administracion;
USE administracion;
CREATE TABLE alumnos(
  id INT AUTO_INCREMENT,
  presencia BOOLEAN,
  nombre VARCHAR(25),
  apellido VARCHAR(25),
  id_curso INT NOT NULL,
  id_grupo INT,
  PRIMARY KEY (id),
  FOREIGN KEY (id_grupo) REFERENCES grupos(id),
  FOREIGN KEY (id_curso) REFERENCES curso(id)
);

CREATE TABLE notas(
  id INT AUTO_INCREMENT,
  nota INT NOT NULL,
  id_alumno INT,
  PRIMARY KEY (id),
  FOREIGN KEY (id_alumno) REFERENCES alumno(id)
);

CREATE TABLE grupos(
  id INT AUTO_INCREMENT,
  nombre VARCHAR(25),
  PRIMARY KEY (id)
);

CREATE TABLE curso(
  id INT AUTO_INCREMENT,
  nombre VARCHAR(25),
  PRIMARY KEY (id)
);

CREATE TABLE contenido(id INT NOT NULL AUTO_INCREMENT, nombre VARCHAR(100), id_curso INT, PRIMARY KEY(id), FOREIGN KEY(id_curso) REFERENCES curso(id));
