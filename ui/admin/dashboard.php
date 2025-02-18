<?php 
use \Zuz\DB;
use \Zuz\Config;
use \Zuz\User;

if( !User::isAdmin() ) {
    header('location: ' . Config::BASEURL); exit;
}

?><div class="admin flex">
    <?php include(__DIR__ . '/sidebar.php'); ?>
    <div class="acontent dashboard flex col">
        <h2 class="s20 bold page-title">Dashboard</h2>
        <div class="stats flex aic">
            <div class="sts flex col">
                <h2 class="s36 bold"><?php echo DB::SELECT("SELECT COUNT(ID) as total FROM users WHERE status=? OR status=?", array("active", "inactive"))->row->total; ?></h2>
                <h2 class="s18 c777">Users</h2>
            </div>
            <div class="sts flex col">
                <h2 class="s36 bold"><?php echo DB::SELECT("SELECT COUNT(ID) as total FROM payments WHERE step=?", array("done"))->row->total; ?></h2>
                <h2 class="s18 c777">Payments</h2>
            </div>
            <div class="sts flex col">
                <h2 class="s36 bold">&nbsp;</h2>
                <h2 class="s18 c777">&nbsp;</h2>
            </div>
    </div>
    </div>
</div>