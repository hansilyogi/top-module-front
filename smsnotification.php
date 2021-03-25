<?php include_once 'headers/head.php'; ?>
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="scripts/notification.js"></script>

<div class="content-wrapper" ng-controller="Notification">
    <section class="content-header">
        <h1>SMS & Notification Management</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">SMS & Notification Management</h3>
                    </div>
                    <form role="form" ng-submit="sendNotifcation()">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>To Whom?</label>
                                        <select class="form-control" ng-model="whom" ng-change="whomchange()" required>
                                            <option value="">~ Nothing Selected ~</option>
                                            <option ng-repeat="sel in listing" ng-selected="whom == sel.id" value="{{sel.id}}">
                                                {{sel.name}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" ng-model="title" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea row="5" class="form-control" ng-model="description" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <span ng-repeat="type in Types">
                                            <label>{{type.Name}}</label>
                                            <input type="checkbox" ng-model="type.Selected"/>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" ng-disabled="btnsave"><i
                                    class="fa fas fa-check"></i> Save</button>
                            <button type="reset" class="btn btn-danger"><i class="fa fas fa-times"></i> Reset</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{listData}}</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive" style="margin-top:20px;">
                            <table class="mydab table table-bordered bordered table-striped table-condensed" datatable="ng" dt-options="vm.dtOptions">
                                <thead>
                                    <tr>
                                        <th width="15%"><input type="checkbox" ng-model="checkall"
                                                ng-click="ToogleCheck()"> Check all</th>
                                        <th>Name</th>
                                        <th>Mobile Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="row in getcouriers">
                                        <td><input type="checkbox" ng-model="row.selected" ng-Checked="checkall"></td>
                                        <td>{{row.name}}</td>
                                        <td>{{row.mobileNo}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once 'headers/foot.php'; ?>