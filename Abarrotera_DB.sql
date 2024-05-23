create database Abarrotera3;
use Abarrotera3;
 
CREATE TABLE Personas (
    idPersona INT NOT NULL IDENTITY,
    Nombre VARCHAR(100) NOT NULL,
    Paterno VARCHAR(50) NOT NULL,
    Materno VARCHAR(50) NOT NULL,
    Sexo VARCHAR(1) NOT NULL CHECK (Sexo IN ('M', 'F', 'NU')),
    Direccion VARCHAR(100) NOT NULL,
    Telefono VARCHAR(10),
    Curp VARCHAR(18) NOT NULL,
    RFC VARCHAR(13) UNIQUE,
    CONSTRAINT PK_idPersona PRIMARY KEY (idPersona),
    CONSTRAINT UQ_Curp UNIQUE (Curp),
    CONSTRAINT UQ_RFC UNIQUE (RFC)
);
 
CREATE TABLE Horarios (
    idHorario INT NOT NULL IDENTITY,
    Horario VARCHAR(15) NOT NULL,
    CONSTRAINT PK_idHorario PRIMARY KEY (idHorario)
);
 
CREATE TABLE Puestos (
    idPuesto INT NOT NULL IDENTITY,
    Puesto VARCHAR(30) NOT NULL,
    CONSTRAINT PK_idPuesto PRIMARY KEY (idPuesto)
);
 
CREATE TABLE Empleados (
    idEmpleado INT NOT NULL IDENTITY,
    idPersona INT NOT NULL,
    Sueldo MONEY NOT NULL CHECK (Sueldo >= 0),
    Estado bit not null,
    Pass VARCHAR (50) NOT NULL,
    idPuesto INT NOT NULL,
    idHorario INT NOT NULL,
    idSucursal int not null,
    CONSTRAINT PK_idEmpleado PRIMARY KEY (idEmpleado),
    CONSTRAINT FK_EmpleadosPersonas FOREIGN KEY (idPersona) REFERENCES Personas(idPersona),
    CONSTRAINT FK_EmpleadosHorarios FOREIGN KEY (idHorario) REFERENCES Horarios(idHorario),
    CONSTRAINT FK_EmpleadosPuestos FOREIGN KEY (idPuesto) REFERENCES Puestos(idPuesto),
    CONSTRAINT FK_EmpleadosSucursal FOREIGN KEY (idSucursal) REFERENCES Sucursal(idSucursal)
);
 
CREATE TABLE Proveedores (
    idProveedor INT NOT NULL IDENTITY,
    idPersona INT NOT NULL,
    Empresa VARCHAR(100) NOT NULL,
    Estado bit not null,
    CONSTRAINT PK_idProveedor PRIMARY KEY (idProveedor),
    CONSTRAINT FK_ProveedoresPersonas FOREIGN KEY (idPersona) REFERENCES Personas(idPersona)
);
 
CREATE TABLE Clientes (
    idCliente INT NOT NULL IDENTITY,
    idPersona INT,
    Credito MONEY CHECK (Credito >= 0 AND Credito <= 10000),
    Estado bit not null,
    CONSTRAINT PK_idCliente PRIMARY KEY (idCliente),
    CONSTRAINT FK_ClientesPersonas FOREIGN KEY (idPersona) REFERENCES Personas(idPersona)
);
 
CREATE TABLE Categorias (
    idCategoria INT NOT NULL IDENTITY,
    Categoria VARCHAR(50) NOT NULL,
    Refrigeracion BIT,
    CONSTRAINT PK_idCategoria PRIMARY KEY (idCategoria)
);
 
 
CREATE TABLE Ventas (
    idVenta INT NOT NULL IDENTITY,
    Monto MONEY NOT NULL,
    Fecha DATE NOT NULL,
    CONSTRAINT PK_idVenta PRIMARY KEY (idVenta)
);
 
CREATE TABLE Almacenes (
    idAlmacen INT NOT NULL IDENTITY,
    Almacen VARCHAR(40) NOT NULL,
    CONSTRAINT PK_idAlmacen PRIMARY KEY (idAlmacen)
);
 
