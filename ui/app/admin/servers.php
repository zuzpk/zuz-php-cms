<div class="admin flex rel">
    <?php $total = DB::SELECT("SELECT COUNT(ID) as total FROM servers WHERE status=?", array(1), "i")->row->total; ?>
    <div class="acontent aservers flex col" data-pgt="<?php echo isset($_GET['pgt']) ? $_GET['pgt'] : 'pg'; ?>">
        <div class="page-title flex aic">
            <div class="_l">
                <?php if(isset($_GET['edit'])){ ?>
                    <div class="crumb flex aic">
                        <a href="<?php echo BASEURL; ?>cp/servers" class="s20 font b noul noulh color">Servers</a>
                        &nbsp;<div class="icon-chevron-right s20"></div>&nbsp;
                        <h2 class="s20 font b"><?php echo $_GET['sid'] == 'add' ? 'Add New' : 'Edit'; ?></h2>
                    </div>
                <?php }else{ ?>
                    <h2 class="s20 font b the-title">Servers</h2>
                <?php } ?>
            </div>
            <div class="_r flex aic je">
                <a href="<?php echo BASEURL; ?>cp/servers/add" class="button noul cfff b add-server flex ass">Add New</a>
            </div>
        </div>
        
        <?php include(dirname( dirname(__FILE__) ) . '/cover.php'); ?>

        <?php if(isset($_GET['sid'])){ ?>
            <div class="uform flex col rel">
                <div class="stc flex col">
                    <h2 class="s15 lbl font b">Status</h2>
                    <select class="font input server_status s16">
                        <option value="1">Active</option>
                        <option value="0">Block</option>
                    </select>
                </div>
                <div class="stc flex col">
                    <h2 class="s15 lbl font b">Name</h2>
                    <input type="text" placeholder="My Server" class="font input server_name s16" />
                </div>
                <div class="stc flex col">
                    <h2 class="s15 lbl font b">Server URL (Must end with `/`)</h2>
                    <input type="text" placeholder="https://xyz.example.com/" class="font input server_url s16" />
                </div>
                <div class="stc flex col">
                    <h2 class="s15 lbl font b">IP Address</h2>
                    <input type="text" placeholder="0.0.0.0" class="font input server_ipaddr s16" />
                </div>
                <div class="stc flex col">
                    <h2 class="s15 lbl font b">Diskspace (GB)</h2>
                    <input type="text" placeholder="0" class="font input server_disk s16" />
                </div>                
                <div class="stc flex col" style="margin-top: 20px;margin-bottom: 50px;">
                    <button style="width: 160px;" data-id="<?php echo $_GET['sid']; ?>" class="font update_server b s16 button cfff">Save Changes</button>
                </div>
            </div>
        <?php }else{ ?>
            <div class="aservers servers-data" data-mod="0">
                <div class="data-table">
                    <div class="data-row rh data-row-head flex sticky">
                        <div class="data-col s15 col-id">
                            <h2 class="b font">ID</h2>
                        </div>
                        <div class="data-col col-name">
                            <h2 class="b font">URL</h2>
                        </div>                            
                        <div class="data-col col-stamp">
                            <h2 class="b font">Storage</h2>
                        </div>
                        <div class="data-col col-action">
                            &nbsp;
                        </div>
                    </div>      
                </div>
            </div>
            <!-- Pagination -->
            <div class="__pagination"></div>
        <?php } ?>

    </div>
</div>