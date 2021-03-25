<?php include_once 'headers/head.php'; ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCW-CryHApwFarrX9piqmNKo-E_ZxAlYJU&libraries=geometry">
</script>
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="scripts/extrakilometer.js"></script>

<div class="content-wrapper" ng-controller="ExtraKilometer">
    <section class="content-header">
        <h1>Extra kilometers travelled by delivery boys</h1>
        <small>Here you can find, how much kilometer travelled by delivery boys using date filter.</small>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <div class="row" style="margin-top:20px;">
                            <form ng-submit="filterData()">
                                <div class="col-md-4 col-md-offset-1">
                                    <div class="form-group">
                                        <label>From</label>
                                        <input type="date" class="form-control" ng-model="FromDate" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>To</label>
                                        <input type="date" class="form-control" ng-model="ToDate" required>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" style="margin-top:25px;"><i
                                                class="fa fa-search"></i> Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive" style="margin-top:20px;">
                            <div ng-show="loader">
                                <br>
                                <center>
                                    <img src="dist/img/pulse.svg" width="100px">
                                    <div><b>Please wait...</b></div>
                                </center>
                                <br>
                            </div>
                            <table class="mydab table table-bordered bordered table-striped table-condensed"
                                datatable="ng" dt-options="vm.dtOptions">
                                <thead>
                                    <tr>
                                        <th>Srno</th>
                                        <th>Delivery Boy ID</th>
                                        <th>Order No</th>
                                        <th>Extra KM</th>
                                        <th>Travel P-D KM</th>
                                        <th>Total KM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="k in Kilometers">
                                        <td>{{$index+1}}</td>
                                        <td>
                                            <a href="#" ng-click="findCourier(k.courierId,k.orderId)"
                                                title="Click to view delivery boy details">{{k.courierNo}}</a>
                                        </td>
                                        <td><a href="#" ng-click="findOrder(k.orderId,k.orderNo)"
                                                title="Click to view order details">{{k.orderNo}}</a></td>
                                        <td>{{k.extraKM}}</td>
                                        <td>{{k.travelKM}}</td>
                                        <td>{{k.total}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.col -->
        </div>
    </section>


    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><b>{{orderModelId}}</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <td>
                                            <b>Pickup Point</b><br>
                                            <div>{{OrderDetails[0].pickupPoint.name}},</div>
                                            <div>{{OrderDetails[0].pickupPoint.mobileNo}},</div>
                                            <div>{{OrderDetails[0].pickupPoint.completeAddress}},</div>
                                            <div>{{OrderDetails[0].pickupPoint.address}}</div>
                                        </td>
                                        <td>
                                            <b>Delivery Point</b><br>
                                            <div>{{OrderDetails[0].deliveryPoint.name}},</div>
                                            <div>{{OrderDetails[0].deliveryPoint.mobileNo}},</div>
                                            <div>{{OrderDetails[0].deliveryPoint.completeAddress}},</div>
                                            <div>{{OrderDetails[0].deliveryPoint.address}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Arrive Time</b><br>
                                            {{OrderDetails[0].pickupPoint.arriveTime}}
                                            {{OrderDetails[0].pickupPoint.arriveType=='rightnow'?'Current':'Scheduled'}}
                                        </td>
                                        <td>
                                            <b>Parcel Contents</b><br>
                                            {{OrderDetails[0].pickupPoint.contents}}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div><b>Total</b>: <i>{{OrderDetails[0].amount}}</i></div>
                                            <div><b>Discount %</b>: <i>{{OrderDetails[0].discount}}</i></div>
                                            <div><b>Add. Amount</b>: <i>{{OrderDetails[0].additionalAmount}}</i></div>
                                            <div><b>Net. Amount</b>: <i>{{OrderDetails[0].finalAmount}}</i></div>
                                        </td>
                                        <td>
                                            <div><b>Collect Cash</b>: {{OrderDetails[0].collectCash}}</div>
                                            <div><b>Status</b>: {{OrderDetails[0].isActive?'Active':'Not Active'}}</div>
                                            <div><b>Note</b>: {{OrderDetails[0].note}}</div>
                                            <div><b>Date</b>: {{OrderDetails[0].dateTime | date:"MM/dd/yyyy"}}
                                                {{OrderDetails[0].dateTime | date:"h:mma"}}</div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="courierModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><b>Delivery Boy</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Details</th>
                                            <th>Profile</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="row in Courier">
                                            <td>
                                                <div><b>Fullname</b>: {{row.firstName}} {{row.lastName}}</div>
                                                <div style="margin-top:5px;"><b>Mobile No</b>: {{row.mobileNo}}</div>
                                                <div style="margin-top:5px;"><b>Vehicle Type</b>:
                                                    {{row.transport.vehicleType == null || row.transport.vehicleType==""?'Not Available':row.transport.vehicleType}}
                                                </div>
                                                <div style="margin-top:5px;"><b>Vehicle No</b>:
                                                    {{row.transport.vehicleNo == null || row.transport.vehicleNo==""?'Not Available':row.transport.vehicleNo}}
                                                </div>
                                                <div style="margin-top:5px;"><b>Approval Status</b>:
                                                    {{row.accStatus.flag == true?'Approved':'Not Approved'}}</div>
                                                <div style="margin-top:5px;"><b>Account Status</b>:
                                                    {{row.isActive == true?'Active':'Not Active'}}</div>
                                            </td>
                                            <td>
                                                <div>
                                                    <div style="background:url('{{url}}{{row.profileImg}}')"
                                                        width="100px" height="100px">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>


<?php include_once 'headers/foot.php'; ?>