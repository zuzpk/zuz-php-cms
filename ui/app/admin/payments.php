<div class="admin flex rel">
    <div class="acontent payments flex col" data-pgt="<?php echo isset($_GET['pgt']) ? $_GET['pgt'] : 'pg'; ?>">
        <div class="page-title flex aic">
            <div class="_l">
                <?php if(isset($_GET['edit'])){ ?>
                    <div class="crumb flex aic">
                        <a href="<?php echo BASEURL; ?>users/" class="s20 font b noul noulh color">Payments</a>
                        &nbsp;<div class="icon-chevron-right s20"></div>&nbsp;
                        <h2 class="s20 font b">Edit</h2>
                    </div>
                <?php }else{ ?>
                    <h2 class="s20 font b the-title">Payments</h2>
                <?php } ?>
            </div>
            <div class="_r flex aic je">
                <!-- <div class="search flex aic">
                    <button class="ico search-unow icon-search s16">
                        <span class="path1"></span><span class="path2"></span>
                    </button>
                    <input type="text" placeholder="Search" class="query search-query s16 font" />
                    <select class="search-filter s16 font">
                        <option value="ids">ID</option>
                        <option value="email">Email</option>
                        <option value="name">Name</option>
                    </select>
                    <button class="clear-search icon-clear s20 color ico"></button>
                </div> -->
            </div>
        </div>
        
        <?php include(dirname( dirname(__FILE__) ) . '/cover.php'); ?>

        <div class="payments payments-data" data-mod="0">
            <div class="data-table">
                <div class="data-row rh data-row-head flex sticky">
                    <div class="data-col s15 col-id">
                        <h2 class="b font">ID</h2>
                    </div>
                    <div class="data-col col-name">
                        <h2 class="b font">Name</h2>
                    </div>                            
                    <div class="data-col col-stamp">
                        <h2 class="b font">Trx</h2>
                    </div>
                    <div class="data-col col-action">
                        <h2 class="b font">Date</h2>
                    </div>
                </div>      
            </div>
        </div>
        <!-- Pagination -->
        <div class="__pagination"></div>

    </div>
</div>