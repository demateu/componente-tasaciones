# componente-tasaciones
Componente de tasación de viviendas dentro del CRM utilizando Laravel Nova.


## Versiones
- php 8.1
- Laravel 10
- Laravel Nova 4


## Arquitectura
User:
- para los roles 'gestor' y 'cliente'. Usé el campo 'tipo' para diferenciarlos, aunque se podría haber usado Spatie (roles y permisos) para una mayor escalabilidad (aunque esto depende de la complejidad).

Tasación:
- Se relaciona con User de tipo 'gestor'.
- Se relaciona con User de tipo 'cliente'.
- Se relaciona con Vivienda.

Vivienda:
- Decido crear Entidad para mejorar la escalabilidad. Así una misma vivienda podrá tener varias tasaciones.

<hr>

# apuntes sobre mejora

Entidad Tasación:
- El campo comentarios debería ser estructurado de otra forma más escalable: Tasación-Comentario debería ser una relacion 1 a Muchos. Comentario tendría el campo tasacion_id (FK de Tasación), y además tendría los timestamps para saber fechas de creación. Podría tener también el campo user_id de tipo gestor, para saber quien escribió el comentario (suponiendo que una tasación la podrían gestionar varios gestores/agentes/trabajadores).

- Lo más correcto también seria ver con más detalle si los datos de Cliente y Gestor van a ser distintos y en ese caso separar Entidades, pero como en la prueba los datos son exactamente iguales: nombre + email, en ese caso implemento solo un sistema de roles (cliente-gestor) para diferenciarlos.