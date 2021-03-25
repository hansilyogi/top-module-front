<?php include_once 'headers/head.php'; ?>
<script src="scripts/accountsettings.js"></script>

<div class="content-wrapper" ng-controller="AccountSetting">
    <section class="content-header">
        <h1>Account Settings</h1>
        <small>Here you can change your account password.</small>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Account Settings</h3>
                    </div>
                    <form role="form" ng-submit="SaveAccountSettings()">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Account Name </label>
                                                <input type="text" class="form-control" placeholder="Ex: John Doe" ng-model="accountname">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Old Password </label>
                                                <input type="password" class="form-control" placeholder="Enter your old password" ng-model="oldpassword">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>New Password </label>
                                                <input type="password" class="form-control" placeholder="Enter your new password" ng-model="newpassword">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" ng-disabled="btnsave">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once 'headers/foot.php'; ?>