<?php
    include_once 'headers/head.php';
?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCW-CryHApwFarrX9piqmNKo-E_ZxAlYJU"></script>
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="scripts/multiple_order.js"></script>
<head>
<style>
    ::ng-deep .highlight{
    color: white;
    background: #673AB7;
  }
  .delivery {
      /* background: red; */
      color: red;
  }
  .express{
      /* background : green; */
      color: green;
  }
  .schedule{
      color : blue;
  }

</style>
</head>
<div class="content-wrapper" ng-controller="multiple_order">
    <section class="content-header">
        <h1>
            Multiple Orders
        </h1>
        <!-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol> -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom" ng-hide="tabdata">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right ui-sortable-handle">
                        <li class="" id="multicancelledorders"><a href="#cancelled" data-toggle="tab" aria-expanded="false">Cancelled Orders
                            &nbsp;<span class="label label-primary">{{totalcancelled}}</span></a></li>
                        <li class=""><a href="#pendingorders" data-toggle="tab" aria-expanded="true">Pending
                                Delivery &nbsp;<span class="label label-danger">{{totalpendingOrders}}</span></a></li>
                        <li class="active"><a href="#runningorders" data-toggle="tab" aria-expanded="true">Running
                                Orders &nbsp;<span class="label label-success">{{totalrunningOrders}}</span></a></li>
                        <li class="pull-left header"><i class="fa fa-history"></i> Pending Orders</li>
                    </ul>
                    <div class="tab-content no-padding">
                        <div class="chart tab-pane active" id="runningorders">
                            <div class="box-body table-responsive" style="margin-top:10px;">
                                <table class="table table-bordered bordered table-striped table-condensed"
                                    datatable="ng" dt-options="vm.dtOptions">
                                    <thead>
                                        <tr>
                                            <th width="3%">SR</th>
                                            <th>OrderNo / Date</th>
                                            <th>Pickup</th>
                                            <th>Drop</th>
                                            <th>Order Details</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody align="left">
                                        <tr ng-repeat="row in RunningOrders | orderBy:'-dateTime'">
                                            <td>{{$index+1}}</td>
                                            <td>
                                                <div><b>{{row[0].orderNo}}</b></div>
                                                <div>{{row[0].dateTime | date:"MM/dd/yyyy"}}</div>
                                                <div>{{row[0].dateTime | date:"h:mma"}}</div>
                                                <div class="delivery"><b>{{row[0].deliveryType == 'Express Delivery' ? 'Express Delivery' : ''}}</b></div>
                                                <div class="express"><b>{{row[0].deliveryType == 'Normal Delivery' ? 'Normal Delivery' : ''}}</b></div>
                                                <div class="schedule">{{row[0].schedualDateTimelength != 0 ? row.schedualDateTime : ''}}</div>
                                                <div class="schedule">{{row[0].scheduleDate != '' ? row[0].scheduleDate : ''}}</div>
                                                <div class="schedule">{{row[0].scheduleTime != '' ? row[0].scheduleTime : ''}}</div>
                                            </td>
                                            <td>
                                                <b>{{row[0].pickupPoint.name}}</b>
                                                <div>&nbsp;{{row[0].pickupPoint.mobileNo}},
                                                    <div>
                                                        <div>&nbsp;{{row[0].pickupPoint.completeAddress}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span ng-repeat="rol in row | orderBy:'-dateTime'">
                                                    <div><b>&nbsp;{{rol.multiOrderNo}},</b></div>
                                                    <b>{{rol.deliveryPoint.name}}</b>,<br>
                                                    <div>&nbsp;{{rol.deliveryPoint.mobileNo}},</div>
                                                    <div>&nbsp;{{rol.deliveryPoint.completeAddress}}</div>
                                                    <div>&nbsp;<i>Total Distance : {{rol.deliveryPoint.distance}}</i></div><br><br>
                                                </span>
                                            </td>
                                            <td>
                                                <div><b>Collect Cash</b>: {{row[0].collectCash}}
                                                </div>
                                                <div><b>Status</b>: {{row[0].isActive?'Active':'Not Active'}}
                                                </div>
                                                <div><b>Note</b>: <i>{{row[0].note}}</i>
                                                </div>
                                                <div><b>DeliveryBoy</b>: <i>
                                                        {{row[0].courierId.length==0?'Not Assigned':row[0].courierId.firstName}}
                                                        {{row[0].courierId.length!=0?row[0].courierId.lastName:""}}
                                                    </i>
                                                </div>
                                            </td>
                                            <td>
                                                <span ng-repeat="rol in row | orderBy:'-dateTime'">
                                                    <div><b>Total</b>: <i>{{rol.amount}}</i>
                                                    </div>
                                                    <div><b>Discount %</b>: <i>{{rol.discount}}</i>
                                                    </div>
                                                    <div><b>Handling Charges</b>: <i>{{rol.finalAmount - rol.amount - additionalAmount}}</i>
                                                    </div>
                                                    <div><b>Add. Amount</b>: <i>{{rol.additionalAmount}}</i>
                                                    </div>
                                                    <div><b>Net. Amount</b>: <i>{{rol.finalAmount}}</i>
                                                    </div>
                                                    <div><b>Third Party Payement</b>: <i>Rs- {{rol.amountCollection}}</i><br><br>
                                                    </div>
                                                </span>
                                            </td>
                                            <td>
                                                <button class="btn btn-info btn-sm" title="Assign To Delivery Boy"
                                                    ng-click="AssignPoup(row[0]._id,row[0].orderNo)"><i
                                                        class="fa fa-list"></i></button>
                                                <button class="btn btn-danger btn-sm" title="Cancel Order" ng-click="CancelOrder(row._id)"><i
                                                        class="fa fa-close"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="chart tab-pane" id="pendingorders">
                            <div class="box-body table-responsive" style="margin-top:10px;">
                                <table class="table table-bordered bordered table-striped table-condensed"
                                    datatable="ng" dt-options="vm.dtOptions">
                                    <thead>
                                        <tr>
                                            <th width="3%">SR</th>
                                            <th>OrderNo / Date</th>
                                            <th>Pickup</th>
                                            <th>Drop</th>
                                            <th>Order Details</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody align="left">
                                        <tr ng-repeat="row in PendingOrders | orderBy:'-dateTime'">
                                            <td>{{$index+1}}</td>
                                            <td>
                                                <div><b>{{row[0].orderNo}}</b></div>
                                                <div>{{row[0].dateTime | date:"MM/dd/yyyy"}}</div>
                                                <div>{{row[0].dateTime | date:"h:mma"}}</div>
                                                <div class="delivery"><b>{{row[0].deliveryType == 'Express Delivery' ? 'Express Delivery' : ''}}</b></div>
                                                <div class="express"><b>{{row[0].deliveryType == 'Normal Delivery' ? 'Normal Delivery' : ''}}</b></div>
                                                <div class="schedule">{{row[0].schedualDateTimelength != 0 ? row.schedualDateTime : ''}}</div>
                                                <div class="schedule">{{row[0].scheduleDate != '' ? row[0].scheduleDate : ''}}</div>
                                                <div class="schedule">{{row[0].scheduleTime != '' ? row[0].scheduleTime : ''}}</div>
                                            </td>
                                            <td>
                                                <b>{{row[0].pickupPoint.name}}</b>
                                                <div>&nbsp;{{row[0].pickupPoint.mobileNo}},
                                                    <div>
                                                        <div>&nbsp;{{row[0].pickupPoint.completeAddress}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span ng-repeat="rol in row | orderBy:'-dateTime'">
                                                    <div><b>&nbsp;{{rol.multiOrderNo}},</b></div>
                                                    <b>{{rol.deliveryPoint.name}}</b>,<br>
                                                    <div>&nbsp;{{rol.deliveryPoint.mobileNo}},</div>
                                                    <div>&nbsp;{{rol.deliveryPoint.completeAddress}}</div>
                                                    <div>&nbsp;<i>Total Distance : {{rol.deliveryPoint.distance}}</i></div><br><br>
                                                </span>
                                            </td>
                                            <td>
                                                <div><b>Collect Cash</b>: {{row[0].collectCash}}
                                                </div>
                                                <div><b>Status</b>: {{row[0].isActive?'Active':'Not Active'}}
                                                </div>
                                                <div><b>Note</b>: <i>{{row[0].note}}</i>
                                                </div>
                                                <div><b>DeliveryBoy</b>: <i>
                                                        {{row[0].courierId.length==0?'Not Assigned':row[0].courierId.firstName}}
                                                        {{row[0].courierId.length!=0?row[0].courierId.lastName:""}}
                                                    </i>
                                                </div>
                                            </td>
                                            <td>
                                                <span ng-repeat="rol in row | orderBy:'-dateTime'">
                                                    <div><b>Total</b>: <i>{{rol.amount}}</i>
                                                    </div>
                                                    <div><b>Discount %</b>: <i>{{rol.discount}}</i>
                                                    </div>
                                                    <div><b>Handling Charges</b>: <i>{{rol.finalAmount - rol.amount - additionalAmount}}</i>
                                                    </div>
                                                    <div><b>Add. Amount</b>: <i>{{rol.additionalAmount}}</i>
                                                    </div>
                                                    <div><b>Net. Amount</b>: <i>{{rol.finalAmount}}</i>
                                                    </div>
                                                    <div><b>Third Party Payement</b>: <i>Rs- {{rol.amountCollection}}</i><br><br>
                                                    </div>
                                                </span>
                                            </td>
                                            <td>
                                                <button class="btn btn-info btn-sm" title="Assign To Delivery Boy"
                                                    ng-click="AssignPoup(row[0]._id,row[0].orderNo)"><i
                                                        class="fa fa-list"></i></button>
                                                <button class="btn btn-danger btn-sm" title="Cancel Order" ng-click="CancelOrder(row._id)"><i
                                                        class="fa fa-close"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="chart tab-pane" id="cancelled">
                            <div class="box-body table-responsive" style="margin-top:10px;">
                                <table class="table table-bordered bordered table-striped table-condensed"
                                    datatable="ng" dt-options="vm.dtOptions">
                                    <thead>
                                        <tr>
                                            <th width="3%">SR</th>
                                            <th>OrderNo / Date</th>
                                            <th>Pickup</th>
                                            <th>Drop</th>
                                            <th>Order Details</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody align="left">
                                        <tr ng-repeat="row in cancelledOrders | orderBy:'-dateTime'">
                                            <td>{{$index+1}}</td>
                                            <td>
                                                <div><b>{{row[0].orderNo}}</b></div>
                                                <div>{{row[0].dateTime | date:"MM/dd/yyyy"}}</div>
                                                <div>{{row[0].dateTime | date:"h:mma"}}</div>
                                                <div class="delivery"><b>{{row[0].deliveryType == 'Express Delivery' ? 'Express Delivery' : ''}}</b></div>
                                                <div class="express"><b>{{row[0].deliveryType == 'Normal Delivery' ? 'Normal Delivery' : ''}}</b></div>
                                                <div class="schedule">{{row[0].schedualDateTimelength != 0 ? row.schedualDateTime : ''}}</div>
                                                <div class="schedule">{{row[0].scheduleDate != '' ? row[0].scheduleDate : ''}}</div>
                                                <div class="schedule">{{row[0].scheduleTime != '' ? row[0].scheduleTime : ''}}</div>
                                            </td>
                                            <td>
                                                <b>{{row[0].pickupPoint.name}}</b>
                                                <div>&nbsp;{{row[0].pickupPoint.mobileNo}},
                                                    <div>
                                                        <div>&nbsp;{{row[0].pickupPoint.completeAddress}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span ng-repeat="rol in row | orderBy:'-dateTime'">
                                                    <div><b>&nbsp;{{rol.multiOrderNo}},</b></div>
                                                    <b>{{rol.deliveryPoint.name}}</b>,<br>
                                                    <div>&nbsp;{{rol.deliveryPoint.mobileNo}},</div>
                                                    <div>&nbsp;{{rol.deliveryPoint.completeAddress}}</div>
                                                    <div>&nbsp;<i>Total Distance : {{rol.deliveryPoint.distance}}</i></div><br><br>
                                                </span>
                                            </td>
                                            <td>
                                                <div><b>Collect Cash</b>: {{row[0].collectCash}}
                                                </div>
                                                <div><b>Status</b>: {{row[0].isActive?'Active':'Not Active'}}
                                                </div>
                                                <div><b>Note</b>: <i>{{row[0].note}}</i>
                                                </div>
                                                <div><b>DeliveryBoy</b>: <i>
                                                        {{row[0].courierId.length==0?'Not Assigned':row[0].courierId.firstName}}
                                                        {{row[0].courierId.length!=0?row[0].courierId.lastName:""}}
                                                    </i>
                                                </div>
                                            </td>
                                            <td>
                                                <span ng-repeat="rol in row | orderBy:'-dateTime'">
                                                    <div><b>Total</b>: <i>{{rol.amount}}</i>
                                                    </div>
                                                    <div><b>Discount %</b>: <i>{{rol.discount}}</i>
                                                    </div>
                                                    <div><b>Handling Charges</b>: <i>{{rol.finalAmount - rol.amount - additionalAmount}}</i>
                                                    </div>
                                                    <div><b>Add. Amount</b>: <i>{{rol.additionalAmount}}</i>
                                                    </div>
                                                    <div><b>Net. Amount</b>: <i>{{rol.finalAmount}}</i>
                                                    </div>
                                                    <div><b>Third Party Payement</b>: <i>Rs- {{rol.amountCollection}}</i><br><br>
                                                    </div>
                                                </span>
                                            </td>
                                            <td>
                                                <button class="btn btn-info btn-sm" title="Assign To Delivery Boy"
                                                    ng-click="AssignPoup(row[0]._id,row[0].orderNo)"><i
                                                        class="fa fa-list"></i></button>
                                                <button class="btn btn-danger btn-sm" title="Cancel Order" ng-click="CancelOrder(row._id)"><i
                                                        class="fa fa-close"></i></button>
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
    </section>

    <div class="modal fade" id="NewOrder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><b>{{orderNo}}</b></h4>
                </div>
                <div class="modal-body">
                    <form ng-submit="AssignOrderTODB()">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Hello</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Assign"></div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>



    <div class="modal fade" id="AssignOrders" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><b>{{orderNo}}</b></h4>
                </div>
                <div class="modal-body">
                    <form ng-submit="AssignOrderTODB()">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>SELECT DELIVERY BOY </label> : &nbsp;<button class="btn btn-default btn-xs"
                                        ng-click="getAvailableBoys()"><i class="fa fa-refresh"></i></button> &nbsp;
                                    <span style="color:red">{{errmsg}}</span>
                                    <select class="form-control" ng-model="selectedDeliveryBoy" required>
                                        <option value="">~ NOTHING SELECTED ~</option>
                                        <option ng-repeat="sel in availableData"
                                            ng-selected="selectedDeliveryBoy == sel.Id" value="{{sel.Id}}">{{sel.name}} ({{sel.Distance}} Km)
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Assign">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'headers/foot.php'; ?>