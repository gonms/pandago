INSERT INTO `duracion_contrato` (`id`,`nombre`) VALUES ('1','12'),('2','24'),('3','36'),('4','48'),('5','60');

INSERT INTO `requerimiento` (`id`,`nombre`) VALUES ('1','Circulación autovia'),('2','Circulación sin carnet'),('3','Baúl de carga');

INSERT INTO `tipo_cliente` (`id`,`nombre`) VALUES ('1','Tipo cliente 1'),('2','Tipo cliente 2'),('3','Tipo cliente 3');

INSERT INTO `uso_vehiculo` (`id`,`nombre`) VALUES ('1','Uso vehículo 1'),('2','Uso vehículo 2'),('3','Uso vehículo 3');

INSERT INTO `vehiculo` (`id`, `nombre`, `descripcion`, `imagen`, `autonomia`, `cuota`, `tipo_cliente_id`, `uso_vehiculo_id`, `duracion_contrato_id`) VALUES ('1','Moto1', 'Desc moto1', 'https://placehold.co/600x400?text=Moto1', 90, 110, 1, 3, 1), ('2','Moto2', 'Desc moto2', 'https://placehold.co/600x400?text=Moto2', 60, 80, 1, 3, 2), ('3','Moto3', 'Desc moto3', 'https://placehold.co/600x400?text=Moto3', 120, 200, 1, 3, 3),('4','Moto4', 'Desc moto4', 'https://placehold.co/600x400?text=Moto4', 100, 220, 2, 2, 4),('5','Moto5', 'Desc moto5', 'https://placehold.co/600x400?text=Moto5', 95, 160, 2, 2, 5),('6','Moto6', 'Desc moto6', 'https://placehold.co/600x400?text=Moto6', 120, 120, 2, 2, 1),('7','Moto7', 'Desc moto7', 'https://placehold.co/600x400?text=Moto7', 60, 180, 3, 1, 2),('8','Moto8', 'Desc moto8', 'https://placehold.co/600x400?text=Moto8', 150, 250, 3, 1, 3),('9','Moto9', 'Desc moto9', 'https://placehold.co/600x400?text=Moto9', 70, 9, 3, 1, 4);

INSERT INTO `valoracion` (`valoracion`,`vehiculo_id`) VALUES (5,1),(5,1),(5,1),(3,2),(4,2),(4,3),(3,3),(2,4),(2,4),(4,4),(4,5),(3,6),(4,6),(5,7),(5,7),(4,7),(3,8),(4,8),(5,9),(3,9),(4,9);

INSERT INTO `requerimiento_vehiculo` (`vehiculo_id`,`requerimiento_id`) VALUES (1,1),(1,3),(2,2),(3,1),(4,1),(4,3),(5,2),(6,2),(6,3),(7,1),(7,3),(8,2),(9,1);