USE bdmijostore;
DELIMITER $$

CREATE TRIGGER actualizar_descuento_producto
AFTER INSERT ON promocion
FOR EACH ROW
BEGIN
    -- Actualizamos el campo descuento en la tabla producto con el porcentaje de descuento de la promoción
    UPDATE producto
    SET descuento = NEW.descuento_porcentaje
    WHERE id = NEW.producto_id;
END$$

DELIMITER ;