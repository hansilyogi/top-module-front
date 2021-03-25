<?php include_once 'headers/head.php'; ?>
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="scripts/messagetemplete.js"></script>

<div class="content-wrapper" ng-controller="Message">
    <section class="content-header">
        <h1>Message Templete</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">List of Messages</h3>
                        <div class="box-title pull-right">
                            <button class="btn btn-primary btn-sm" ng-click="OpenModal()"><i class="fas fa-plus"></i>
                                Add New</button </div>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive" style="margin-top:20px;">
                                <table class="mydab table table-bordered bordered table-striped table-condensed"
                                    datatable="ng" dt-options="vm.dtOptions">
                                    <thead>
                                        <tr>
                                            <th>SR</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="k in datalist">
                                            <td>{{$index+1}}</td>
                                            <td>
                                                {{k.title}}
                                            </td>
                                            <td>{{k.description}}</td>
                                            <td>
                                                <button class="btn btn-info btn-sm" ng-click="editData(k)"><i
                                                        class="fa fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm"
                                                    ng-click="deleteTemplete(k._id)"><i
                                                        class="fa fa-trash"></i></button>
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

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><b>Add Message</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form role="form" ng-submit="savetemplete()">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" class="form-control" ng-model="title">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea row="5" class="form-control"
                                                    ng-model="description"></textarea>
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