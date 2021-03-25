<?php include_once 'headers/head.php'; ?>
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="scripts/parcelcategories.js"></script>

<div class="content-wrapper" ng-controller="ParcelCategories">
    <section class="content-header">
        <h1>Parcel Categories</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">List of Parcel Categories</h3>
                        <div class="box-title pull-right">
                            <button class="btn btn-primary btn-sm" ng-click="OpenModal()"><i class="fas fa-plus"></i>
                                Add New</button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive" style="margin-top:20px;">
                            <table class="mydab table table-bordered bordered table-striped table-condensed"
                                datatable="ng" dt-options="vm.dtOptions">
                                <thead>
                                    <tr>
                                        <th>Srno</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Note</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="row in bannerList">
                                        <td>{{$index+1}}</td>
                                        <td><img ng-src="{{route}}{{row.image}}" width="100px" /></td>
                                        <td>{{row.title}}</td>
                                        <td>₹{{row.price==null?'0':row.price}}</td>
                                        <td>{{row.note==null?'Not Provided':row.note}}</td>
                                        <td>
                                        <button type="button" class="btn btn-info btn-sm"
                                                ng-click="editData(row)"><i class="fa fa-edit"></i>
                                                Edit</button>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                ng-click="deleteData(row._id)"><i class="fa fa-trash"></i>
                                                Delete</button>
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
                    <h4 class="modal-title" id="myModalLabel"><b> Add Category</b></h4>
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
                                                <label>Price</label>
                                                <input type="number" class="form-control" ng-model="price" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Note</label>
                                                <input type="text" class="form-control" ng-model="note" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Category Image</label>
                                                <input type="file" file-input="files" class="form-control">
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