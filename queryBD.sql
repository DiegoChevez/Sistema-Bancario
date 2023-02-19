USE master

Use Banco_Perla
GO
--CREACION DE TABLAS
CREATE TABLE Sucursales
(ID_Sucursal nchar(5) not null,
Departamento varchar(50) null,
Municipio varchar(25) not null,
Direccion varchar(100) not null,
GerenteSucursal char(5) not null,
)

CREATE TABLE Empleados
(ID_Empleado nchar(5) not null,
Nombres varchar(100) not null,
Apellidos varchar(100) not null,
DUI varchar(10) not null,
Telefono int not null,
Cargo nchar(5) not null,
TipoContratacion varchar(20) not null,
Domicilio varchar(100) not null,
Sucursal nchar(5) not null,
Estado varchar(20) not null,
)

CREATE TABLE Cargos
(ID_Cargo nchar(5) not null,
Cargo varchar(100)not null,
Descripcion varchar(250) not null,
Salario int not null,
)

CREATE TABLE Usuarios
(ID_Usuario nchar(5) not null,
Username varchar(20) not null,
Correo varchar(50) not null,
Contrasena varchar(20) not null,
FechaRegistro date not null,
Estado varchar(20) not null,
)

CREATE TABLE Roles
(ID_Rol nchar(5) not null,
Nombre varchar(20) not null,
Descripcion varchar(250) not null,
)

CREATE TABLE Clientes
(ID_Cliente nchar(5) not null,
Nombres varchar(100) not null,
Apellidos varchar(100) not null,
DUI varchar(10) not null,
IngresosMensuales int not null,
Domicilio varchar(250) not null,
Telefono int not null,
ID_Usuario nchar(5) not null,
)

CREATE TABLE Cuentas
(ID_Cuentas nchar(5) not null,
Cliente nchar(5) not null,
Saldo int not null,
TipodeCuenta varchar(50) not null,
FechaApertura date not null,
FechaFinalizacion date not null,
Estado varchar(20) not null,
)

CREATE TABLE Prestamos
(ID_Prestamo nchar(5) not null,
FK_Cliente nchar(5) not null,
Saldo int not null,
TipoInteres varchar(50) not null,
Estado varchar(20) not null,
)

CREATE TABLE AbonoPrestamo
(ID_AbonoPrestamo nchar(5) not null,
FK_Prestamos  nchar(5) not null,
PrestamoActual int not null,
)

CREATE TABLE Transacciones
(ID_Transaccion nchar(5) not null,
FK_Cuenta nchar(5) not null,
FechaRealizacion date not null,
HoraRealizacion time not null,
Monto int not null,
Concepto varchar (250) not null,
SaldoActual int not null,
Estado varchar(20) not null,
)

CREATE TABLE GerentesSucursales
(ID_GerenteSucursal nchar(5) not null,
Sucursal nchar(5) not null,
Gerente nchar(5) not null,
)
GO



Use master
Use Banco_Perla
--CREACION DE PRIMARIAS
GO
	ALTER TABLE GerentesSucursales
	ADD CONSTRAINT PK_GerenteSucursal
	PRIMARY KEY (ID_GerenteSucursal);

	ALTER TABLE Sucursales
	ADD CONSTRAINT PK_IdSurcusal
	PRIMARY KEY (ID_Sucursal);

	ALTER TABLE Transacciones
	ADD CONSTRAINT PK_ID_Transacciones
	PRIMARY KEY (ID_Transaccion);

	ALTER TABLE AbonoPrestamos
	ADD CONSTRAINT PK_ID_AbonoPrestamo
	PRIMARY KEY (ID_AbonoPrestamo);

	ALTER TABLE Prestamos
	ADD CONSTRAINT PK_ID_Prestamo
	PRIMARY KEY (ID_Prestamo);

	ALTER TABLE Cuentas
	ADD CONSTRAINT PK_ID_Cuenta
	PRIMARY KEY (ID_Cuenta);

	ALTER TABLE Roles
	ADD CONSTRAINT PK_ID_ROL
	PRIMARY KEY (ID_Rol);

	ALTER TABLE Clientes
	ADD CONSTRAINT PK_ID_Cliente
	PRIMARY KEY (ID_Cliente);

	ALTER TABLE Empleados
	ADD CONSTRAINT PK_ID_Empleados
	PRIMARY KEY (ID_Empleado);

	ALTER TABLE Cargos
	ADD CONSTRAINT PK_ID_Cargo
	PRIMARY KEY (ID_Cargo);

	ALTER TABLE Usuarios
	ADD CONSTRAINT PK_ID_Usuarios
	PRIMARY KEY (ID_Usuario);
GO


Use master
Use Banco_Perla
--CREACION DE FORANEAS
Go
	ALTER TABLE GerentesSucursales
	ADD CONSTRAINT FK_ID_Gerente_Sucursal
	FOREIGN KEY (Gerente)
	REFERENCES Empleados(ID_Empleado);

	ALTER TABLE GerentesSucursales
	ADD CONSTRAINT FK_ID_Sucursal_Gerente
	FOREIGN KEY (Sucursal)
	REFERENCES Sucursales(ID_Sucursal);

	ALTER TABLE Empleados
	ADD CONSTRAINT FK_ID_Cargo
	FOREIGN KEY (Cargo)
	REFERENCES Cargos(ID_Cargo);

	ALTER TABLE Usuarios
	ADD CONSTRAINT FK_ID_Rol
	FOREIGN KEY (Rol)
	REFERENCES Roles(ID_Rol);

	ALTER TABLE Clientes
	ADD CONSTRAINT FK_ID_USUARIO
	FOREIGN KEY (ID_Usuario)
	REFERENCES Usuarios(ID_Usuario);

	ALTER TABLE Cuentas
	ADD CONSTRAINT FK_ID_Cliente
	FOREIGN KEY (Cliente)
	REFERENCES Clientes(ID_Cliente);

	ALTER TABLE Prestamos
	ADD CONSTRAINT FK_ID_Cliente_Prestamo
	FOREIGN KEY (Prestamista)
	REFERENCES Clientes(ID_Cliente);

	ALTER TABLE AbonoPrestamos
	ADD CONSTRAINT FK_ID_AbonoPrestamo
	FOREIGN KEY (FK_Prestamos)
	REFERENCES Prestamos(ID_Prestamo);

	ALTER TABLE Transacciones
	ADD CONSTRAINT FK_ID_Cuenta_Transaccion
	FOREIGN KEY (CuentaPropietaria)
	REFERENCES Cuentas(ID_Cuenta);

Go