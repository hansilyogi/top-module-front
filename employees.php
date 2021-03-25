<?php include_once 'headers/head.php'; ?>
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="scripts/employee.js"></script>
<div class="content-wrapper" ng-controller="Employees">
    <section class="content-header">
        <h1>Employees List</h1>
        <small>Click on badge to toggle</small>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Employees List</h3>
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
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="row in employeesList">
                                        <td>{{$index+1}}</td>
                                        <td>{{row.firstName +' '+row.lastName}}</td>
                                        <td>{{row.mobileNo}}</td>
                                        <td>
                                            <span class="badge {{row.accStatus.flag?'bg-green':'bg-orange'}}"
                                                title="Click to toggle" style="cursor:pointer;"
                                                ng-click="toggleApproval(row._id)">
                                                {{row.accStatus.flag?'Approved':'Not Approved'}}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge {{row.isActive?'bg-green':'bg-orange'}}"
                                                style="cursor:pointer;" ng-click="toggleActive(row._id)"
                                                title="Click to toggle">
                                                {{row.isActive?'Active':'Not Active'}}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-info btn-sm" ng-click="ShowData(row)"
                                                data-toggle="modal" data-target="#myModal" title="View More"><i
                                                    class="fa fa-list"></i></button>
                                            
                                            <button class="btn bg-purple btn-sm" ng-click="OpenPolice(row._id)" title="Police Verification"><i class="far fa-file-image"></i></button>
                                            
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
                                                <th>Vehicle Type</th>
                                                <th>Vehicle Number</th>
                                                <th>Approval</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{modalData.firstName +' '+ modalData.lastName}}</td>
                                                <td>{{modalData.mobileNo}}</td>
                                                <td>{{modalData.transport.vehicleType!=null?modalData.transport.vehicleType:"Not Available"}}
                                                </td>
                                                <td>{{modalData.transport.vehicleNo!=null?modalData.transport.vehicleNo:"Not Available"}}
                                                </td>
                                                <td>
                                                    <div class="badge {{modalData.accStatus.flag?'bg-green':'bg-orange'}}"
                                                        title="{{modalData.accStatus.message}}" style="cursor:pointer;">
                                                        {{modalData.accStatus.flag?'Approved':'Not Approved'}}
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge {{modalData.isActive?'bg-green':'bg-orange'}}">
                                                        {{modalData.isActive?'Active':'Not Active'}}
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Account No</th>
                                                <th>IFSC Code</th>
                                                <th>Bank Name</th>
                                                <th>Branch</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{modalData.bankDetail.accNo!=null?modalData.bankDetail.accNo:"Not Available"}}
                                                </td>
                                                <td>{{modalData.bankDetail.ifscCode!=null?modalData.bankDetail.ifscCode:"Not Available"}}
                                                </td>
                                                <td>{{modalData.bankDetail.bankName!=null?modalData.bankDetail.bankName:"Not Available"}}
                                                </td>
                                                <td>{{modalData.bankDetail.branch!=null?modalData.bankDetail.branch:"Not Available"}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <h4>Documents</h4>
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>{{modalData.poaType.toUpperCase()}} FRONT</th>
                                                        <th>{{modalData.poaType.toUpperCase()}} BACK</th>
                                                        <th>PANCARD</th>
                                                        <th>POLICE VERIFI...</th>
                                                        <th>PROFILE</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <img src="{{route}}{{modalData.poaFrontImg}}" width="100px">
                                                        </td>
                                                        <td>
                                                            <img src="{{route}}{{modalData.poaBackImg}}" width="100px">
                                                        </td>
                                                        <td>
                                                            <img src="{{route}}{{modalData.panCardImg}}" width="100px">
                                                        </td>
                                                        <td>
                                                            <div ng-if="modalData.policeVerificationImg == ''">
                                                            
                                                            </div>
                                                            <div ng-else>
                                                            <img ng-src="{{route}}{{modalData.policeVerificationImg}}"
                                                                    width="100px">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <img src="{{route}}{{modalData.profileImg}}" width="100px">
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
        </div>

        <div class="modal fade" id="policeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><b>Upload Police Verification Image</b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form ng-submit="submitPolice()">
                                    <div class="form-group">
                                        <input type="file" file-input="files">
                                    </div>
                                    <button type="submit" class="btn btn-primary"> Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once 'headers/foot.php'; ?>