<?php include_once 'headers/head.php'; ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCW-CryHApwFarrX9piqmNKo-E_ZxAlYJU&libraries=geometry">
</script>
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="scripts/extrakms.js"></script>

<div class="content-wrapper" ng-controller="ExtraKms">
    <section class="content-header">
        <h1>Extra kilometers travelled by delivery boys</h1>
        <small>Here you can find, how much kilometer travelled by delivery boys using date filter.</small>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

            

            <div ng-show="loader">
                                    <br>
                                    <center>
                                    <img src="dist/img/myloader.gif" width="500px">
                                    </center>
                                    <br>
                                </div>
                <div class="box" ng-show="tabdata">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> From Date</label>
                                    <input type="date" class="form-control" ng-model="fromDate">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> To Date</label>
                                    <input type="date" class="form-control" ng-model="toDate">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>&nbsp;</label><br>
                                    <input type="button" value="Search" class="btn btn-primary btn-block" ng-click="SearchData()"/>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>&nbsp;</label><br>
                                    <input type="button" value="Show Todays" class="btn btn-primary btn-block" ng-click="getDefaultKilometer()"/>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive" style="margin-top:20px;" >
                            <table class="mydab table table-bordered bordered table-striped table-condensed" datatable="ng" dt-options="vm.dtOptions">
                                <thead>
                                    <tr>
                                        <th>Employee Name</th>
                                        <th>Total Orders</th>
                                        <th>P-D Kilometers</th>
                                        <th>Extra Kilometers</th>
                                        <th>Total Kilometers</th>
                                        <th>Company Earnings</th>
                                        <th>Amount To Pay</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="data in FullData">
                                        <td>{{data.name}}</td>
                                        <td><a href="#" ng-click="showOrders(data.name)">{{data.orderdata.length}}</a></td>
                                        <td>{{data.orderkm}} km</td>
                                        <td>{{data.extrakm}} km</td>
                                        <td>{{data.totaldist}} km</td>
                                        <td>₹{{data.totalearning}}</td>
                                        <td>₹{{data.amttopay}}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" title="Orders List">
                                                <i class="fas fa-list"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.col -->
        </div>


    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><b>Order Details</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" ng-repeat="OrderDetails in orderdata">
                                    <tr>
                                        <td colspan="3"><b>Date Time: </b> &nbsp;&nbsp;&nbsp;{{OrderDetails.orderData.orderNo}} &nbsp; [ {{OrderDetails.orderData.dateTime | date:"MM/dd/yyyy"}}
                                                {{OrderDetails.orderData.dateTime | date:"h:mma"}} ]</td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2">
                                            <div><b>Extra KM: </b> {{OrderDetails.extratime}} KM</div>
                                            <div><a target="_blank" href="https://www.google.com/maps/dir/{{OrderDetails.extrakm.start.latitude}},{{OrderDetails.extrakm.start.longitude}}/{{OrderDetails.extrakm.end.latitude}},{{OrderDetails.extrakm.end.longitude}}/@21.0464464,72.5496674,10.71z"> Show In Map</a></div>
                                        </td>
                                        <td>
                                            <b>Pickup Point</b><br>
                                            <div>{{OrderDetails.orderData.pickupPoint.completeAddress}},</div>
                                            <div>{{OrderDetails.orderData.pickupPoint.address}}</div>
                                        </td>
                                        <td>
                                            <b>Delivery Point</b><br>
                                            <div>{{OrderDetails.orderData.deliveryPoint.completeAddress}},</div>
                                            <div>{{OrderDetails.orderData.deliveryPoint.address}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div><b>PicknDelivery Distance: </b> {{OrderDetails.orderData.deliveryPoint.distance}} KM, &nbsp;<a target="_blank" href="https://www.google.com/maps/dir/{{OrderDetails.orderData.pickupPoint.lat}},{{OrderDetails.orderData.pickupPoint.long}}/{{OrderDetails.orderData.deliveryPoint.lat}},{{OrderDetails.orderData.deliveryPoint.long}}/@21.0464464,72.5496674,10.71z"> Show In Map</a></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><b>Net. Amount</b>: ₹<i>{{OrderDetails.orderData.finalAmount}}</i></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    </section>
</div>

<?php include_once 'headers/foot.php'; ?>