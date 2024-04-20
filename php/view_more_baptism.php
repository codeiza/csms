<div class="row">
    <div class="col-sm-3">
        <label><i class="fas fa-calendar-alt"></i> Start Date:</label>
        <input type="text" value="<?php echo date('Y-m-d', strtotime('-30 days')); ?>" id="DateFrom"
            class="form-control" />
    </div>
    <div class="col-sm-3">
        <label><i class="fas fa-calendar-alt"></i> End Date:</label>
        <input type="text" value="<?php echo date('Y-m-d') ?>" id="DateTo" class="form-control" />
    </div>
    <div id="baptismal">

    </div>
    <script>
    $("#DateFrom,#DateTo").datepicker({
        format: 'yyyy-mm-dd',
        startDate: '-3m',
        autoclose: true
    })

    function load(DateFrom, DateTo, page) {
        $("#loading").html('<img src="img/loading.gif">');
        $.ajax({
            type: 'post',
            url: 'php/baptismal_graph.php',
            data: {
                DateFrom: DateFrom,
                DateTo: DateTo,
                page: page
            }
        }).done(function(data) {
            $("#baptismal").html(data)
            $("#loading").empty()
        })
    }

    load($("#DateFrom").val(), $("#DateTo").val(), 1)

    $(document).on('change', '#DateFrom', function() {
        load($(this).val(), $("#DateTo").val(), 1)

    })
    $(document).on('change', '#DateTo', function() {
        load($("#DateFrom").val(), $(this).val(), 1)

    })
    </script>