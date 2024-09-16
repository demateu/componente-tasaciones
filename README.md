# componente-tasaciones
Componente de tasación de viviendas dentro del CRM utilizando Laravel Nova,

# diario de bitácora
Laravel Nova sale a partir de Laravel 9. En mi mac tengo la versión 8.1.26 y la versión máxima apta es Laravel 10, así que trabajaré con Laravel 10.


Aclaración sobre la decisión actual de la arquitectura de BBDD escojida.
...

# apuntes sobre mejora

Entidad Tasación:
- El campo comentarios debería ser estructurado de otra forma más escalable: Tasación-Comentario debería ser una relacion 1 a Muchos. Comentario tendría el campo tasacion_id (FK de Tasación), y además tendría los timestamps para saber fechas de creación. Podría tener también el campo user_id de tipo gestor, para saber quien escribió el comentario (suponiendo que una tasación la podrían gestionar varios gestores/agentes/trabajadores).

- Lo más correcto también seria ver con más detalle si los datos de Cliente y Gestor van a ser distintos y en ese caso separar Entidades, pero como en la prueba los datos son exactamente iguales: nombre + email, en ese caso implemento solo un sistema de roles (cliente-gestor) para diferenciarlos.