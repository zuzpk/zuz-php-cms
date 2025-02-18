const App = {
    base: __.base,
    error: null,
    debug: true,
    data: {
        empty: false
    }
}
function loadUsers(){
    $(".users .cover").fadeIn(200);
    scrollTo("body", 1000, ".app-content");
    var isEdit = window.location.pathname.split("/")[3];
    var query = isEdit == "" || isEdit == undefined ? $(".search-query").val() : isEdit;
    App.error = null;
    withRest(
        `a/get_users`,
        {
            edit: isEdit == "" ? 0 : 1,
            query: query,
            queryBy: isEdit != "" && isEdit != undefined ? "ids" : $(".search-filter").val(),
            pgt: $(".users").attr("data-pgt")
        }
    )
    .then(resp => {
        App["data"] = {
            empty: false,
            list: resp.list,
            pagination: resp.pages
        }
        if(isEdit == "" || undefined == isEdit){
            RenderUsers();
        }else{
            EditUser(resp.list[0]);
        }        
    })
    .catch(err => {
        App.debug && console.log(err);
        App["data"] = {
            error: err,
            empty: true,
            list: []
        }
        RenderUsers();
    });
}

function RenderUsers(){
    $(".data-table .data-row:not(.data-row-head)").remove();
    $(".data-table .error-404").remove();
    if(App.data && App.data.empty){        
        $(".data-table").append(Empty(':)', 'No Record Found.'));
        $(".__pagination").html(``);
        $(".users .cover").fadeOut(200);
    }else{
        App.data.list.map(function(item){
            $(".data-table").append(
                `<div class="data-row flex s15">
                    <div class="data-col s15 col-id">
                        <h2 class="s20 font b c777">${item.oid}</h2>
                    </div>
                    <div class="data-col col-name" title="${item.name}\n${item.email}\n${item.utype == `pro` ? `Pro ${item.uplan}` : `Free User`}">
                        <div class="font">
                            <h2 class="b pl wordwrap flex aic">
                                <div class="wordwrap">${item.name}</div>
                                ${item.utype == `pro` ? `<div class="pro-tip font s11 b cfff nous flex aic">Pro <span class="b gradient">${item.uplan}</span></div>` : ``}
                                ${item.status == `debrid` ? `<div style="padding: 2px 4px;background: #d12e2e;" class="pro-tip font s11 b cfff nous flex aic">Debrid</div>` : ``}
                            </h2>
                            <h2 class="s14 c777 em wordwrap">${item.email}</h2>
                        </div>
                    </div>                            
                    <div class="data-col col-stamp">
                        <div class="font">
                            <h2 class="b pl wordwrap flex aic">${item.signin.ago.indexOf(`month`) > -1 ? item.signin.stamp : item.signin.ago}</h2>
                            <h2 class="s14 c777 em wordwrap">${item.signin.location || ``}</h2>
                        </div>
                    </div>
                    <div class="data-col col-action">
                        <a href="${App.base}am/users/${item.ID}" class="color noul noulh b">Edit</a>
                    </div>
                </div>`
            );
        });
        Pagination(
            App['data'].pagination, 
            $(".users").attr("data-pgt"),
            function(pgt){
                window.location = `${App.base}am/users?pgt=${pgt}`;
            }
        );
    }
    $(".users .cover").fadeOut(200);
}

function EditUser(u){
    $(".uform .user_status").val(u.status);
    $(".uform .user_type").val(u.utype);
    $(".uform .pro_plan").val(u.uplan);
    $(".uform .user_name").val(u.name);
    $(".uform .user_email").val(u.email);
    $(".uform .user_passw").val(u.password);
    $(".uform .update_user, .uform .reset_bandwidth").attr("data-id", u.ID);
    $(".uform .pro_expiry")
    .datepicker({
        dateFormat: `d/m/yy`
    })
    .datepicker("setDate", u.utype == `pro` ? new Date(u.uexpiry * 1000) : new Date());
    if(u.expiry > 0){
        $(".uform .pro_expiry").datepicker('setDate', new Date(u.expiry));
    }

    if(u.status == "banned"){
        $(".uform .block_reason").val(u.block_reason);
        $(".block_reason_box").show();
    }else{
        $(".block_reason_box").hide();
    }

    $(".uform .user_status").on("change", function(){
        if($(this).val() == "banned"){
            $(".block_reason_box").show();
        }else{
            $(".block_reason_box").hide();
        }
    });
    $(".users .cover").fadeOut(200);
}

