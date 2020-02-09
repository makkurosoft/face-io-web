<div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?php echo base_url() . "main/dashboard"?>">Face-io</a>
        <div class="collapse navbar-collapse justify-content-start">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo base_url() . "main/dashboard"?>">ダッシュボード</a>
                </li>
            </ul>
        </div>
        <li class="nav-item dropdown list-unstyled">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $user_name?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="<?php echo base_url() . "main/dashboard"?>">ダッシュボード</a>
                <a class="dropdown-item" href="<?php echo base_url() . "main/signout"?>">サインアウト</a>
            </div>
        </li>
    </nav>
    <p>不正なクラスIDです。</p>
</div>
