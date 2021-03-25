<?php include_once 'headers/head.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>
<script src="scripts/appsettings.js"></script>

<div class="content-wrapper" ng-controller="AppSetting">
    <section class="content-header">
        <h1>App Settings</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Price</h3>
                    </div>
                    <div ng-show="loader">
                        <br>
                        <center>
                        <img src="dist/img/myloader.gif" width="100px">
                        </center>
                        <br>
                    </div>
                    <form role="form" ng-submit="savePriceSettings()" ng-show="formView" method="post">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Price Under 5KM </label>
                                        <input type="number" class="form-control" placeholder="0"
                                            ng-model="perunder5km">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Price Per KM </label>
                                        <input type="number" class="form-control" placeholder="0" ng-model="perkm">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Referal Point </label>
                                        <input type="number" class="form-control" placeholder="0"
                                            ng-model="referalpoint">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>WhatsApp Number</label>
                                        <input type="text" class="form-control" placeholder="Enter WhatsApp Number"
                                            ng-model="whatsAppNo">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Default WhatsApp Message</label>
                                        <input type="text" class="form-control" placeholder="Enter Default WMessage"
                                            ng-model="DefaultWMessage">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>App Link</label>
                                        <input type="text" class="form-control" placeholder="Enter App Link"
                                            ng-model="AppLink">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Amount To Pay/Km</label>
                                        <input type="text" class="form-control" placeholder="Enter Amount"
                                            ng-model="AmountPayKM">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Delivery Start - Time</label>
                                        <input type="text" class="form-control"
                                            ng-model="FromTime" name="FromTime" placeholder="HH:MM AM|PM">
                                    </div>
                                    <div></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Delivery End - Time</label>
                                        <input type="text" class="form-control"
                                            ng-model="ToTime" name="ToTime" placeholder="HH:MM AM|PM">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Handling Charges</label>
                                        <input type="number" step="any" class="form-control"
                                            ng-model="handling_charges">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Admin Number 1</label>
                                        <input type="text" step="any" class="form-control"
                                            ng-model="AdminMObile1">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Admin Number 2</label>
                                        <input type="text" step="any" class="form-control"
                                            ng-model="AdminMObile2">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Admin Number 3</label>
                                        <input type="text" step="any" class="form-control"
                                            ng-model="AdminMObile3">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Admin Number 4</label>
                                        <input type="text" step="any" class="form-control"
                                            ng-model="AdminMObile4">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Admin Number 5</label>
                                        <input type="text" step="any" class="form-control"
                                            ng-model="AdminMObile5">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Promocode Valid under KM</label>
                                        <input type="number" step="any" class="form-control"
                                            ng-model="NewUserUnderKm">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>New User Price Under 5KM</label>
                                        <input type="number" step="any" class="form-control"
                                            ng-model="NewUserprice">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>More than Given KM -1</label>
                                        <input type="number" step="any" class="form-control"
                                            ng-model="additionalKm">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Addtional Charge Above Given KM</label>
                                        <input type="number" step="any" class="form-control"
                                            ng-model="addKmCharge">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>More than Given KM -2</label>
                                        <input type="number" step="any" class="form-control"
                                            ng-model="additionalKm2">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Addtional Charge Above given KM</label>
                                        <input type="number" step="any" class="form-control"
                                            ng-model="addKmCharge2">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>New User Promocode</label>
                                        <input type="text" class="form-control"
                                            ng-model="newpromocode">
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" name="submit_form" class="btn btn-warning" ng-disabled="btnupdate">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once 'headers/foot.php'; ?>