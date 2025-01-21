
    <header>
        <div class="icon-left">
            <img src="./assets/PVDT.png" alt="Icon Left">
        </div>
        <nav>
            <ul>
                <li><a href="index.php?page=home" class="<?= ($currentPage == "./screens/home.php") ? 'active' : '' ?>">Home</a></li>
                <li><a href="index.php?page=detail" class="<?= ($currentPage == "./screens/detail.php") ? 'active' : '' ?>">Detail</a></li>
                <li><a href="index.php?page=curve" class="<?= ($currentPage == "./screens/curve.php") ? 'active' : '' ?>">Curve</a></li>
                <li><a href="index.php?page=event" class="<?= ($currentPage == "./screens/event.php") ? 'active' : '' ?>">Event</a></li>
            </ul>
        </nav>
        <div class="icon-right">
            <img src="./assets/icon-lab.png" alt="Icon Right">
        </div>
    </header>