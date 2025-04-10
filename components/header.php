<header>
    <div class="icon-left">
        <img src="./assets/PVDT.png" alt="Icon Left">
    </div>
    <nav>
        <ul>
            <li>
                <a href="index.php?page=home"
                    class="<?=
                            (strpos($_SERVER['REQUEST_URI'], 'page=home') !== false ||
                                rtrim($_SERVER['REQUEST_URI'], '/') === '/managemen_energy' ||
                                $_SERVER['REQUEST_URI'] === '/managemen_energy/')
                                ? 'active'
                                : ''
                            ?>">
                    Home
                </a>
            </li>
            <li><a href="index.php?page=detail" class="<?= (strpos($_SERVER['REQUEST_URI'], 'page=detail') !== false) ? 'active' : '' ?>">Detail</a></li>
            <li><a href="index.php?page=curve" class="<?= (strpos($_SERVER['REQUEST_URI'], 'page=curve') !== false) ? 'active' : '' ?>">Report</a></li>
            <li><a href="index.php?page=event" class="<?= (strpos($_SERVER['REQUEST_URI'], 'page=event') !== false) ? 'active' : '' ?>">Diagnosis</a></li>
        </ul>
    </nav>
    <div class="icon-right">
        <img src="./assets/icon-lab.png" alt="Icon Right">
    </div>
</header>