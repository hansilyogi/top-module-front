<?php include_once 'headers/head.php'; ?>
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="scripts/promocode.js"></script>

<div class="content-wrapper" ng-controller="PromoCode">
    <section class="content-header">
        <h1>Promo Code Management</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">List of Promo Codes</h3>
                        <span class="pull-right">
                            <button class="btn btn-primary btn-sm" ng-click="OpenModal()">Add Promocode</button>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive" style="margin-top:20px;">
                            <table class="mydab table table-bordered bordered table-striped table-condensed"
                                datatable="ng" dt-options="vm.dtOptions">
                                <thead>
                                    <tr>
                                        <th>SR</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Code</th>
                                        <th>Discount</th>
                                        <th>Valid from</th>
                                        <th>Valid upto</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="k in PromocodeList">
                                        <td>{{$index+1}}</td>
                                        <td>
                                            <img src="{{imgurl}}{{k.image}}" width="100px">
                                        </td>
                                        <td>
                                            {{k.title}}
                                        </td>
                                        <td>{{k.description}}</td>
                                        <td>{{k.code}}</td>
                                        <td>{{k.discount}}%</td>
                                        <td>{{k.validfrom | date:"MM/dd/yyyy"}}</td>
                                        <td>{{k.validupto | date:"MM/dd/yyyy"}}</td>
                                        <td>
                                            <button class="btn btn-info btn-sm" ng-click="editData(k)"><i
                                                    class="fa fa-edit"></i></button>
                                            <button class="btn btn-danger btn-sm" ng-click="deletePromocode(k._id)"><i
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
                    <h4 class="modal-title" id="myModalLabel"><b> {{modaltitle}}</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                        <form role="form" ng-submit="savePromocode()">
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
                                            <textarea row="5" class="form-control" ng-model="description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Select User</label>
                                            <select class="form-control" id="status" ng-model="status" required>
                                                <option value=0>New User</option>
                                                <option value=1>All User</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Code</label>
                                            <input type="text" class="form-control" ng-model="code"
                                                onkeyup="this.value = this.value.toUpperCase();">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Discount %</label>
                                            <input type="number" class="form-control" ng-model="discount">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Valid From</label>
                                            <input type="date" class="form-control" ng-model="validfrom">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Valid Upto</label>
                                            <input type="date" class="form-control" ng-model="validupto">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" class="form-control" file-input="files">
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
                </div>
            </div>
        </div>
    </div>

</div>

<?php include_once 'headers/foot.php'; ?>