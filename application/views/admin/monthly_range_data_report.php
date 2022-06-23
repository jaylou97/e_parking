

<style>
    
    #generate_report_jay[disabled]
        {
         background: grey;
        }
</style>




<div class="page-wrapper">

    <div class="container-fluid">

        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor"><?php echo $page_title ?></h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <span class="caption-helper" id="currentTimer"></span>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class=" icon-list"></i> &nbsp;<?php echo $content_header ?> List </h4>
                        <div class="row">
                            <div class="col-lg-3">
                                <label>Filter Month From : </label>
                                <select id="month_from" class="form-control"></select>
                            </div>
                            <div class="col-lg-2">
                                <label>Select Year From : </label>
                                <select id="my_year1" class="form-control"></select>
                            </div>
                            <div class="col-lg-3">
                                <label>Filter Month To : </label>
                                <select id="month_to" class="form-control"></select>
                            </div>
                            <!-- <div class="col-lg-2">
                                <label>Select Year : </label>
                                <select id="my_year" class="form-control"></select>
                            </div> -->
                            <div class="col-lg-2">
                                <label>Select Year To : </label>
                                <select id="my_year2" class="form-control"></select>
                            </div>
                            <div class="col-lg-4"><button class="btn btn-info" id="generate_report_jay" style="margin-top: 30px;" onclick="submitDateInput()"><i class="ti-clipboard"></i> Generate Report</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>