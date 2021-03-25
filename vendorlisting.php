<?php include_once 'headers/head.php'; ?>
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="scripts/vendorlisting.js"></script>
<div class="content-wrapper" ng-controller="Vendor">
    <section class="content-header">
        <h1>Vendor List</h1>
        <small>Click on badge to toggle</small>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Vendor List</h3>
                    </div>
                    <div ng-hide="loader">
                        <br>
                        <center>
                            <img src="dist/img/pulse.svg" width="100px">
                            <div><b>Please wait...</b></div>
                        </center>
                        <br>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive" ng-hide="tabdata">
                            <table class="mydab table table-bordered bordered table-striped table-condensed"
                                datatable="ng" dt-options="vm.dtOptions">
                                <thead>
                                    <tr>
                                        <th>Srno</th>
                                        <th>Fullname</th>
                                        <th>Mobile</th>
                                        <th>Approval</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="row in vendorList">
                                        <td>{{$index+1}}</td>
                                        <td>{{row.name}}</td>
                                        <td>{{row.mobileNo}}</td>
                                        <td>
                                            <span class="badge {{row.isApprove?'bg-green':'bg-orange'}}"
                                                title="Click to toggle" style="cursor:pointer;"
                                                ng-click="toggleApproval(row._id)">
                                                {{row.isApprove?'Approved':'Not Approved'}}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-info btn-sm" ng-click="ShowData(row)"
                                                data-toggle="modal" data-target="#myModal" title="View More"><i
                                                    class="fa fa-list"></i></button>
                                            
                                            <button class="btn btn-danger btn-sm" ng-click="DeleteData(row._id)"><i
                                                    class="fa fa-trash" title="Delete"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.col -->
        </div>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><b>Employee Details</b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Fullname</th>
                                                <th>Mobile</th>
                                                <th>Company</th>
                                                <th>E-Mail</th>
                                                <!-- <th>Approval</th> -->
                                                <!-- <th>Status</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{modalData.name}}</td>
                                                <td>{{modalData.mobileNo}}</td>
                                                <td>{{modalData.company}}</td>
                                                <td>{{modalData.email}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>GST No</th>
                                                <th>PanCard Number</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{modalData.gstNo}}</td>
                                                <td>{{modalData.panNumber}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <h4>Charges</h4>
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Fix Km</th>
                                                        <th>Price Under Fix Km</th>
                                                        <th>Per Km Charge</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{modalData.FixKm}}</td>
                                                        <td>{{modalData.UnderFixKmCharge}}</td>
                                                        <td>{{modalData.perKmCharge}}</td>
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
        </div>
    </section>
</div>

<?php include_once 'headers/foot.php'; ?>