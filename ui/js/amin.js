function loadUsers(){
    $(".users .cover").fadeIn(200);
    scrollTo("body", 1000, ".app-content");
    var isEdit = window.location.pathname.split("/")[3];
    var query = isEdit == "" || isEdit == undefined ? $(".search-query").val() : isEdit;
    grab(
        `${App.api}a/get_users`,
        {
            edit: isEdit == "" ? 0 : 1,
            query: query,
            queryBy: isEdit != "" && isEdit != undefined ? "ids" : $(".search-filter").val(),
            pgt: $(".users").attr("data-pgt")
        },
        resp => {
            if("kind" in resp){
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
            }else if(resp.reason == "oauth"){
                sessionExpired();
            }else{
                App["data"] = {
                    empty: true,
                    list: []
                }
                RenderUsers();
            }
        },
        err => {
            App.debug && console.log(err);
            App["data"] = {
                empty: true,
                list: []
            }
            RenderUsers();
        }
    );
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
                        <a href="${App.base}cp/users/${item.ID}" class="color noul noulh b">Edit</a>
                    </div>
                </div>`
            );
        });
        Pagination(
            App['data'].pagination, 
            $(".users").attr("data-pgt"),
            function(pgt){
                window.location = `${App.base}cp/users?pgt=${pgt}`;
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
        Toast.show({html: "Select Premium Plan!", time: 5});
    }else if(utype == `pro` && ($(".pro_expiry").datepicker("getDate") == null || $(".pro_expiry").datepicker("getDate").getTime() <= new Date().getTime())){
        Toast.show({html: `Premium expiry should be greater than today's date.`, time: 5});
    }else if(name == ""){
        Toast.show({html: "Enter full name...", time: 5});
    }else if(passw == ""){
        Toast.show({html: "Enter password...", time: 5});
    }else{
        $(".users .cover").fadeIn(200);
        scrollTo(".acontent", 1000, ".acontent");
        grab(
            `${App.api}a/update_user`,
            {
                ID: UID,
                status: status,
                utype: utype, plan: plan, expiry: $(".pro_expiry").datepicker("getDate") ? $(".pro_expiry").datepicker("getDate").getTime() / 1000 : 0,
                name: name, email: email, passw: passw,
                breason: breason
            },
            resp => {
                if("kind" in resp){
                    Toast.show({html: resp.message || "User updated successfully...", time: 5});
                    $(".users .cover").fadeOut(200);
                }else if(resp.reason == "oauth"){
                    sessionExpired();
                }else{
                    Toast.show({html: resp.message || "User was not updated...", time: 5});
                    $(".users .cover").fadeOut(200);
                }
            },
            err => {
                App.debug && console.log(err);
                Toast.show({html: "Changed were not saved.", time: 5});
                $(".users .cover").fadeOut(200);
            }
        );
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
                                <div class="wordwrap">${item.country.name}</div>
                            </h2>                            
                            <h2 class="s14 c777 b em wordwrap" style="margin-top: 4px;">${item.country.region} | ${item.ip}</h2>
                        </div>
                    </div>                            
                    <div class="data-col col-stamp">
                        <div class="font">
                            <h2 class="pl wordwrap flex aic">Lightway UDP: ${item.props.lu} | Lightway TCP: ${item.props.lt}</h2>
                            <h2 class="pl wordwrap flex aic">OpenVPN UDP: ${item.props.ou} | OpenVPN TCP: ${item.props.ot}</h2>
                            <h2 class="pl wordwrap flex aic">IKEV2: ${item.props.ik}</h2>
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
    $(".uform .server_ipaddr").val(u.ip);
    $(".uform .server_country").val(`${u.country.code}@@${u.country.name}@@${u.country.region}`);
    if(u.props.lu == 0){ $(".cb-lu").removeAttr("checked"); }else{ $(".cb-lu").attr("checked", true); }
    if(u.props.lt == 0){ $(".cb-lt").removeAttr("checked"); }else{ $(".cb-lt").attr("checked", true); }
    if(u.props.ou == 0){ $(".cb-ou").removeAttr("checked"); }else{ $(".cb-ou").attr("checked", true); }
    if(u.props.ot == 0){ $(".cb-ot").removeAttr("checked"); }else{ $(".cb-ot").attr("checked", true); }
    if(u.props.ik == 0){ $(".cb-ik").removeAttr("checked"); }else{ $(".cb-ik").attr("checked", true); }
    $(".aservers .cover").fadeOut(200);
}

