<script type="text/javascript" src="js/app/securablescontroller.js"></script>
<div class="tab-pane" id="securables" ng-controller="SecurablesController">
     <div class="btn-toolbar" style="margin-bottom: 9px">
      <div class="btn-group">
        <button class='btn btn-success' data-toggle="modal" href="#securable_form"> <i class='icon-white icon-th'></i> </button>
        <button class='btn btn-info' ng-click="reload()"> <i class='icon-white icon- icon-repeat'></i> </button>
      </div>
    </div>
    <div>
      <table class='table table-striped table-bordered my-table'>
          <thead>
            <tr>
              <th class="grid_action1">#</th>
              <th>Name</th>
              <th>Display Name</th>
              <th>Module</th>
              <th>Date Created</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <!-- <tr>
              <td colspan='100'>No Users created.</td>
            </tr> -->
            <tr ng-repeat="securable in securables">
              <td> {{$index + 1}} </td>
              <td> {{securables.name}} </td>
              <td> {{securables.displayName}} </td>
              <td> {{securables.moduleName}} </td>
              <td> <a href="#"> <i class="icon-pencil"></i> </a> </td>
              
            </tr>
          </tbody>
      </table>
    </div>
  <?php echo View::make("components.securable_form"); ?>
  </div>