<?php include('header.php'); ?>
<main>
    <section>
        <div class="container">
            <div class="py-4">
                <h2 class="pb-2 d-inline-block">Stock Sheet & Expenditure:</h2>
                <input type="date" id="today" name="today" class="form-control d-inline-block" value="<?php echo date("Y-m-d"); ?>" max="<?= date('Y-m-d'); ?>" style="font-size: 20pt;width:190px;border: 0px none;margin-left:5px;" onchange="today()">
            </div>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-ac-tab" data-bs-toggle="tab" data-bs-target="#nav-ac" type="button" role="tab" aria-controls="nav-ac" aria-selected="true" onclick="salesList('ac')">1st Counter (A/c)</button>
                    <button class="nav-link" id="nav-nonac-tab" data-bs-toggle="tab" data-bs-target="#nav-nonac" type="button" role="tab" aria-controls="nav-nonac" aria-selected="false" onclick="salesList('nonac')">1st Counter (Non-A/c)</button>
                    <button class="nav-link" id="nav-janatha-tab" data-bs-toggle="tab" data-bs-target="#nav-janatha" type="button" role="tab" aria-controls="nav-janatha" aria-selected="false" onclick="salesList('janatha')">2nd Counter (Janatha)</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="card py-2 px-2">
                            <h4>Daily Stock Sheet</h4>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">S.No.</th>
                                            <th scope="col">Brand Name</th>
                                            <th scope="col">Opening</th>
                                            <th scope="col">Receipts</th>
                                            <th scope="col">TOTAL</th>
                                            <th scope="col">Sales</th>
                                            <th scope="col">Balance</th>
                                            <th scope="col">Rate</th>
                                            <th scope="col">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sales_data">
                                    </tbody>
                                </table>
                            </div>
                            <p class="loading">Loading Data</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="row">
                            <div class="card py-2 px-2 mb-4">
                                <h4>Today's Summary</h4>
                                <div class="table-responsive">
                                    <table class="table table-hover" id="today_data">
                                    </table>
                                </div>
                                <p class="loading">Loading Data</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="card py-2 px-2">
                                <h4>Expenditure</h4>
                                <form name="expen" id="expen" method="POST">
                                    <div class="form-outline mb-2">
                                        <label class="form-label" for="amount">Amount</label>
                                        <input type="number" id="amount" name="amount" class="form-control" />
                                    </div>
                                    <div class="form-outline mb-2">
                                        <label class="form-label" for="reason">Reason</label>
                                        <input type="text" id="reason" name="reason" class="form-control" />
                                    </div>
                                    <input type="hidden" name="counter" id="counter" class="form-control">
                                    <button type="submit" class="btn btn-primary btn-block mb-4">Save</button>
                                </form>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">SNo.</th>
                                                <th scope="col">Reason</th>
                                                <th scope="col">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody id="expen_data">
                                        </tbody>
                                    </table>
                                </div>
                                <p class="loading">Loading Data</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    function today() {
        salesList("ac");
    }
    $(document).ready(function() {
        salesList("ac");
        $('#expen').on('submit', function(e) {
            e.preventDefault();
            var today = document.getElementById("today").value;
            var amount = $("#amount").val();
            var reason = $("#reason").val();
            var counter = $("#counter").val();
            if (amount == '' || reason == '' || counter == '') {
                alert("Please fill all fields.");
                return false;
            }
            $.ajax({
                type: "post",
                url: "expen_action.php",
                data: {
                    amount: amount,
                    reason: reason,
                    counter: counter,
                    today: today
                },
                cache: false,
                success: function(data) {
                    $("#expen")[0].reset();
                    alert('Expenditure Saved');
                    expenList(counter);
                    todayList(counter);
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
        });
    });

    function salesList(counter = 'ac') {
        var today = document.getElementById("today").value;
        $.ajax({
            type: "post",
            data: {
                counter: counter,
                today: today
            },
            url: "sales_action.php",
            success: function(data) {
                var tr = '';
                if (data != "No Data") {
                    var response = JSON.parse(data);
                    for (var i = 0; i < response.length; i++) {
                        var sales_id = response[i].sales_id;
                        var bname = response[i].bname;
                        var opening = response[i].opening;
                        var total = response[i].total;
                        var sales = response[i].sales;
                        var amount = response[i].amount;
                        var counter = response[i].counter;
                        var receipts = response[i].receipts;
                        var balance = response[i].balance;
                        var rate = response[i].rate;
                        tr += '<tr>';
                        tr += '<td>' + (i + 1) + '</td>';
                        tr += '<td>' + bname + '</td>';
                        tr += '<td>' + opening + '</td>';
                        tr += '<td><input type="number" step="0.01" class="form-control" id="receipts_' + sales_id + '" name="receipts" placeholder="Receipts" value="' + receipts + '" onchange=editValue("receipts_' + sales_id + '") > </td>';
                        tr += '<td>' + total + '</td>';
                        tr += '<td>' + sales + '</td>';
                        tr += '<td><input type="number" step="0.01" class="form-control" id="balance_' + sales_id + '" name="balance" placeholder="Balance" value="' + balance + '" onchange=editValue("balance_' + sales_id + '") > </td>';
                        tr += '<td>' + rate + '</td>';
                        tr += '<td>' + amount + '</td>';
                        tr += '</tr>';
                        $('#expen').show();
                    }
                } else {
                    tr += '<tr>';
                    tr += '<td colspan="9" align="center">' + data + '</td>';
                    tr += '</tr>';
                    $('#expen').hide();
                }
                $('.loading').hide();
                $('#sales_data').html(tr);
                $('#counter').val(counter);
                todayList(counter);
                expenList(counter);
            }
        });
    }

    function todayList(counter = 'ac') {
        var today = document.getElementById("today").value;
        $.ajax({
            type: "post",
            data: {
                counter: counter,
                today: today
            },
            url: "today_list.php",
            success: function(data) {
                var tbody = '';
                if (data != "No Data") {
                    var response = JSON.parse(data);
                    var counter = response[0];
                    var amount = response[1] != null ? response[1] : 0.00;
                    var total = parseInt(counter) - parseInt(amount);
                    tbody += '<tbody>';
                    tbody += '<tr><td>Total</td><td>' + counter + '</td></tr>';
                    tbody += '<tr><td>Expenditure</td><td>' + amount + '</td></tr>';
                    tbody += '<tr><td>Grand Total</td><td>' + total + '</td></tr>';
                    tbody += '</tbody>';
                } else {
                    tbody += '<tbody>';
                    tbody += '<tr><td colspan="2" align="center">' + data + '</td></tr>';
                    tbody += '</tbody>';
                }
                $('.loading').hide();
                $('#today_data').html(tbody);
            }
        });
    }

    function expenList(counter = 'ac') {
        var today = document.getElementById("today").value;
        $.ajax({
            type: "post",
            data: {
                counter: counter,
                today: today
            },
            url: "expen_view.php",
            success: function(data) {
                var tr = '';
                if (data != "No Data") {
                    var response = JSON.parse(data);
                    for (var i = 0; i < response.length; i++) {
                        var expen_id = response[i].expen_id;
                        var counter = response[i].counter;
                        var amount = response[i].amount;
                        var reason = response[i].reason;
                        tr += '<tr>';
                        tr += '<td>' + (i + 1) + '</td>';
                        tr += '<td>' + reason + '</td>';
                        tr += '<td>' + amount + '</td>';
                        tr += '</tr>';
                    }
                } else {
                    tr += '<tr>';
                    tr += '<td colspan="9" align="center">' + data + '</td>';
                    tr += '</tr>';
                }
                $('.loading').hide();
                $('#expen_data').html(tr);
            }
        });
    }

    function editValue(data = 0) {
        var today = document.getElementById("today").value;
        var split_id = data.split("_");
        var field_name = split_id[0];
        var sales_id = split_id[1];
        var data1 = $("#" + data).val();
        $.ajax({
            type: "post",
            data: {
                field_name: field_name,
                sales_id: sales_id,
                data1: data1,
                today: today
            },
            url: "sales_update.php",
            success: function(result) {
                console.log(result);
                salesList(result);
            }
        });
    }
</script>
<?php include('footer.php'); ?>