function UpdateUser(){
    var UID = $(this).attr("data-id"),
    utype = $(".uform .user_type").val(),
    plan = $(".uform .pro_plan").val(),
    status = $(".uform .user_status").val(),
    name = $(".uform .user_name").val(),
    email = $(".uform .user_email").val(),
    passw = $(".uform .user_passw").val(),
    breason = $(".uform .block_reason").val();

    if(utype == `pro` && plan == "-1"){
        Toast.show("Select Premium Plan!", 5, 'error');
    }else if(utype == `pro` && ($(".pro_expiry").datepicker("getDate") == null || $(".pro_expiry").datepicker("getDate").getTime() <= new Date().getTime())){
        Toast.show(`Premium expiry should be greater than today's date.`, 5, 'error')
    }else if(name == ""){
        Toast.show("Enter full name...", 5, 'error')
    }else if(passw == ""){
        Toast.show("Enter password...", 5, 'error')
    }else{
        $(".users .cover").fadeIn(200);
        scrollTo(".acontent", 1000, ".acontent");
        withRest(
            `a/update_user`,
            {
                ID: UID,
                status: status,
                utype: utype, plan: plan, expiry: $(".pro_expiry").datepicker("getDate") ? $(".pro_expiry").datepicker("getDate").getTime() / 1000 : 0,
                name: name, email: email, passw: passw,
                breason: breason
            }
        )
        .then(resp => {
            Toast.show(resp.message || "User updated successfully...", 5, 'success');
            $(".users .cover").fadeOut(200);
        })
        .catch(err => {
            App.debug && console.log(err);
            Toast.show("Changed were not saved.", 5, 'error');
            $(".users .cover").fadeOut(200);
        });
    }
}

function loadServers(){
    $(".aservers .cover").fadeIn(200);
    scrollTo("body", 1000, ".app-content");
    var isEdit = window.location.pathname.split("/")[3];
    var query = isEdit == "" || isEdit == undefined ? $(".search-query").val() : isEdit;
    grab(
        `${App.api}a/get_servers`,
        {
            edit: isEdit == "" ? 0 : 1,
            query: query,
            queryBy: isEdit != "" && isEdit != undefined ? "ids" : $(".search-filter").val(),
            pgt: $(".aservers").attr("data-pgt")
        },
        resp => {
            if("kind" in resp){
                App["data"] = {
                    empty: false,
                    list: resp.list,
                    pagination: resp.pages
                }
                if(isEdit == "" || undefined == isEdit){
                    RenderServers();
                }else{
                    EditServer(resp.list[0]);
                }
            }else if(resp.reason == "oauth"){
                sessionExpired();
            }else{
                App["data"] = {
                    empty: true,
                    list: []
                }
                RenderServers();
            }
        },
        err => {
            App.debug && console.log(err);
            App["data"] = {
                empty: true,
                list: []
            }
            RenderServers();
        }
    );
}

function RenderServers(){
    $(".data-table .data-row:not(.data-row-head)").remove();
    $(".data-table .error-404").remove();
    if(App.data && App.data.empty){        
        $(".data-table").append(Empty(':)', 'No Record Found.'));
        $(".__pagination").html(``);
        $(".aservers .cover").fadeOut(200);
    }else{
        App.data.list.map(function(item){
            $(".data-table").append(
                `<div class="data-row flex s15">
                    <div class="data-col s15 col-id">
                        <h2 class="s20 font b c777">${item.oid}</h2>
                    </div>
                    <div class="data-col col-name">
                        <div class="font">
                            <h2 class="b pl wordwrap flex aic">
                                <div class="wordwrap">${item.label}</div>
                            </h2>                            
                            <h2 class="s14 c777 b em wordwrap" style="margin-top: 4px;">${item.uri}</h2>
                            <h2 class="s14 c777 em wordwrap" style="margin-top: 4px;">${item.ip}</h2>
                        </div>
                    </div>                            
                    <div class="data-col col-stamp">
                        <div class="font">
                            <h2 class="pl wordwrap flex aic">${item.disk.used} / ${item.disk.total}</h2>
                        </div>
                    </div>
                    <div class="data-col col-action">
                        <a href="${App.base}cp/servers/${item.ID}" class="color noul noulh b">Edit</a>
                    </div>
                </div>`
            );
        });
        Pagination(
            App['data'].pagination, 
            $(".aservers").attr("data-pgt"),
            function(pgt){
                window.location = `${App.base}cp/servers?pgt=${pgt}`;
            }
        );
    }
    $(".aservers .cover").fadeOut(200);
}

