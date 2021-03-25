<?php include_once 'headers/head.php'; ?>
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="scripts/courierLogger.js"></script>

<div class="content-wrapper" ng-controller="CourierLogger">
    <section class="content-header">
        <h1>Logs</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">List of logs</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive" style="margin-top:20px;">
                            <table class="mydab table table-bordered bordered table-striped table-condensed"
                                datatable="ng" dt-options="vm.dtOptions">
                                <thead>
                                    <tr>
                                        <th>Srno</th>
                                        <th>PND ID</th>
                                        <th>Location</th>
                                        <th>Description</th>
                                        <th>Date Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="row in courierLoogger">
                                        <td>{{$index+1}}</td>
                                        <td>{{row.courierId.cId}}</td>
                                        <td><a href="#" title="See in Map" ng-click="OpenMap(row.lat,row.long)">{{row.lat}} {{row.long}}</a></td>
                                        <td>{{row.description}}</td>
                                        <td>{{row.dateTime | date:"dd MMM yyyy h:mm a"}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><b> Add Banner</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form role="form" ng-submit="saveBanner()">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" class="form-control" ng-model="title" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Banner Image</label>
                                                <input type="file" file-input="files" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary" ng-disabled="btnsave"><i
                                            class="fa fas fa-check"></i> Save</button>
                                    <button type="reset" class="btn btn-danger"><i class="fa fas fa-times"></i>
                                        Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'headers/foot.php'; ?>