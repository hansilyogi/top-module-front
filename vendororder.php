<?php include_once 'headers/head.php'; ?>
<script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
<script src= "https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="scripts/vendororder.js"></script>

<div class="content-wrapper" ng-controller="Vendororder">
    <section class="content-header">
        <h1>Vendor Order History</h1>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">            
                <div class="col-md-12">
                    <div class="card card-primary">
                        <!-- <div class="card-header">
                            <h3 class="card-title">Find History</h3>
                        </div>     -->
                        <form role="form">
                            <div class="card-body row">
                                <div class="form-group col-md-3">
                                    <label for="ofDate">Enter Date</label>
                                    <input type="text" class="form-control" ng-model="ofDate" id="ofDate">                        
                                </div>            
                            </div>         
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="btn-search-date">Submit</button>
                            </div>
                        </form>
                    </div><hr>

                    <div class="table-responsive" style="margin-top:20px;">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> Total Amount PND collected - Rs </label>
                                <input readonly ng-model="Totalamtcoll" id="Totalamtcoll" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Total Courier Charge - Rs </label>
                                <input readonly ng-model="Totalcouriercharge" id="Totalcouriercharge" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> Total Orders -  </label>
                                <input readonly ng-model="Totaldel" id="Totaldel" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Total KM Travelled - </label>
                                <input readonly ng-model="Totaldis" id="Totaldis" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Total Vendor Bill - Rs </label>
                                <input readonly ng-model="Totalvendorbill" id="Totalvendorbill" class="form-control">
                            </div>
                        </div>
                        <div class="card-body row">
                        </div>
                        <table class="mydab table table-bordered bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>Vendor Name</th>
                                    <th>Delivery Name</th>
                                    <th>Distance</th>
                                    <th>Amount Collected</th>
                                    <th>Courier Charge</th>
                                    <th>Courier Charge Paid By</th>
                                    <th>Vendor Bill</th>
                                </tr>
                            </thead>
                            <tbody id="displaydata">
                            </tbody>
                        </table>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once 'headers/foot.php'; ?>