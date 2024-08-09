
<!-- Heading -->
<div class="sidebar-heading">
    <i class="fas fa-fw fa-cog"></i>
    Gestión
</div>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
        aria-expanded="true" aria-controls="collapseOne">
        <i class="fas fa-building"></i>
        <span>Administración</span>
    </a>
    <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Inmuebles:</h6>
            <?php 
                if($_SESSION["admin"]){
            ?>
            <a class="collapse-item" href="property"><i class="far fa-building"></i> Propiedad</a>
            <a class="collapse-item" href="newsletter"><i class="fas fa-newspaper"></i> Newsletter</a>
            <a class="collapse-item" href="documents"><i class="fas fa-folder-plus"></i> Documentos</a>
            <a class="collapse-item" href="send"><i class="fas fa-paper-plane"></i> Generar envios</a>
            <a class="collapse-item" href="payings"><i class="fas fa-file-invoice-dollar"></i> Gestión de pagos</a>
            <?php }else{ ?>
                <a class="collapse-item" href="payings"><i class="fas fa-file-invoice-dollar"></i> Gestión de pagos</a>
                <a class="collapse-item" href="urgencias"><i class="fas fa-chart-pie"></i> Servicios Urgencia</a>
            <?php } ?>
        </div>
    </div>
</li>

<?php 
    if($_SESSION["admin"]){
?>
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-kaaba"></i>
        <span>Inmobiliaria</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Inmuebles:</h6>
            <a class="collapse-item" href="publication"><i class="fab fa-wpforms"></i> Publicación</a>
            <a class="collapse-item" href="services"><i class="fas fa-hospital-symbol"></i> Urgencias</a>
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-chart-pie"></i>
        <span>Informes</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Informes:</h6>
            <a class="collapse-item" href="getproperty"><i class="fas fa-chart-pie"></i> /propiedades</a>
            <a class="collapse-item" href="getnewsletter"><i class="fas fa-chart-pie"></i> /newsletter</a>
            <a class="collapse-item" href="getdocuments"><i class="fas fa-chart-pie"></i> /documentos</a>
            <a class="collapse-item" href="getsend"><i class="fas fa-chart-pie"></i> /envíos</a>
            <a class="collapse-item" href="getpayings"><i class="fas fa-chart-pie"></i> /pagos</a>
            <a class="collapse-item" href="getpublish"><i class="fas fa-chart-pie"></i> /publicaciones</a>
            <a class="collapse-item" href="urgencias"><i class="fas fa-chart-pie"></i> /Servicios urgencia</a>
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item" style="display:none">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTools"
        aria-expanded="true" aria-controls="collapseTools">
        <i class="fas fa-cog"></i>
        <span>Definiciones</span>
    </a>
    <div id="collapseTools" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Inmueble:</h6>
            <a class="collapse-item" href="/">Tipo de inmueble</a>
            <a class="collapse-item" href="/">Monedas</a>
        </div>
    </div>
</li>
<?php } ?>