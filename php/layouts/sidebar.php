<aside class="sidebar">

    <div>

        <div class="logo">

            <h2>ScanCash</h2>

            <div class="user-info">

                <strong>
                    <?php echo $_SESSION['nombre']; ?>
                </strong>

                <span>
                    <?php echo $_SESSION['rol']; ?>
                </span>

            </div>

        </div>

        <nav>

            <ul>

                <li>
                    <a href="/scancash/php/index.php">
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="/scancash/php/escaneo.php">
                        Escaneo
                    </a>
                </li>

                <li>
                    <a href="/scancash/php/historial.php">
                        Historial
                    </a>
                </li>

                <li>
                    <a href="/scancash/php/ventas.php">
                        Ventas
                    </a>
                </li>

                <li>
                    <a href="/scancash/php/cierre_caja.php">
                        Cierre de Caja
                    </a>
                </li>

                <?php if($_SESSION['rol'] == 'Administrador'){ ?>

                    <li class="menu-title">
                        Administración
                    </li>

                    <li>
                        <a href="/scancash/admin/usuarios/usuarios.php">
                            Usuarios
                        </a>
                    </li>

                    <li>
                        <a href="/scancash/admin/bancos/bancos.php">
                            Bancos
                        </a>
                    </li>

                <?php } ?>

            </ul>

        </nav>

    </div>

    <div class="logout">

        <a href="/scancash/php/logout.php">
            Cerrar Sesión
        </a>

    </div>

</aside>