CREATE TABLE Sucursales (
    idSucursal INT NOT NULL IDENTITY,
    Sucursal VARCHAR(50) NOT NULL,
    CONSTRAINT PK_idSucursal PRIMARY KEY (idSucursal)
);
 
CREATE TABLE DetalleVenta (
    idDetalleVenta INT NOT NULL IDENTITY,
    Cantidad INT NOT NULL,
    Total MONEY NOT NULL,
    Descripcion VARCHAR(50),
    idProducto INT NOT NULL,
    idAlmacen INT NOT NULL,
    idSucursal INT NOT NULL,
    idVenta INT NOT NULL,
    CONSTRAINT PK_idDetalleVenta PRIMARY KEY (idDetalleVenta),
    CONSTRAINT FK_DetalleVentaAlmacen FOREIGN KEY (idAlmacen) REFERENCES Almacenes(idAlmacen),
    CONSTRAINT FK_DetalleVentaSucursal FOREIGN KEY (idSucursal) REFERENCES Sucursales(idSucursal),
    CONSTRAINT FK_DetalleVentaVenta FOREIGN KEY (idVenta) REFERENCES Ventas(idVenta)
);
 
-- Creating necessary tables
CREATE TABLE Productos (
    idProducto INT NOT NULL IDENTITY,
    Producto VARCHAR(100) NOT NULL,
    Caducidad DATE NOT NULL,
    Lote VARCHAR(20) NOT NULL,
    Estado bit not null,
    idProveedor INT NOT NULL,
    idCategoria INT NOT NULL,
    Stock INT NOT NULL,
    PrecioVenta MONEY NOT NULL,
    PrecioCompra MONEY NOT NULL,
    CONSTRAINT PK_idProducto PRIMARY KEY (idProducto),
    CONSTRAINT FK_ProductosProveedores FOREIGN KEY (idProveedor) REFERENCES Proveedores(idProveedor),
    CONSTRAINT FK_ProductosCategorias FOREIGN KEY (idCategoria) REFERENCES Categorias(idCategoria)
);
 
CREATE TABLE Temp_Ventas (
    idProducto INT,
    Cantidad INT,
    Total MONEY,
    Descripcion VARCHAR(50),
    idAlmacen INT,
    idSucursal INT
);
 
-- Ensure the procedure is the first statement in the batch
GO
 
CREATE PROCEDURE sp_DetalleVenta
AS
BEGIN
    DECLARE @idVenta INT;
 
    -- Insertar venta en la tabla Ventas
    INSERT INTO Ventas (Monto, Fecha)
    SELECT SUM(Total), GETDATE()
    FROM Temp_Ventas;
 
    -- Obtener el ID de la venta recién insertada
    SET @idVenta = SCOPE_IDENTITY();
 
    -- Insertar detalles de la venta en la tabla DetalleVenta
    INSERT INTO DetalleVenta (idVenta, idProducto, Cantidad, Total, Descripcion, idAlmacen, idSucursal)
    SELECT @idVenta, idProducto, Cantidad, Total, Descripcion, idAlmacen, idSucursal
    FROM Temp_Ventas;
 
    -- Restar la cantidad vendida del stock en la tabla Productos
    UPDATE p
    SET Stock = Stock - tv.Cantidad
    FROM Productos p
    INNER JOIN Temp_Ventas tv ON p.idProducto = tv.idProducto;
 
    -- Limpiar tabla temporal de ventas
    DELETE FROM Temp_Ventas;
END;
 
GO
 
 
-- Corrected stored procedure for calculating total daily profit
CREATE PROCEDURE sp_GananciaTotalDia
AS
BEGIN
    SELECT SUM(p.PrecioVenta - p.PrecioCompra) AS GananciaTotal
    FROM DetalleVenta dv
    INNER JOIN Productos p ON dv.idProducto = p.idProducto
    INNER JOIN Ventas v ON dv.idVenta = v.idVenta
    WHERE v.Fecha = CONVERT(DATE, GETDATE());
END;

