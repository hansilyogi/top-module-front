<?php include_once 'headers/head.php'; ?>
<script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
<script src= "https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="scripts/balance.js"></script>

<div class="content-wrapper" ng-controller="Balance">
    <section class="content-header">
        <h1>Employee Order History</h1>
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
                                    <label for="startdate">Enter Date</label>
                                    <input type="text" class="form-control" ng-model="startdate" id="startdate">                        
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
                                <label>Employee Name -  </label>
                                <input style="color: red" readonly ng-model="maxname" id="maxname" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Maximum Amount collected - Rs </label>
                                <input readonly ng-model="maxprice" id="maxprice" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> Total Amount collected - Rs </label>
                                <input readonly ng-model="Totalamtcoll" id="Totalamtcoll" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Total Third Party collected - Rs </label>
                                <input readonly ng-model="Totalthird" id="Totalthird" class="form-control">
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
                                <label>Total Business - Rs </label>
                                <input readonly ng-model="Totalamt" id="Totalamt" class="form-control">
                            </div>
                        </div>
                        <div class="card-body row">
                        </div>
                        <table class="mydab table table-bordered bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>SR No. </th>
                                    <th>Employee Name</th>
                                    <th>Amount Collected</th>
                                    <th>Third Party Collection</th>
                                    <th>Total Delivery</th>
                                    <th>Total Distance</th>
                                    <th>Total Business</th>
                                    <th>Action</th>
                                    <!-- <th>Delivery Type</th> -->
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