function EditServer(u){
    $(".uform .server_status").val(u.status);
    $(".uform .server_name").val(u.label);
    $(".uform .server_url").val(u.uri);
    $(".uform .server_ipaddr").val(u.ip);
    $(".uform .server_disk").val(u.disk.rawTotal / 1024 / 1024 / 1024);
    $(".aservers .cover").fadeOut(200);
}

function UpdateServer(){
    var UID = $(this).attr("data-id"),
    status = $(".uform .server_status").val(),
    nm = $(".uform .server_name").val(),
    url = $(".uform .server_url").val(),
    ip = $(".uform .server_ipaddr").val(),
    disk = $(".uform .server_disk").val();

    if(nm == ""){
        Toast.show("Enter Server Name", 5, 'error')
        $(".server_name").focus();
    }else if(url == ""){
        Toast.show("Enter server url.", 5, 'error')
        $(".server_url").focus();
    }else if(ip == ""){
        Toast.show("Enter Server IP Address", 5, 'error')
        $(".server_ipaddr").focus();
    }else if(parseInt(disk) <= 0){
        Toast.show("Enter Server Disk in GB", 5, 'error')
        $(".server_diskr").focus();
    }else{
        $(".aservers .cover").fadeIn(200);
        scrollTo(".acontent", 1000, ".acontent");
        grab(
            `${App.api}a/save_server`,
            {
                ID: UID,
                status: status,
                nm: nm, url: url,
                ip: ip, disk: disk
            },
            resp => {
                if("kind" in resp){
                    Toast.show(resp.message || "Server saved successfully...", 5, 'error')
                    $(".aservers .cover").fadeOut(200);
                    if(UID == 'add'){
                        window.location = `${App.base}cp/servers?_t=${new Date().getTime()}`;
                    }
                }else if(resp.reason == "oauth"){
                    sessionExpired();
                }else{
                    Toast.show(resp.message || "Server was not updated...", 5, 'error')
                    $(".aservers .cover").fadeOut(200);
                }
            },
            err => {
                App.debug && console.log(err);
                Toast.show("Changed were not saved.", 5, 'error')
                $(".aservers .cover").fadeOut(200);
            }
        );
    }
}

function loadPayments(){
    $(".cover").fadeIn(200);
    App["data"] = {
        empty: true,
        list: []
    }
    withRest(
        `a/get_payments`,
        {
            query: $(".search-query").val(),
            queryBy: $(".search-filter").val(),
            pgt: $(".payments").attr("data-pgt")
        }
    )
    .then(resp => {
        App["data"] = {
            empty: false,
            list: resp.list,
            pagination: resp.pages
        }
        RenderPayments();
    })
    .then(err => {
        App.debug && console.log(err);
        // App["data"] = {
        //     empty: true,
        //     list: []
        // }
        RenderPayments();
    });
}

