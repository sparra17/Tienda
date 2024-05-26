create database Abarrotera3
go
use Abarrotera3
go
 
CREATE TABLE Personas (
    idPersona INT NOT NULL IDENTITY,
    Nombre VARCHAR(100) NOT NULL,
    Paterno VARCHAR(50) NOT NULL,
    Materno VARCHAR(50) NOT NULL,
    Sexo VARCHAR(2) NOT NULL CHECK (Sexo IN ('M', 'F', 'NU')),
    Direccion VARCHAR(100) NOT NULL,
    Telefono VARCHAR(10),
    Curp VARCHAR(18) NOT NULL,
    RFC VARCHAR(13) UNIQUE,
    CONSTRAINT PK_idPersona PRIMARY KEY (idPersona),
    CONSTRAINT UQ_Curp UNIQUE (Curp),
    CONSTRAINT UQ_RFC UNIQUE (RFC)
)
go
 
CREATE TABLE Horarios (
    idHorario INT NOT NULL IDENTITY,
    Horario VARCHAR(15) NOT NULL,
    CONSTRAINT PK_idHorario PRIMARY KEY (idHorario)
)
go
 
CREATE TABLE Puestos (
    idPuesto INT NOT NULL IDENTITY,
    Puesto VARCHAR(30) NOT NULL,
    CONSTRAINT PK_idPuesto PRIMARY KEY (idPuesto)
)
go
 
CREATE TABLE Empleados (
    idEmpleado INT NOT NULL IDENTITY,
    idPersona INT NOT NULL,
    Sueldo MONEY NOT NULL CHECK (Sueldo >= 0),
    idPuesto INT NOT NULL,
    idHorario INT NOT NULL,
	Usuario varchar(50),
	Pass varchar(50),
    CONSTRAINT PK_idEmpleado PRIMARY KEY (idEmpleado),
    CONSTRAINT FK_EmpleadosPersonas FOREIGN KEY (idPersona) REFERENCES Personas(idPersona),
    CONSTRAINT FK_EmpleadosHorarios FOREIGN KEY (idHorario) REFERENCES Horarios(idHorario),
    CONSTRAINT FK_EmpleadosPuestos FOREIGN KEY (idPuesto) REFERENCES Puestos(idPuesto)
)
go
 
CREATE TABLE Proveedores (
    idProveedor INT NOT NULL IDENTITY,
    idPersona INT NOT NULL,
    Empresa VARCHAR(100) NOT NULL,
	Estado bit,
    CONSTRAINT PK_idProveedor PRIMARY KEY (idProveedor),
    CONSTRAINT FK_ProveedoresPersonas FOREIGN KEY (idPersona) REFERENCES Personas(idPersona)
)
go

 
CREATE TABLE Clientes (
    idCliente INT NOT NULL IDENTITY,
    idPersona INT,
    Credito MONEY CHECK (Credito >= 0 AND Credito <= 10000),
	Estado bit,
    CONSTRAINT PK_idCliente PRIMARY KEY (idCliente),
    CONSTRAINT FK_ClientesPersonas FOREIGN KEY (idPersona) REFERENCES Personas(idPersona)
)
go

 
CREATE TABLE Categorias (
    idCategoria INT NOT NULL IDENTITY,
    Categoria VARCHAR(50) NOT NULL,
    Refrigeracion BIT,
	Estado bit,
    CONSTRAINT PK_idCategoria PRIMARY KEY (idCategoria)
)
go

 
CREATE TABLE Ventas (
    idVenta INT NOT NULL IDENTITY,
    Monto MONEY,
    Fecha DATE,
    CONSTRAINT PK_idVenta PRIMARY KEY (idVenta)
)
go
 
CREATE TABLE Almacenes (
    idAlmacen INT NOT NULL IDENTITY,
    Almacen VARCHAR(40) NOT NULL,
    CONSTRAINT PK_idAlmacen PRIMARY KEY (idAlmacen)
)
go
 
CREATE TABLE Sucursales (
    idSucursal INT NOT NULL IDENTITY,
    Sucursal VARCHAR(50) NOT NULL,
	Estado int not null
    CONSTRAINT PK_idSucursal PRIMARY KEY (idSucursal)
)
go
 
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
)
go
 
CREATE TABLE Productos (
    idProducto INT NOT NULL IDENTITY,
    Producto VARCHAR(100) NOT NULL,
    Caducidad DATE NOT NULL,
    Lote VARCHAR(20) NOT NULL,
    idProveedor INT NOT NULL,
    idCategoria INT NOT NULL,
    Stock INT NOT NULL,
    PrecioVenta MONEY NOT NULL,
    PrecioCompra MONEY NOT NULL,
	Estado bit,
    CONSTRAINT PK_idProducto PRIMARY KEY (idProducto),
    CONSTRAINT FK_ProductosProveedores FOREIGN KEY (idProveedor) REFERENCES Proveedores(idProveedor),
    CONSTRAINT FK_ProductosCategorias FOREIGN KEY (idCategoria) REFERENCES Categorias(idCategoria)
)
go
 