function UpdateServer(){
    var UID = $(this).attr("data-id"),
    status = $(".uform .server_status").val(),
    ip = $(".uform .server_ipaddr").val(),
    ctry = $(".uform .server_country").val(),
    lu = $(".cb-lu").is(":checked") ? 1 : 0,
    lt = $(".cb-lt").is(":checked") ? 1 : 0,
    ou = $(".cb-ou").is(":checked") ? 1 : 0,
    ot = $(".cb-ot").is(":checked") ? 1 : 0,
    ik = $(".cb-ik").is(":checked") ? 1 : 0;

    if(ip == ""){
        Toast.show({html: "Enter Server IP Address", time: 5});
        $(".server_ipaddr").focus();
    }else if(ctry == "-1"){
        Toast.show({html: "Choose Country", time: 5});
    }else{
        $(".aservers .cover").fadeIn(200);
        scrollTo(".acontent", 1000, ".acontent");
        grab(
            `${App.api}a/save_server`,
            {
                ID: UID,
                status: status,
                ip: ip, ctry: ctry,
                lu: lu, lt: lt, ou: ou, ot: ot, ik: ik
            },
            resp => {
                if("kind" in resp){
                    Toast.show({html: resp.message || "Server saved successfully...", time: 5});
                    $(".aservers .cover").fadeOut(200);
                    if(UID == 'add'){
                        window.location = `${App.base}cp/servers`;
                    }
                }else if(resp.reason == "oauth"){
                    sessionExpired();
                }else{
                    Toast.show({html: resp.message || "Server was not updated...", time: 5});
                    $(".aservers .cover").fadeOut(200);
                }
            },
            err => {
                App.debug && console.log(err);
                Toast.show({html: "Changed were not saved.", time: 5});
                $(".aservers .cover").fadeOut(200);
            }
        );
    }
}


function loadPayments(){
    $(".cover").fadeIn(200);
    grab(
        `${App.api}a/get_payments`,
        {
            query: $(".search-query").val(),
            queryBy: $(".search-filter").val(),
            pgt: $(".payments").attr("data-pgt")
        },
        resp => {
            if("kind" in resp){
                App["data"] = {
                    empty: false,
                    list: resp.list,
                    pagination: resp.pages
                }
                RenderPayments();
            }else if(resp.reason == "oauth"){
                sessionExpired();
            }else{
                App["data"] = {
                    empty: true,
                    list: []
                }
                RenderPayments();
            }
        },
        err => {
            App.debug && console.log(err);
            App["data"] = {
                empty: true,
                list: []
            }
            RenderPayments();
        }
    );
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
                        <h2 class="s15 b em wordwrap">${item.trx.gateway}</h2>
                        <h2 class="s14 c777 em wordwrap" style="margin-top: 4px;">&euro;${item.trx.amt}</h2>
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
                window.location = `${App.base}cp/payments?pgt=${pgt}`;
            }
        );
    }
    $(".payments .cover").fadeOut(200);
}

function saveSettings(){
    var title = $(".site_title").val(),
    googlega = $(".googlega").val();

    if(title == ""){
        Toast.show({html: "Enter site title...", time: 5});
        $(".site_title").focus();
    }else{
        $(".cover").fadeIn(200);
        scrollTo(".acontent", 1000, ".acontent");
        grab(
            `${App.api}a/update_settings`,
            {
                title : title,
                ga: googlega
            },
            resp => {
                if("kind" in resp){
                    Toast.show({html: resp.message || "Settings updated successfully...", time: 5});
                    $(".cover").fadeOut(200);
                }else if(resp.reason == "oauth"){
                    sessionExpired();
                }else{
                    Toast.show({html: resp.message || "Settings not updated...", time: 5});
                    $(".cover").fadeOut(200);
                }
            },
            err => {
                App.debug && console.log(err);
                Toast.show({html: "Changed were not saved.", time: 5});
                $(".cover").fadeOut(200);
            }
        );
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