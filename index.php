<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>PicknDelivere</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.0.0/ui-bootstrap-tpls.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-utils/0.1.1/angular-ui-utils.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/angular-datatables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script src="scripts/constants.js"></script>
    <script src="scripts/login.js"></script>
</head>

<body class="login-page" ng-app="AppModule" style="font-family: 'Open Sans', sans-serif;">
    <div class="login-box" ng-controller="Login">
        <div class="login-logo">
            <img src="dist/img/logo.png" width="200px">
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <div ng-show="loader">
                <center>
                    <img src="dist/img/pulse.svg" width="50px">
                </center>
            </div>
            <p class="login-box-msg" ng-style="errstyle" ng-show="errscr">{{errmsg}}</p>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Mobile Number" ng-model="mobileNo" />
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" ng-model="password" />
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <button type="button" class="btn btn-primary btn-block btn-flat" ng-click="loginSystem()"
                        ng-disabled="btndis">LOGIN</button>
                </div>
            </div>
        </div>
    </div>

    <script src="plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <script src="dist/js/jquery.cookie.js"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script src="scripts/constants.js"></script>
    <script src="scripts/login.js"></script>
    <script>
    $(function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%'
        });
    });
    </script>
</body>

</html>