DROP PROCEDURE sp_EliminarClientes
CREATE PROCEDURE sp_EliminarClientes(
    @idCliente int
)
AS
BEGIN
    @existe INT
    SET @existe = SELECT idCliente FROM Clientes
    where idCliente = @idCliente
    UPDATE Clientes SET Estado=0
    WHERE idCliente=@idCliente
END


DROP PROCEDURE sp_EliminarProductos
CREATE PROCEDURE sp_EliminarProductos(
    @idProducto int
)
AS
BEGIN
    @existe INT
    SET @existe = SELECT idProducto FROM Productos
    where idProducto = @idProducto
    UPDATE Productos SET Estado=0
    WHERE idProducto=@idProducto
END

CREATE PROCEDURE AgregarEmpleado
    @idPersona INT,
    @Sueldo MONEY,
    @idPuesto INT,
    @idHorario INT,
    @Usuario VARCHAR(50),
    @Pass VARCHAR(50)
AS
BEGIN
    INSERT INTO Empleados (idPersona, Sueldo, idPuesto, idHorario, Usuario, Pass)
    VALUES (@idPersona, @Sueldo, @idPuesto, @idHorario, @Usuario, @Pass);
END

CREATE PROCEDURE ModificarEmpleado
    @idEmpleado INT,
    @idPersona INT,
    @Sueldo MONEY,
    @idPuesto INT,
    @idHorario INT,
    @Usuario VARCHAR(50),
    @Pass VARCHAR(50)
AS
BEGIN
    UPDATE Empleados
    SET idPersona = @idPersona,
        Sueldo = @Sueldo,
        idPuesto = @idPuesto,
        idHorario = @idHorario,
        Usuario = @Usuario,
        Pass = @Pass
    WHERE idEmpleado = @idEmpleado;
END

CREATE PROCEDURE EliminarEmpleado
    @idEmpleado INT
AS
BEGIN
    DELETE FROM Empleados
    WHERE idEmpleado = @idEmpleado;
END

CREATE PROCEDURE AgregarProducto
    @Producto VARCHAR(100),
    @Caducidad DATE,
    @Estado BIT,
    @Lote VARCHAR(20),
    @idProveedor INT,
    @idCategoria INT,
    @Stock INT,
    @PrecioVenta MONEY,
    @PrecioCompra MONEY
AS
BEGIN
    INSERT INTO Productos (Producto, Caducidad, Estado, Lote, idProveedor, idCategoria, Stock, PrecioVenta, PrecioCompra)
    VALUES (@Producto, @Caducidad, @Estado, @Lote, @idProveedor, @idCategoria, @Stock, @PrecioVenta, @PrecioCompra);
END

CREATE PROCEDURE ModificarProducto
    @idProducto INT,
    @Producto VARCHAR(100),
    @Caducidad DATE,
    @Estado BIT,
    @Lote VARCHAR(20),
    @idProveedor INT,
    @idCategoria INT,
    @Stock INT,
    @PrecioVenta MONEY,
    @PrecioCompra MONEY
AS
BEGIN
    UPDATE Productos
    SET Producto = @Producto,
        Caducidad = @Caducidad,
        Estado = @Estado,
        Lote = @Lote,
        idProveedor = @idProveedor,
        idCategoria = @idCategoria,
        Stock = @Stock,
        PrecioVenta = @PrecioVenta,
        PrecioCompra = @PrecioCompra
    WHERE idProducto = @idProducto;
END

CREATE PROCEDURE AgregarProveedor
    @idPersona INT,
    @Empresa VARCHAR(100),
    @Estado BIT
AS
BEGIN
    INSERT INTO Proveedores (idPersona, Empresa, Estado)
    VALUES (@idPersona, @Empresa, @Estado);
END

CREATE PROCEDURE ModificarProveedor
    @idProveedor INT,
    @idPersona INT,
    @Empresa VARCHAR(100),
    @Estado BIT
AS
BEGIN
    UPDATE Proveedores
    SET idPersona = @idPersona,
        Empresa = @Empresa,
        Estado = @Estado
    WHERE idProveedor = @idProveedor;
END

CREATE PROCEDURE EliminarProveedor
    @idProveedor INT
AS
BEGIN
    DELETE FROM Proveedores
    WHERE idProveedor = @idProveedor;
END