function RenderPayments(){
    $(".data-table .data-row:not(.data-row-head)").remove();
    $(".data-table .error-404").remove();
    if(App.data && App.data.empty){        
        $(".data-table").append(Empty(':)', 'No Record Found.'));
        $(".__pagination").html(``);
    }else{
        App.data.list.map(function(item){
            $(".data-table").append(
                `<div class="data-row flex s15">
                    <div class="data-col s15 col-id">
                        <h2 class="s20 font b c777">${item.oid}</h2>
                    </div>
                    <div class="data-col col-name" title="${item.user.name}\n${item.trx.gateway}\n${item.trx.plan}">
                        <div class="font">
                            <h2 class="b pl wordwrap flex aic">
                                <div class="wordwrap">${item.user.name}</div>
                            </h2>
                            <h2 class="s14 c777 em wordwrap" style="margin-top: 2px;">${item.user.em}</h2>
                        </div>
                    </div>                            
                    <div class="data-col col-stamp">
                        <h2 class="s15 b em wordwrap flex aic">${item.trx.gateway}${item.trx.mode == 'tp' ? `<div class="tp s12 cfff">${item.trx.mode}</div>` : ``}</h2>
                        <h2 class="s14 c777 em wordwrap" style="margin-top: 4px;">&euro;${item.trx.amt}${item.trx.mode == `tp` ? ` &ndash; Trx # ${item.trx.ID}` : ``}</h2>
                    </div>
                    <div class="data-col col-action">
                        <h2 class="s14 c777 em wordwrap">${item.stamp}</h2>
                    </div>
                </div>`
            );
        });
        Pagination(
            App['data'].pagination, 
            $(".payments").attr("data-pgt"),
            function(pgt){
                window.location = `${App.base}am/payments?pgt=${pgt}`;
            }
        );
    }
    $(".payments .cover").fadeOut(200);
}

function saveSettings(){
    var status = $(".site_status").val(),
    title = $(".site_title").val(),
    currency = $(".currency").val(),
    currency_code = $(".currency_code").val(),
    googlega = $(".googlega").val(),
    vmail = $(".verify-mail").val(),
    wmail = $(".welcome-mail").val();

    if(title == ""){
        Toast.show("Enter site title...", 5, 'error')
        $(".site_title").focus();
    }else if(currency == ""){
        Toast.show("Enter currency symbol...", 5, 'error')
        $(".currency").focus();
    }else if(currency_code == ""){
        Toast.show("Enter currency code...", 5, 'error')
        $(".currency_code").focus();
    }else{
        $(".cover").fadeIn(200);
        scrollTo(".acontent", 1000, ".acontent");
        withRest(
            `a/update_settings`,
            {
                status: status,
                title : title,
                cur: currency, cc: currency_code,
                ga: googlega,
                we: wmail,
                ve: vmail
            }
        )
        .then(resp => {
            Toast.show(resp.message || "Settings updated successfully...", 5, 'success')
            $(".cover").fadeOut(200);
        })
        .catch(err => {
            App.debug && console.log(err);
            Toast.show("Changed were not saved.", 5, 'error')
            $(".cover").fadeOut(200);
        });
    }
}

$(document).ready(function(){
    
    if($(".acontent.users").length > 0){
        loadUsers();
        $(document).on("click", ".uform .update_user", UpdateUser);
        $(document).on("keyup", ".search-query", function(e){
            var q = $(this).val();
            query = q;
            var c = e.which || e.keyCode;
            if(c && c == 13 && q != ""){            
                $(".users").attr("data-pgt", 'pg')
                $(".clear-search").show();
                loadUsers();
            }
        });
        $(document).on("click", ".search-unow", function(){
            var q = $(".search-query").val();
            query = q;
            if(q == ""){
                $(".search-query").focus();
            }else{
                $(".users").attr("data-pgt", 'pg')
                $(".clear-search").show();
                loadUsers();
            }
        });
        document.title = `Users`;
    }
    if($(".acontent.payments").length > 0){
        loadPayments();
        $(document).on("click", ".uform .update_user", UpdateUser);
        $(document).on("keyup", ".search-query", function(e){
            var q = $(this).val();
            query = q;
            var c = e.which || e.keyCode;
            if(c && c == 13 && q != ""){            
                $(".users").attr("data-pgt", 'pg')
                $(".clear-search").show();
                loadUsers();
            }
        });
        $(document).on("click", ".search-unow", function(){
            var q = $(".search-query").val();
            query = q;
            if(q == ""){
                $(".search-query").focus();
            }else{
                $(".users").attr("data-pgt", 'pg')
                $(".clear-search").show();
                loadUsers();
            }
        });
        document.title = `Users`;
    }
    if($(".acontent.settings").length > 0){
        $(document).on("click", ".save-settings-cog", saveSettings);
        document.title = `Settings`;
    }
    if($(".acontent.aservers").length > 0){
        if($(".update_server").length > 0){
            if($(".update_server").attr("data-id") != "add"){
                loadServers();
            }
        }else{
            loadServers();
        }
        $(document).on("click", ".uform .update_server", UpdateServer);
        $(document).on("keyup", ".search-query", function(e){
            var q = $(this).val();
            query = q;
            var c = e.which || e.keyCode;
            if(c && c == 13 && q != ""){            
                $(".servers-data").attr("data-pgt", 'pg')
                $(".clear-search").show();
                loadServers();
            }
        });
        $(document).on("click", ".search-unow", function(){
            var q = $(".search-query").val();
            query = q;
            if(q == ""){
                $(".search-query").focus();
            }else{
                $(".servers-data").attr("data-pgt", 'pg')
                $(".clear-search").show();
                loadServers();
            }
        });
        document.title = `Servers`;
    }
    
});