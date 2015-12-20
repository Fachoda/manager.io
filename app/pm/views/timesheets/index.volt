<div data-ng-controller="TimeSheetsController as timesheet">
    <hot-table
            settings="timesheet.settings"
            min-spare-rows="timesheet.minSpareRows"
            max-spare-rows="timesheet.maxSpareRows"
            datarows="timesheet.db.items",
            col-headers="timesheet.colHeaders",
            columns="timesheet.columns"
            >
    </hot-table>
</div>