var lkb = {

    env : 'prod', // stagging , prod

    apiUrl : function(){
        var self = this ;
        switch (self.env) {
            case "dev":
                return "http://69.64.42.131:8889";
                break;
            case "stagging":
                return "https://api.dev.legendary.com";
                break;
            case "prod":
                return "https://api.legendary.com";
                break;
            default:
                return "http://69.64.42.131:8889";
        }
    },

    xhrCall : function(method,url,calbackXhr,requestHeader,postData){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var remoteData = JSON.parse(this.responseText);
                calbackXhr(remoteData);
            }
        };
        xhttp.open(method,url, true);
        if(method == 'GET' && requestHeader == null  && postData == null){
            xhttp.send();
        }
        if(method == 'POST' && requestHeader != null  && postData != null){
            requestHeader(xhttp);
            xhttp.send(postData);
        }
    },

    makeLogin : function(){
        var self = this ;
        var user_email = document.getElementById('user_login_email').value ;
        var user_pass = document.getElementById('user_login_pass').value ;
        if(user_email == "" || user_pass == ""){
            document.getElementById('login_validation').innerHTML = "All fields must be filled";
            return ;
        }
        self.xhrCall("GET",self.apiUrl() + "/user/myProfile?_csrf=false&site=nerdist&connect.sid=false&_csrf=false",function(data){
            if(data.error == 'No user specified' && data.status == 'error'){
                var connectId = data["connect.sid"];
                var csrf = data["csrf"];
                //console.log(data);
                self.xhrCall("POST",self.apiUrl() + "/user/login?site=svod_prod",function(dataRecieved){

                    if(dataRecieved.error == null){
                        console.log(dataRecieved);
                        document.getElementById('keystone_login_form').submit();
                    }else{
                        document.getElementById('login_validation').innerHTML = dataRecieved.error;
                    }
                },function(xhttp){
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.setRequestHeader("xsrf-token", csrf);
                    xhttp.setRequestHeader("connect.sid", connectId);
                },"email="+ user_email +"&password="+ user_pass +"&_csrf="+ csrf);
            }
        },null,null);
    },

    makeRegistration : function(){
        var self = this ;
        var user_name = document.getElementById('log').value ;
        var user_pass = document.getElementById('pwd').value ;
        var user_email = document.getElementById('user_email').value ;
        var user_firstname = document.getElementById('user_firstname').value ;
        var user_lastname = document.getElementById('user_lastname').value ;
        var user_pass_confirm = document.getElementById('user_pass_confirm').value ;

        if(user_name == "" || user_pass == ""  || user_pass_confirm == "" || user_email == "" || user_firstname == "" || user_lastname == ""){
            document.getElementById('registration_validation').innerHTML = "Please fill all the field";
            return ;
        }
        if(user_pass_confirm != user_pass){
            document.getElementById('registration_validation').innerHTML = "Password & confirm password field didn't match";
            return ;
        }
        self.xhrCall("GET",self.apiUrl() + "/user/myProfile?site=svod_prod&_csrf=false",function(data){
            if(data.error == 'No user specified' && data.status == 'error'){
                var connectId = data["connect.sid"];
                var csrf = data["csrf"];
                self.xhrCall("POST",self.apiUrl()+ "/user/signup?site=svod_prod",function(dataRecieved){
                    if(dataRecieved.error == null){
                        document.getElementById('keystone_registration_form').submit();
                    }else{
                        var vlText = "<p>";
                        for (var key in dataRecieved.messages) {
                            var obj = dataRecieved.messages[key];
                            for(i=0; i < obj.length;i++){
                                vlText += obj[i] + "<br>" ;
                            }
                        }
                        vlText += "</p>";
                        document.getElementById('registration_validation').innerHTML = vlText;
                    }
                },function(xhttp){
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.setRequestHeader("xsrf-token", csrf);
                    xhttp.setRequestHeader("connect.sid", connectId);
                },"email="+ user_email +"&password="+ user_pass +"&confirmPassword="+ user_pass_confirm  +"&userName="+ user_name +"&firstName="+ user_firstname +"&lastName="+ user_lastname +"&_csrf="+ csrf);
            }
        },null,null);
    },
}
