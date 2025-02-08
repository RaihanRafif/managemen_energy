<header>
    <div class="icon-left">
        <img src="./assets/PVDT.png" alt="Icon Left">
    </div>
    <nav>
        <ul>
            <li><a href="index.php?page=home" class="<?= ($_SERVER['REQUEST_URI'] == "/managemen_energy/index.php?page=home" || $_SERVER['REQUEST_URI'] == "/managemen_energy/") ? 'active' : '' ?>">Home</a></li>
            <li><a href="index.php?page=detail" class="<?= ($_SERVER['REQUEST_URI'] == "/managemen_energy/index.php?page=detail") ? 'active' : '' ?>">Detail</a></li>
            <li><a href="index.php?page=curve" class="<?= ($_SERVER['REQUEST_URI'] == "/managemen_energy/index.php?page=curve") ? 'active' : '' ?>">Curve</a></li>
            <li><a href="index.php?page=event" class="<?= ($_SERVER['REQUEST_URI'] == "/managemen_energy/index.php?page=event") ? 'active' : '' ?>">Event</a></li>
        </ul>
    </nav>
    <div class="icon-right">
        <img src="./assets/icon-lab.png" alt="Icon Right">
    </div>
</header>