CREATE TABLE Temp_Ventas (
    idProducto INT,
    Cantidad INT,
    Total MONEY,
    Descripcion VARCHAR(50),
    idAlmacen INT,
    idSucursal INT
)
go
 
 -----Creada 24/05
 -----Guarda los productos temporales de la venta
 create table TempVentas(
	idTempVenta int not null primary key identity,
	idVenta int,
	idProducto int,
	PrecioVenta MONEY,
	Cantidad float,
	Total numeric (18,2),
	Estado int 
 )
 go



-- Ensure the procedure is the first statement in the batch
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
END
go


------------------Stored Procedures ----------
----Sucursales Listar Las Sucursales
CREATE procedure SP_Sucursales
as
begin
 select
  idSucursal,
  Sucursal,
  Estado
 from Sucursales
 where Estado = 1
end
go


-----Insertar nuevo Empleado
ALTER PROCEDURE SP_InEmpleados
    @Nombre VARCHAR(150),
    @Paterno VARCHAR(50),
    @Materno VARCHAR(50),
    @Sexo VARCHAR(2),
    @Direccion VARCHAR(100),
    @Telefono VARCHAR(10),
    @Curp VARCHAR(18),
    @RFC VARCHAR(13),
    @Sueldo MONEY,
    @idPuesto INT,
    @idHorario INT,
	@Usuario varchar(50),
	@Pass varchar(50)
AS
BEGIN
    -- Insertar una nueva persona
    INSERT INTO Personas
    (Nombre, Paterno, Materno, Sexo, Direccion, Telefono, Curp, RFC)
    VALUES
    (@Nombre, @Paterno, @Materno, @Sexo, @Direccion, @Telefono, @Curp, @RFC);

    -- Obtener el idPersona del último registro insertado
    DECLARE @idperson INT;
    SET @idperson = SCOPE_IDENTITY();

    -- Insertar un nuevo empleado con el idPersona obtenido
    INSERT INTO Empleados
    (idPersona, Sueldo, idPuesto, idHorario,Usuario, Pass)
    VALUES
    (@idperson, @Sueldo, @idPuesto, @idHorario,@Usuario,@Pass);
END;
GO


---------------Acceso Login

alter procedure SP_Acceso
@idSucursal int,
@Usuario varchar(50),
@Pass varchar(50)
as
begin
SELECT
per.idPersona,
per.Nombre,
per.Paterno,
per.Materno,
per.Sexo,
per.Direccion,
per.Telefono,
per.Curp,
per.RFC,
emp.idEmpleado,
emp.idPersona,
emp.Sueldo,
emp.idPuesto,
emp.idHorario,
emp.Usuario,
emp.Pass,
suc.Sucursal
FROM
Personas AS per INNER JOIN
Empleados AS emp ON per.idPersona = emp.idPersona CROSS JOIN
Sucursales as suc
where emp.Usuario = @Usuario
and emp.Pass = @Pass
and suc.idSucursal = @idSucursal
end
go


---------Insertar un nuevo proveedor
create PROCEDURE SP_InProveedores
    @Nombre VARCHAR(150),
    @Paterno VARCHAR(50),
    @Materno VARCHAR(50),
    @Sexo VARCHAR(2),
    @Direccion VARCHAR(100),
    @Telefono VARCHAR(10),
    @Curp VARCHAR(18),
    @RFC VARCHAR(13),
	@Empresa varchar(50)
AS
BEGIN
    -- Insertar una nueva persona
    INSERT INTO Personas
    (Nombre, Paterno, Materno, Sexo, Direccion, Telefono, Curp, RFC)
    VALUES
    (@Nombre, @Paterno, @Materno, @Sexo, @Direccion, @Telefono, @Curp, @RFC);

    -- Obtener el idPersona del último registro insertado
    DECLARE @idprov INT;
    SET @idprov = SCOPE_IDENTITY();

    -- Insertar un nuevo empleado con el idPersona obtenido
    INSERT INTO Proveedores
    (idPersona, Empresa)
    VALUES
    (@idprov, @Empresa);
END;
GO


----------------Listar Los Productos
CREATE procedure SP_ListarProductos
as
begin
SELECT
prod.idProducto,
prod.Producto,
prod.Caducidad,
prod.Lote,
prod.idProveedor,
prod.idCategoria,
prod.Stock,
prod.PrecioVenta,
prod.PrecioCompra,
prod.Estado, 
cat.Categoria,
prov.Empresa
FROM
Productos as prod INNER JOIN
Proveedores as prov ON prod.idProveedor = prov.idProveedor INNER JOIN
Categorias as cat ON prod.idCategoria = cat.idCategoria
 where prod.Estado = 1
end
go


