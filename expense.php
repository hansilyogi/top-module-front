<?php include_once 'headers/head.php'; ?>
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="scripts/expense.js"></script>

<div class="content-wrapper" ng-controller="Expense">
    <section class="content-header">
        <h1>PND Expenses</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">List of Expenses</h3>
                        <div class="box-title pull-right">
                            <button class="btn btn-primary btn-sm" ng-click="OpenModal()"><i class="fas fa-plus"></i>
                                Add New Expense</button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive" style="margin-top:20px;">
                            <table class="mydab table table-bordered bordered table-striped table-condensed"
                                datatable="ng" dt-options="vm.dtOptions">
                                <thead>
                                    <tr>
                                        <th>Srno</th>
                                        <th>Expense Category</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="row in expenseList">
                                        <td>{{$index+1}}</td>
                                        <td>{{ row.expenseCategory.name }}</td>
                                        <td>{{ row.description }}</td>
                                        <td>{{ row.date }}</td>
                                        <td>{{ row.amount }}</td>
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
                    <h4 class="modal-title" id="myModalLabel"><b> Add Expense</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form role="form" ng-submit="saveExpense()">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select type="text" class="form-control" ng-model="expenseCategory" id="expenseCategory" required></select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <input type="text" id="description" ng-model="description" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Amount</label>
                                                <input type="text" id="amount" ng-model="amount" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Payement Type</label>
                                                <input type="text" id="paymentType" ng-model="paymentType" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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