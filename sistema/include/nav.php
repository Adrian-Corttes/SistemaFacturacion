<nav>
    <ul>
        <li><a href="index.php"><i class="fas fa-sign-in-alt"></i> Inicio</a></li>
        <?php if ($_SESSION['rol'] == 1) { ?>
            <li class="principal">
                <a href="#"><i class="fas fa-user-tie"></i> Usuarios</a>
                <ul>
                    <li><a href="registro_usuario.php"><i class="fas fa-user-plus"></i> Nuevo Usuario</a></li>
                    <li><a href="lista_usuarios.php"><i class="fas fa-align-justify"></i> Lista de Usuarios</a></li>
                </ul>
            </li>
        <?php } ?>
        <li class="principal">
            <a href="#"><i class="fas fa-users"></i> Clientes</a>
            <ul>
                <li><a href="registro_cliente.php"><i class="fas fa-user-plus"></i> Nuevo Cliente</a></li>
                <li><a href="lista_clientes.php"><i class="fas fa-align-justify"></i> Lista de Clientes</a></li>
            </ul>
        </li>
        <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) { ?>
            <li class="principal">
                <a href="#"><i class="fas fa-truck-moving"></i> Proveedores</a>
                <ul>
                    <li><a href="registro_proveedor.php"><i class="fas fa-truck"></i> Nuevo Proveedor</a></li>
                    <li><a href="lista_proveedor.php"><i class="fas fa-align-justify"></i> Lista de Proveedores</a></li>
                </ul>
            </li>
        <?php } ?>
        <li class="principal">
            <a href="#"><i class="fas fa-cubes"></i> Productos</a>
            <ul>
                <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) { ?>
                    <li><a href="registro_producto.php"><i class="fas fa-box-open"></i> Nuevo Producto</a></li>
                <?php } ?>
                <li><a href="lista_producto.php"><i class="fas fa-align-justify"></i> Lista de Productos</a></li>
            </ul>
        </li>
        <li class="principal">
            <a href="#"><i class="fas fa-cash-register"></i> Ventas</a>
            <ul>
                <li><a href="nueva_venta.php"><i class="fas fa-cart-arrow-down"></i> Nueva Venta</a></li>
                <li><a href="#">Ventas</a></li>
            </ul>
        </li>
    </ul>
</nav>
