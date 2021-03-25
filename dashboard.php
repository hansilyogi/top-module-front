<?php include_once 'headers/head.php'; ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCW-CryHApwFarrX9piqmNKo-E_ZxAlYJU"></script>
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="scripts/dashboard.js"></script>
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
<div class="content-wrapper" ng-controller="Dashboard">
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
        <ol class="breadcrumb">
            <div class="box-title pull-right">
                <button class="btn btn-primary btn-sm" ng-click="OpenModal()"><i class="fas fa-plus"></i>
                    Add New</button </div>
            </div>
            <!-- <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li> -->
            <!-- <li class="active">Dashboard</li> -->
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom" ng-hide="tabdata">
                    <!-- Tabs within a box -->
                    <!-- <ul class="nav nav-tabs pull-right ui-sortable-handle">
                        <li class="express"><a href="multiple_order.php">Multiple
                                Delivery &nbsp;</a></li>
                        <li class="active"><a href="#revenue-chart" data-toggle="tab" aria-expanded="true">Pending
                                Orders &nbsp;<span class="label label-danger">{{totalpendingOrders}}</span></a></li>
                        <li class="pull-left header"><i class="fa fa-history"></i> Pending Orders</li>
                    </ul> -->
                    <div class="tab-content no-padding">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active" id="revenue-chart">
                            <div class="box-body table-responsive" style="margin-top:10px;">
                                <!-- <div ng-show="loader">
                                    <br>
                                    <center>
                                    <img src="dist/img/myloader.gif" width="500px">
                                    </center>
                                    <br>
                                </div> -->
                                <table class="table table-bordered bordered table-striped table-condensed"
                                    datatable="ng" dt-options="vm.dtOptions">
                                    <thead>
                                        <tr>
                                            <th width="3%">SR</th>
                                            <th>Site Name</th>
                                            <th>Customer Name</th>
                                            <th>Site Image</th>
                                            <th>Status</th>
                                            <th>View More</th>
                                        </tr>
                                    </thead>
                                    <tbody align="left">
                                        <tr ng-repeat="row in proData">
                                            <td>{{$index+1}}</td>
                                            <td>
                                                <div><b>{{row.siteName}}</b>,</div>
                                                <div>{{row.location.address}}</div>
                                            </td>
                                            <td>
                                                <b>{{row.customerId[0].name}}</b>
                                            </td>
                                            <td>
                                                <img src="{{imgroute}}{{row.siteImg}}" ng-show="row.siteImg" width="200px"/>
                                            </td>
                                            <td>
                                                {{ row.status == "0" ? "Pending" : "Completed"}}
                                            </td>
                                            <td>
                                                <button class="btn btn-info btn-sm" title="Assign To Delivery Boy"
                                                    ng-click="AssignPoup(row._id,row.orderNo)"><i
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