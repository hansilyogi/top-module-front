<?php include_once 'headers/head.php'; ?>
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="scripts/customers.js"></script>

<div class="content-wrapper" ng-controller="Customers">
    <section class="content-header">
        <h1>Customers List</h1>
        <small>Click on badge to toggle</small>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Customers List</h3>
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
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="row in customerList">
                                        <td>{{$index+1}}</td>
                                        <td>{{row.name}}</td>
                                        <td>{{row.mobileNo}}</td>
                                        <td>
                                            {{row.emailId}}
                                        </td>
                                        <td>
                                            <button class="btn btn-success btn-sm" ng-click="ShowData(row.mobileNo)"><i
                                                    class="fab fa-whatsapp"></i></button>
                                            <button class="btn btn-danger btn-sm" ng-click="DeleteData(row._id)"><i
                                                    class="fa fa-trash"></i></button>
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
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><b>Send Message Via Whatsapp</b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form ng-submit="sendWAMessage()">
                                    <!-- <div class="form-group">
                                        <label>Select Message Templete</label>
                                        <select class="form-control" ng-model="selectmessageBox"
                                            ng-change="changeMessagebox()" required>
                                            <option value="">~ SELECT ~</option>
                                            <option ng-repeat="sel in MessageList"
                                                ng-selected="selectmessageBox == sel._id" value="{{sel._id}}">
                                                {{sel.title}}</option>
                                        </select>
                                    </div> -->
                                    <div class="form-group">
                                        <label>Message</label>
                                        <textarea rows="6" class="form-control" ng-model="messagebox"
                                            required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" value="Send" class="btn btn btn-primary">
                                    </div>
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