<?php include_once 'headers/head.php'; ?>
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="scripts/completedorder.js"></script>

<div class="content-wrapper" ng-controller="Completedorder">
    <section class="content-header">
        <h1>Listing All Orders</h1>
        <small>Click on badge to toggle</small>
    </section>
    <section class="content">
        <div class="box-body">
            <div ng-hide="loader">
                <br>
                <center>
                <img src="dist/img/myloader.gif" width="500px">
                </center>
                <br>
            </div>
            <div class="nav-tabs-custom" ng-hide="tabdata" id="mytabslist">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right ui-sortable-handle">
                    <li class=""><a href="#completedOrders" data-toggle="tab" aria-expanded="false">Completed Orders
                            &nbsp;<span class="label label-info">{{totalcompleted}}</span></a></li>
                    
                </ul>
                <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    
                    <div class="chart tab-pane active" id="completedOrders">
                        <div class="box-body table-responsive" style="margin-top:10px;">
                            <table class="table table-bordered bordered table-striped table-condensed" datatable="ng"
                                dt-options="vm.dtOptions">
                                <thead>
                                    <tr>
                                        <th width="3%">SR</th>
                                        <th>OrderNo / Date</th>
                                        <th>Parcel Img</th>
                                        <th>Pickup</th>
                                        <th>Drop</th>
                                        <th>Order Details</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody align="left">
                                    <tr ng-repeat="row in completeOrders | orderBy:'-dateTime'">
                                        <td>{{$index+1}}</td>
                                        <td>
                                        <div><b>{{row.completeOrders.orderNo}}</b></div>
                                            <div><b>Order Time:</b> {{row.completeOrders.dateTime | date:"MM/dd/yyyy h:mma"}}</div>
                                            <div><b>Start Time:</b> {{row.starttime | date:"MM/dd/yyyy h:mma"}}</div>
                                            <div><b>Delivery Time:</b> {{row.endTime | date:"MM/dd/yyyy h:mma"}}</div>
                                        </td>
                                        <td>
                                            <img src="{{route}}{{row.completeOrders.orderImg}}" ng-show="row.completeOrders.orderImg" width="100px"/>
                                            <div>{{row.completeOrders.pickupPoint.contents}}</div>
                                        </td>
                                        <td>
                                            <b>{{row.completeOrders.pickupPoint.name}}</b>,<br/>
                                            <div>&nbsp;{{row.completeOrders.pickupPoint.mobileNo}},</div>
                                                    <div>&nbsp;{{row.completeOrders.pickupPoint.completeAddress}},</div>
                                                    <div>&nbsp;{{row.completeOrders.pickupPoint.address}}</div>
                                        </td>
                                        <td>
                                            <b>{{row.completeOrders.deliveryPoint.name}}</b>,<br>
                                            <div>&nbsp;{{row.completeOrders.deliveryPoint.mobileNo}},</div>
                                            <div>&nbsp;{{row.completeOrders.deliveryPoint.completeAddress}},</div>
                                            <div>&nbsp;{{row.completeOrders.deliveryPoint.address}}</div>
                                            <div>&nbsp;<i>Total Distance : {{row.completeOrders.deliveryPoint.distance}}</i></div>
                                        </td>
                                        <td>
                                            <div><b>Collect Cash</b>: {{row.completeOrders.collectCash}}
                                            </div>
                                            <div><b>Status</b>: {{row.completeOrders.isActive?'Active':'Not Active'}}
                                            </div>
                                            <div><b>Note</b>: <i>{{row.completeOrders.note}}</i>
                                            </div>
                                            <div><b>DeliveryBoy</b>: <i>
                                                    {{row.completeOrders.courierId.length==0?'Not Assigned':row.completeOrders.courierId[0].firstName}}
                                                    {{row.completeOrders.courierId.length!=0?row.completeOrders.courierId[0].lastName:""}}
                                                </i>
                                            </div>
                                        </td>
                                        <td>
                                            <div><b>Total</b>: <i>{{row.completeOrders.amount}}</i>
                                            </div>
                                            <div><b>Discount %</b>: <i>{{row.completeOrders.discount}}</i>
                                            </div>
                                            <div><b>Add. Amount</b>: <i>{{row.completeOrders.additionalAmount}}</i>
                                            </div>
                                            <div><b>Net. Amount</b>: <i>{{row.completeOrders.finalAmount}}</i>
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
    </section>
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
                                            ng-selected="selectedDeliveryBoy == sel.Id" value="{{sel.Id}}">{{sel.name}}
                                        </option>
                                    </select>
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
</div>
</div>

<?php include_once 'headers/foot.php'; ?>