@extends('layouts.admin')
@section('content')
<!-- Content here -->
<div id="freshLeads" name="freshLeads" >
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="table-responsive">
                    <table id="jstable" name="jstable" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                            <tr class="headings">
                                <th class="column-title" style="display: table-cell;">Name</th>
                                <th class="column-title" style="display: table-cell;">Description</th>
                                <th class="column-title" style="display: table-cell;">Body</th>
                                <th class="column-title" style="display: table-cell;">Image</th>
                                <th class="column-title" style="display: table-cell;">Price(S$)</th>
                                <th class="column-title" style="display: table-cell;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="even pointer">
                                <td class=" "></td>
                                <td class=" "></td>
                                <td class=" "></td>
                                <td class=" "></td>
                                <td class=" "></td>
                                <td class=" "></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection