<div data-ng-controller="TimeSheetsController as timesheet">
    <hot-table
            settings="timesheet.settings"
            row-headers="timesheet.rowHeaders"
            min-spare-rows="timesheet.minSpareRows"
            datarows="timesheet.db.items">
        <hot-column data="user_id" title="'ID'" read-only></hot-column>
        <hot-column data="project_id" title="'Project ID'" type="'text'" read-only></hot-column>
        <hot-column data="entity_type" title="'Entity type'" read-only></hot-column>
        <hot-column data="start_time" title="'Start time'" width="150"></hot-column>
        <hot-column data="duration" title="'Duration'" width="150" type="numeric"></hot-column>
        <hot-column data="description" title="'Description'" width="300"></hot-column>
        <hot-column data="billable" title="'Billable'" type="'checkbox'" checked-template="true"
                    unchecked-template="false"></hot-column>
    </hot-table>
</div>