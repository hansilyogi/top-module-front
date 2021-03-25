<?php include_once 'headers/head.php'; ?>
<script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
<script src= "https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="scripts/vendorupdate.js"></script>

<div class="content-wrapper" ng-controller="vendorupdate">
    <section class="content-header">
        <h1>Vendor Details</h1>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">            
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Charges</h3>
                        </div>            
                        <form role="form">
                            <div class="card-body row">
                                <div class="form-group col-md-12">
                                    <label for="vendorId">Select Vendor</label>
                                    <select class="form-control" ng-model="vendorId" id="vendorId"></select>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Fix KM </label>
                                        <input type="number" class="form-control" placeholder="0"
                                            ng-model="FixKm" id="FixKm">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Price Under Fix KM</label>
                                        <input type="number" class="form-control" placeholder="0"
                                            ng-model="UnderFixKmCharge" id="UnderFixKmCharge">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Per KM Charge</label>
                                        <input type="number" class="form-control" placeholder="0"
                                            ng-model="perKmCharge" id="perKmCharge">
                                    </div>
                                </div>                  
                            </div>                
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="btn-date">Update</button>
                            </div>
                        </form>
                    </div><hr>

                    <div class="table-responsive" style="margin-top:20px;">
                        <div class="card-body row">
                        </div>
                        <table class="mydab table table-bordered bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Fix KM</th>
                                    <th>Price Under Fix KM</th>
                                    <th>Per KM Charge</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="row in vendorList">
                                    <td>{{row.name}}</td>
                                    <td>{{row.FixKm}}</td>
                                    <td>{{row.UnderFixKmCharge}}</td>
                                    <td>{{row.perKmCharge}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once 'headers/foot.php'; ?>