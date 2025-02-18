<div class="admin flex">
    <div class="acontent dashboard flex col">
        <h2 class="s30 font b900 page-title">Dashboard</h2>
        <div class="stats flex aic">
            <div class="sts flex col">
                <h2 class="s36 font b"><?php echo DB::SELECT("SELECT COUNT(ID) as total FROM users WHERE status=? OR status=?", array("active", "inactive"), "ss")->row->total; ?></h2>
                <h2 class="s18 font c777">Users</h2>
            </div>
            <div class="sts flex col">
                <h2 class="s36 font b"><?php echo DB::SELECT("SELECT COUNT(ID) as total FROM payments WHERE step=?", array("completed"), "s")->row->total; ?></h2>
                <h2 class="s18 font c777">Payments</h2>
            </div>
            <div class="sts flex col">
                <h2 class="s36 font b">&nbsp;</h2>
                <h2 class="s18 font c777">&nbsp;</h2>
            </div>
    </div>
    </div>
</div>