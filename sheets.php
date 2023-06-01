<?php include('header.php'); ?>
<main>
    <section>
        <div class="container">
            <div id="section" class="mt-3">
                <div class="row">
                    <div class="col-6">
                        <h2 class="pb-2">Stock Sheet</h2>

                    </div>
                    <div class="col-6" align="right">
                        <a href="daily-sheet.php" class="btn btn-primary">Add Today's Sheet</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">S.No</th>
                                <th scope="col">Date</th>
                                <th scope="col">1st Counter (A/c)</th>
                                <th scope="col">1st Counter (Non-A/c)</th>
                                <th scope="col">2nd Counter (Janatda)</th>
                                <th scope="col">Grand Total</th>
                            </tr>
                        </thead>
                        <tbody id="sheets_data"></tbody>
                    </table>
                </div>
                <p class="loading">Loading Data</p>
            </div>
        </div>
    </section>
</main>
<script>
    $(document).ready(function() {
        loadSheet();
        loadRates();
    });

    function loadSheet() {
        $.ajax({
            type: "post",
            url: "sheet_load.php",
            success: function(data) {
                if (data != "No Data") {
                    sheetsList();
                } else {
                    todaySheet();
                    alert("Today Data Loaded");
                }
            }
        });
    }

    function loadRates() {
        $.ajax({
            type: "post",
            url: "rates_load.php",
            data: {
                load_data: 2
            },
            success: function(data) {
                if (data != "No Data") {
                    todaySheet();
                    alert("Rates Changed");
                } else {
                    sheetsList();
                }
            }
        });
    }

    function todaySheet() {
        $.ajax({
            type: "post",
            url: "today_sheet.php",
            success: function(data) {
                sheetsList();
            }
        });
    }

    function sheetsList() {
        $.ajax({
            type: "post",
            url: "sheets_view.php",
            success: function(data) {
                var tr = '';
                if (data != "No Data") {
                    var response = JSON.parse(data);
                    for (var i = 0; i < response.length; i++) {
                        var bs_date = response[i].bs_date;
                        var ac = response[i].ac;
                        var nonac = response[i].nonac;
                        var janatha = response[i].janatha;
                        var expenditure = response[i].expenditure;
                        var grand_total = response[i].grand_total;
                        tr += '<tr>';
                        tr += '<td>' + (i + 1) + '</td>';
                        tr += '<td>' + bs_date + '</td>';
                        tr += '<td>' + ac + '</td>';
                        tr += '<td>' + nonac + '</td>';
                        tr += '<td>' + janatha + '</td>';
                        tr += '<td>' + grand_total + '</td>';
                        tr += '</tr>';
                    }
                } else {
                    tr += '<tr>';
                    tr += '<td colspan="6" align="center">' + data + '</td>';
                    tr += '</tr>';
                }
                $('.loading').hide();
                $('#sheets_data').html(tr);
            }
        });
    }
</script>
<?php include('footer.php'); ?>