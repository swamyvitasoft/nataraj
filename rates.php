<?php include('header.php'); ?>
<?php include('db.php'); ?>
<main>
    <section>
        <div class="container">
            <div class="py-4">
                <h5 class="mt-2">Add New Brand & Price</h5>
                <div class="row">
                    <div class="card pt-3 px-4">
                        <form name="brand" id="brand" method="POST">
                            <div class="row">
                                <div class="col-4">
                                    <input type="text" class="form-control" id="brand_name" name="brand_name" aria-describedby="brandHelp" placeholder="Brand Name">
                                </div>
                                <div class="col-2">
                                    <input type="number" class="form-control" id="ac" name="ac" aria-describedby="acHelp" placeholder="A/c">
                                </div>
                                <div class="col-2">
                                    <input type="number" class="form-control" id="nonac" name="nonac" aria-describedby="nonacHelp" placeholder="Non-A/c">
                                </div>
                                <div class="col-2">
                                    <input type="number" class="form-control" id="janatha" name="janatha" aria-describedby="janathaHelp" placeholder="Janatha">
                                </div>
                                <div class="col-2">
                                    <input type="hidden" id="sno" name="sno" value="0">
                                    <button type="submit" class="btn btn-primary btn-block mb-4" name="submitButton" id="submitButton">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <h2>Rates</h2>
                    </div>
                    <div class="col-6">
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Brand Name</th>
                                    <th>1st Counter (A/c)</th>
                                    <th>1st Counter (Non-A/c)</th>
                                    <th>2nd Counter (Janatha)</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="rates_data">
                            </tbody>
                        </table>
                    </div>
                    <p class="loading">Loading Data</p>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    $(document).ready(function() {
        ratesList();

        $('#brand').on('submit', function(e) {
            e.preventDefault();
            var sno = $("#sno").val();
            var brand_name = $("#brand_name").val();
            var ac = $("#ac").val();
            var nonac = $("#nonac").val();
            var janatha = $("#janatha").val();
            if (brand_name == '' || ac == '' || nonac == '' || janatha == '') {
                alert("Please fill all fields.");
                return false;
            }
            $.ajax({
                type: "post",
                url: "brand_action.php",
                data: {
                    sno: sno,
                    brand_name: brand_name,
                    ac: ac,
                    nonac: nonac,
                    janatha: janatha
                },
                cache: false,
                success: function(data) {
                    alert(data);
                    $("#brand")[0].reset();
                    ratesList();
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
        });

    });

    function ratesList() {
        $.ajax({
            type: "post",
            url: "rates_action.php",
            success: function(data) {
                var tr = '';
                if (data != "No Data") {
                    var response = JSON.parse(data);
                    for (var i = 0; i < response.length; i++) {
                        var sno = response[i].sno;
                        var brand_name = response[i].brand_name;
                        var ac = response[i].ac;
                        var nonac = response[i].nonac;
                        var janatha = response[i].janatha;
                        tr += '<tr>';
                        tr += '<td>' + (i + 1) + '</td>';
                        tr += '<td>' + brand_name + '</td>';
                        tr += '<td>' + ac + '</td>';
                        tr += '<td>' + nonac + '</td>';
                        tr += '<td>' + janatha + '</td>';
                        tr += '<td><button class="btn btn-sm btn-danger" onclick=viewRates(' + sno + ')>Edit</button></td>';
                        tr += '</tr>';
                    }
                } else {
                    tr += '<tr>';
                    tr += '<td colspan="6" align="center">' + data + '</td>';
                    tr += '</tr>';
                }
                $('.loading').hide();
                $('#rates_data').html(tr);
            }
        });
    }

    function viewRates(sno = 0) {
        $.ajax({
            type: 'get',
            data: {
                sno: sno,
            },
            url: "rates_view.php",
            success: function(data) {
                var response = JSON.parse(data);
                $('#brand #sno').val(response.sno);
                $('#brand #brand_name').val(response.brand_name);
                $('#brand #ac').val(response.ac);
                $('#brand #nonac').val(response.nonac);
                $('#brand #janatha').val(response.janatha);
            }
        });
    }
</script>
<?php include('footer.php'); ?>