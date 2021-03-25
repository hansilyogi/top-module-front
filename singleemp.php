<?php include_once 'headers/head.php'; ?>
<script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
<script src= "https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="scripts/singleemp.js"></script>

<div class="content-wrapper" ng-controller="Singleemp">
    <section class="content-header">
        <h1>Employee Order History</h1>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">            
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Find History</h3>
                        </div>            
                        <form role="form">
                            <div class="card-body row">
                                <div class="form-group col-md-12">
                                    <label for="courierId">Select Employee</label>
                                    <select class="form-control" ng-model="courierId" id="courierId"></select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="startdate">Start Date</label>
                                    <input type="text" class="form-control" ng-model="startdate" id="startdate">                        
                                </div>                  
                            </div>                
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="btn-date">Submit</button>
                            </div>
                        </form>
                    </div><hr>

                    <div class="table-responsive" style="margin-top:20px;">
                        <div class="card-body row">
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
                                    <label>Total Business - Rs </label>
                                    <input readonly ng-model="Totalamt" id="Totalamt" class="form-control">
                                </div>
                            </div>
                            <!-- <div class="form-group col-md-6">
                                <button style="background-color: lightblue" for="totalamount" id="totalamount"> Total Amount collected - Rs </button>
                                <button style="background-color: lightblue" for="totalkm" id="totalkm"> Total KM Travelled -  </button>
                                <button style="background-color: lightblue" for="totalorder" id="totalorder"> Total Orders -  </button>
                            </div> -->
                        </div>
                        <table class="mydab table table-bordered bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>SR No.</th>
                                    <th>Pickup - Name</th>
                                    <th>Pickup - Address</th>
                                    <th>Delivery - Name</th>
                                    <th>Delivery - Address</th>
                                    <!-- <th>Delivery Distance</th> -->
                                    <!-- <th>Amount</th> -->
                                    <th>Third Party Payement</th>
                                    <!-- <th> Addtional Amount</th> -->
                                    <!-- <th> Discount Amount</th> -->
                                    <th>Final Amount</th>
                                    <!-- <th>Delivery Type</th> -->
                                </tr>
                            </thead>
                            <tbody id="displaydata">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once 'headers/foot.php'; ?>