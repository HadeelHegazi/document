<?php require_once('db-connect.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>woomai</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./fullcalendar/lib/main.min.js"></script>
    <style>
        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html, body {
            height: 100%;
            width: 100%;
            font-family: Apple Chancery, cursive;
        }

        .btn-info.text-light:hover, .btn-info.text-light:focus {
            background: #000;
        }
        
        table, tbody, td, tfoot, th, thead, tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
        }
        
        .btn2 {
            background-color: #0080ff;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .btn2:hover {
            background-color: #0080ff;
        }

        .btn2-link {
            color: inherit;
            text-decoration: none;
        }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-gradient" id="topNavBar">
        <div class="container">
            <a class="navbar-brand" href="https://sourcecodester.com">יומן</a>
            <div>
                <b class="text-light">woomai</b>
            </div>
        </div>
    </nav>
    <div class="container py-5" id="page-container">
        <div class="row">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
                <div class="cardt rounded-0 shadow">
                    <div class="card-header bg-gradient bg-primary text-light">
                        <h5 class="card-title">Schedule Form</h5>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="save_schedule.php" method="post" id="schedule-form">
                                <input type="hidden" name="id" value="">
                                <div class="form-group mb-2">
                                    <label for="title" class="control-label">Title</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="description" class="control-label">Description</label>
                                    <textarea rows="3" class="form-control form-control-sm rounded-0" name="description" id="description" required></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="start_datetime" class="control-label">Start</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="end_datetime" class="control-label">End</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime" id="end_datetime" required>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm rounded-0" type="submit" form="schedule-form"><i class="fa fa-save"></i> Save</button>
                            <button class="btn btn-default border btn-sm rounded-0" type="reset" form="schedule-form"><i class="fa fa-reset"></i> Cancel</button>
                            <div class="container">
                                <button class="btn2">
                                    <a href="http://localhost/document_sharing/" class="btn2-link">חזרה</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Event Details Modal -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Schedule Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                        <dt class="text-muted">Name</dt>
<dd id="aptName" class="fw-bold fs-4"></dd>
<dt class="text-muted">Time</dt>
<dd id="aptTime" class="fw-bold fs-4"></dd>

                            <dt class="text-muted">Title</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Description</dt>
                            <dd id="description" class=""></dd>
                            <dt class="text-muted">Start</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-muted">End</dt>
                            <dd id="end" class=""></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete">Delete</button>
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Event Details Modal -->

    <?php 
    $schedules = $conn->query("SELECT * FROM `schedule_list`");
    $appointments = $conn->query("SELECT * FROM `tblappointment`");
    $sched_res = [];
    
    
    foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
        $row['sdate'] = date("F d, Y h:i A", strtotime($row['start_datetime']));
        $row['edate'] = date("F d, Y h:i A", strtotime($row['end_datetime']));
        $sched_res[] = [
            'title' => $row['title'],
            'start' => $row['start_datetime'],
            'end' => $row['end_datetime'],
            'description' => $row['description']
        ];
    }

    foreach($appointments->fetch_all(MYSQLI_ASSOC) as $row){
        if (isset($row['Name']) && isset($row['AptTime'])) {
            $start_datetime = date("Y-m-d H:i:s", strtotime($row['AptDate'] . ' ' . $row['AptTime']));
            $sched_res[] = [
                'title' => "Appointment: " . $row['Name'] . " - " . $row['AptTime'],
                'start' => $start_datetime,
                'end' => $start_datetime, // Assuming appointments have no end time
                'description' => "Services: " . $row['Services'] . "\nRemarks: " . $row['Remark'],
                'color' => '#ff0000' // Change color to red for appointments
            ];
        }
    }
    
    
    ?>

    <?php if(isset($conn)) $conn->close(); ?>
</body>
<script>
    $('#delete').click(function() {
    var eventId = info.event.id; // או כל דרך אחרת שבה תוכל לזהות את האירוע שמוחקים
    $.post('delete_event.php', {id: eventId}, function(response) {
        if(response.success) {
            $('#event-details-modal').modal('hide');
            calendar.refetchEvents(); // עדכן את האירועים בלוח השנה
        } else {
            alert('Failed to delete event.');
        }
    }, 'json');
});

    var scheds = <?= json_encode($sched_res) ?>;
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: scheds,
            eventDidMount: function(info) {
                if (info.event.extendedProps.description) {
                    var tooltip = new bootstrap.Tooltip(info.el, {
                        title: info.event.extendedProps.description.replace(/\n/g, '<br>'),
                        html: true,
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
                    });
                }
            },
            eventClick: function(info) {
    $('#title').text(info.event.title);
    $('#description').text(info.event.extendedProps.description);
    $('#start').text(info.event.start.toLocaleString());
    $('#end').text(info.event.end ? info.event.end.toLocaleString() : '');
    
    // נוסיף את שם האירוע והשעה לפי הדרישה
    $('#aptName').text(info.event.title);
    $('#aptTime').text(info.event.start.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}));
    
    $('#event-details-modal').modal('show');
}

        });
        calendar.render();
    });
</script>

</html>
