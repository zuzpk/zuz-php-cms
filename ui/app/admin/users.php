<div class="admin flex rel">
    <div class="acontent users flex col" data-pgt="<?php echo isset($_GET['pgt']) ? $_GET['pgt'] : 'pg'; ?>">
        <div class="page-title flex aic">
            <div class="_l">
                <?php if(isset($_PARAMS->edit)){ ?>
                    <div class="crumb flex aic">
                        <a href="<?php echo BASEURL . 'am/users?_t=' . time(); ?>" class="s20 font b900 noul noulh color">Users</a>
                        &nbsp;<div class="icon-chevron-right s20"></div>&nbsp;
                        <h2 class="s20 font b900">Edit</h2>
                    </div>
                <?php }else{ ?>
                    <h2 class="s20 font b900 the-title">Users</h2>
                <?php } ?>
            </div>
            <div class="_r flex aic jce">
                <?php if(!isset($_PARAMS->edit)){ ?>
                <div class="search flex aic">
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
                </div>
                <?php } ?>
            </div>
        </div>
        
        <?php include(dirname( dirname(__FILE__) ) . '/cover.php'); ?>

        <?php if(isset($_PARAMS->edit)){ ?>
            <div class="uform flex col rel">
                <div class="flex group aic">
                    <div class="stc flex col">
                        <h2 class="s15 lbl font b">Status</h2>
                        <select class="font input user_status s16">
                            <option value="inactive">Email Verification</option>
                            <option value="active">Active</option>
                            <option value="banned">Banned</option>
                        </select>
                    </div>
                    <div class="spt"></div>
                    <div class="stc flex col">
                        <h2 class="s15 lbl font b">User Type</h2>
                        <select class="font input user_type s16">
                            <option value="free">Free</option>
                            <option value="pro">Premium</option>
                        </select>
                    </div>
                </div>
                <div class="stc flex col block_reason_box" style="display: none;">
                    <h2 class="s15 lbl font b block_reason_label">Block Reason</h2>
                    <textarea placeholder="Block Reason" class="font input block_reason s16"></textarea>
                </div>
                <div class="flex group aic">
                    <div class="stc flex col">
                        <h2 class="s15 lbl font b">Premium Plan</h2>
                        <select class="font input pro_plan s16" style="width: 100%;">
                            <option value="-1">Choose Plan</option>
                            <option value="person">Personal</option>
                            <option value="pro">Professional</option>
                            <option value="team">Team</option>
                            <option value="business">Business</option>
                        </select>
                    </div>
                    <div class="spt"></div>
                    <div class="stc flex col">
                        <h2 class="s15 lbl font b">Premium Expiry</h2>
                        <input type="text" placeholder="00/00/0000" class="font input pro_expiry s16" />
                    </div>
                </div>
                <div class="stc flex col">
                    <h2 class="s15 lbl font b">Full Name</h2>
                    <input type="text" placeholder="John Doe" class="font input user_name s16" />
                </div>
                <div class="stc flex col">
                    <h2 class="s15 lbl font b">Email</h2>
                    <input type="text" placeholder="hello@example.com" class="font input user_email s16" />
                </div>
                <div class="flex group aic">
                    <div class="stc flex col">
                        <h2 class="s15 lbl font b">Password</h2>
                        <input type="text" placeholder="Password" class="font input user_passw s16" />
                    </div>
                </div>
                <div class="stc flex col" style="margin-top: 20px;margin-bottom: 50px;">
                    <button style="width: 180px;" class="font update_user b s15 button cfff">Save Changes</button>
                </div>
            </div>
        <?php }else{ ?>
            <div class="users users-data" data-mod="0">
                <div class="data-table">
                    <div class="data-row rh data-row-head flex sticky">
                        <div class="data-col s15 col-id">
                            <h2 class="b font">ID</h2>
                        </div>
                        <div class="data-col col-name">
                            <h2 class="b font">Name</h2>
                        </div>                            
                        <div class="data-col col-stamp">
                            <h2 class="b font">Last Active</h2>
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