<script type="text/javascript" src="js/app/modulescontroller.js"></script>
<div class="tab-pane" id="modules" ng-controller="ModulesController">
     <div class="btn-toolbar" style="margin-bottom: 9px">
      <div class="btn-group">
        <button class='btn btn-success' data-toggle="modal" href="#module_form"> <i class='icon-white icon-th'></i> </button>
        <button class='btn btn-info' ng-click="reload()"> <i class='icon-white icon- icon-repeat'></i> </button>
      </div>
    </div>
    <div>
      <table class='table table-striped table-bordered my-table'>
          <thead>
            <tr>
              <th class="grid_action1">#</th>
              <th>Name</th>
              <th>Description</th>
              <th>List Order</th>
              <th>Created On</th>
            </tr>
          </thead>
          <tbody>
            <!-- <tr>
              <td colspan='100'>No Users created.</td>
            </tr> -->
            <tr ng-repeat="module in modules">
              <td> {{$index + 1}} </td>
              <td> {{module.name}} </td>
              <td> {{module.description}} </td>
              <td> {{module.position}} </td>
              <td> {{module.created_at}} </td>
            </tr>
          </tbody>
      </table>
    </div>
  <?php echo View::make("components.module_form"); ?>
  </div>