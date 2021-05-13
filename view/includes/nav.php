<nav class="side-menu">
    <ul class="side-menu-list">
        <li class="blue-dirty">
            <a href="../Home/">
                <span class="glyphicon glyphicon-th"></span>
                <span class="lbl">Inicio</span>
            </a>
        </li>
        <?php if($_SESSION['rol_id'] == 1): ?>
        <li class="blue-dirty">
            <a href="../NuevoTicket/">
                <span class="glyphicon glyphicon-th"></span>
                <span class="lbl">Nuevo ticket</span>
            </a>
        </li>
        <?php endif; ?>

        
        <?php if($_SESSION['rol_id'] == 2): ?>
        <li class="blue-dirty">
            <a href="../MntUsuarios/">
                <span class="glyphicon glyphicon-th"></span>
                <span class="lbl">Mantenimiento Usuarios</span>
            </a>
        </li>
        <?php endif; ?>
        
        <li class="blue-dirty">
            <a href="../ConsultarTicket/">
                <span class="glyphicon glyphicon-th"></span>
                <span class="lbl">Consultar ticket</span>
            </a>
        </li>
    </ul>
</nav>