-------------Listar Los empleados
CREATE procedure SP_ListarEmpleados
as
begin
SELECT
Empleados.idEmpleado,
Empleados.idPersona, 
Empleados.Sueldo, 
Empleados.idPuesto,
Empleados.idHorario, 
Empleados.Usuario, 
Empleados.Pass, 
Personas.Nombre, 
Personas.Paterno, 
Personas.Materno, 
Personas.Sexo, 
Puestos.Puesto, 
Personas.Direccion, 
Personas.Telefono, 
Personas.Curp, 
Personas.RFC, 
Horarios.Horario
FROM
Empleados INNER JOIN
Personas ON Empleados.idPersona = Personas.idPersona INNER JOIN
Puestos ON Empleados.idPuesto = Puestos.idPuesto INNER JOIN
Horarios ON Empleados.idHorario = Horarios.idHorario
end
go


----------Modificaciones 23/05

-------Eliminar Clientes
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
go


-------Eliminar Productos
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
go

--------Modificar Empleado
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
go


-------Eliminar Empleado
CREATE PROCEDURE EliminarEmpleado
    @idEmpleado INT
AS
BEGIN
    DELETE FROM Empleados
    WHERE idEmpleado = @idEmpleado;
END
go

----Agregar Nuevo Producto
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
go


---------Modificar Producto
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
go


---------Modificar Proveedor
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
go


--------Eliminar Proveedor
CREATE PROCEDURE EliminarProveedor
    @idProveedor INT
AS
BEGIN
    DELETE FROM Proveedores
    WHERE idProveedor = @idProveedor;
END
go



------24/05
-------------Listar las categorias
alter procedure SP_ListarCatgorias
as
begin
SELECT
idCategoria, 
Categoria,
Refrigeracion, 
Estado
FROM            
Categorias
end
go


-----------listar Proveedores

CREATE procedure SP_ListarProveedores
as
begin
SELECT
Proveedores.idProveedor, 
Proveedores.idPersona, 
Proveedores.Empresa, 
Proveedores.Estado, 
Personas.idPersona, 
Personas.Nombre, 
Personas.Paterno, 
Personas.Materno, 
Personas.Sexo, 
Personas.Direccion, 
Personas.Telefono, 
Personas.Curp, 
Personas.RFC
FROM            
Proveedores INNER JOINDetalleVenta
Personas ON Proveedores.idPersona = Personas.idPersona AND Proveedores.idPersona = Personas.idPersona
where Proveedores.Estado = 1
end
go



--Crer el id venta
alter procedure CrearIdVenta
as
begin
set nocount on
insert into Ventas
	(Monto,Fecha,Estado)
	values
	(0,GETDATE(),2)

	select idVenta from Ventas where idVenta = @@IDENTITY
set nocount off
end
go


-------------25/05
--insertar detalle venta

alter procedure InsertDetalleVenta  
@idVenta int,  
@idProducto int,  
@PrecioVenta float,  
@Cantidad float  
as  
begin  
    set nocount on 
  
    begin try  
        begin transaction  
  
        if exists (select 1 from TempVentas where idVenta = @idVenta and idProducto = @idProducto and Estado = 1)  
        begin  

            update TempVentas  
            set Cantidad = Cantidad + @Cantidad,  
                Total = PrecioVenta * (Cantidad + @Cantidad)  
            where idVenta = @idVenta and idProducto = @idProducto and Estado = 1;  
        end  
        else  
        begin  

            if exists (select 1 from TempVentas where idVenta = @idVenta and idProducto = @idProducto and Estado = 0)  
            begin  

                update TempVentas  
                set Estado = 1,  
                    Cantidad = @Cantidad,  
                    Total = @PrecioVenta * @Cantidad  
                where idVenta = @idVenta and idProducto = @idProducto and Estado = 0;  
            end  
            else  
            begin  
 
                insert into TempVentas (idVenta, idProducto, PrecioVenta,Cantidad,Total,Estado)  
                values (@idVenta, @idProducto, @PrecioVenta, @Cantidad, @PrecioVenta * @Cantidad, 1);  
            end  
        end  
  
        commit transaction  
    end try 
    begin catch 
        rollback transaction   
        throw 
		end catch   
    set nocount off
end
go



----- Listar Venta temporal
create procedure ListarTempVenta
@idVenta int
as
begin
SELECT
TempVentas.idTempVenta, 
TempVentas.idVenta, 
TempVentas.idProducto,
Productos.Producto,
TempVentas.PrecioVenta, 
TempVentas.Cantidad, 
TempVentas.Total, 
TempVentas.Estado
FROM            
TempVentas INNER JOIN
Productos ON TempVentas.idProducto = Productos.idProducto
where TempVentas.idVenta = @idVenta and TempVentas.Estado = 1
end
go


--Eliminar de venta temporal
alter procedure EliminarTempVenta
	@idTempVenta int
as
begin
	update TempVentas
	set Estado = 0
	where idTempVenta=@idTempVenta
end
go





select * from Ventas
select * from TempVentas where idVenta = 45