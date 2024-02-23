<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timetable</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <style>
        /* Your existing CSS styles remain unchanged */

        /* Add a new class for merged cells */
        .merged-cell {
            background-color: #6c757d;
        }
    </style>
</head>
<body>

    <div class="tableHolder">
        <table id="myTable">
            <!-- Your existing table headers -->

            <!-- LT1 to LT10 instead of Monday to Sunday -->
            <tr class="day-header">
                <th>LT1</th>
                <!-- Add headers for LT2 to LT10 here if needed -->
            </tr>
            
            <!-- Content rows will be filled dynamically using AJAX -->
        </table>
    </div>

    <script>
        // // Simulating an AJAX response with timetable data
        // var timetableData = {
        //     "LT1": [
        //         { startTime: 10, endTime: 12 },
        //         { startTime: 13, endTime: 15 },
        //     ],
        //     // Add data for LT2 to LT10 if needed
        // };

        // console.log(timetableData);

        // // Function to dynamically generate the timetable
        // function generateTimetable(data) {
        //     // console.log(data);
        //     for (var lt in data) {
        //         var rowIndex = document.getElementById("myTable").rows.length;
        //         var row = document.getElementById("myTable").insertRow(rowIndex);

        //         // Add LT label
        //         var ltCell = row.insertCell(0);
        //         ltCell.innerHTML = lt;

        //         // Add time slots based on data
        //         for (var i = 1; i < document.getElementById("myTable").rows[0].cells.length; i++) {
        //             var timeSlotCell = row.insertCell(i);
        //             timeSlotCell.innerHTML = ""; // Initially empty

        //             // Check if there is data for this time slot
        //             var hasData = data[lt].some(function(slot) {
        //                 return i >= slot.startTime && i < slot.endTime;
        //             });

        //             // If there is data, set the background color
        //             if (hasData) {
        //                 timeSlotCell.bgColor = "#007e33";
        //                 timeSlotCell.classList.add('merged-cell');
        //             }
        //         }
        //     }
        // }

        // // Call the function to generate the timetable with the provided data
        // generateTimetable(timetableData);

        // added by arnav
        $.ajax({
            type:"GET", 
            url: "http://127.0.0.1:8000/table/data", 
            success: function(data) {
                    console.log(JSON.parse(data))
                }, 
            error: function(jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.status);
                },
        })
        
    </script>
</body>
</html>
