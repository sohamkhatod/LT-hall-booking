<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <style>
        body
        {
            background-color: #e9effd;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            display: flex;
            flex-direction: column;
            gap: 2vw;
            justify-content: center;
            height: 95vh;
            margin: 0;
        }

    .header
    {
        position: absolute;
        top: 0;
        padding: 10px;
        /* height: 10vh; */
        width: calc(100% - 20px);
        background-color: #4f51fd;
        display: flex;
        justify-content: space-between;
    }

    .log-out:hover {
      background-color: #3f41d8;
      box-shadow: 0px 0px 20px -18px;
    }

    .log-out:active {
      transform: scale(0.95);
    }

    .create-holder
    {
      margin-top: 5vw;
      display: flex;
      justify-content: center;
    }

    .create {
      border: 2px solid #494cf3;
      background-color: #494cf3;
      border-radius: 0.9em;
      padding: 0.8em 1.2em 0.8em 1em;
      transition: all ease-in-out 0.2s;
      font-size: 16px;
    }
        .create span {
      display: flex;
      justify-content: center;
      align-items: center;
      color: #fff;
      font-weight: 600;
    }

    .create:hover {
      background-color: #3f41d8;
    }

    .btn-view
    {
      padding: 8px;
      border-radius: 10px;
      padding: 10px;
      border: 0;
      background-color: #494cf3;
      transition: all 0.2s ease-in-out 0ms;
      color: #e9effd;
      text-decoration: none;
    }

    .btn-view:hover
    {
      background-color: #3f41d8;
      color: #e9effd;
      cursor: pointer;
    }

    a
    {
      text-decoration: none;
    }

        .user-name
        {
            padding: 8px;
            font-size: 1vw;
            /* background-color: white; */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        table
        {
            font-size: .7vw;
            border-spacing: .3vw;
        }

        th
        {
            font-size: 15px;
            padding: 20px;
            white-space: nowrap;
            table-layout: fixed;
            border-collapse: collapse;
            background-color: #e9effd;
        }

        .time-header th
        {
            position: sticky;
            top: 0;
        }

        td
        {
            padding: 10px;
            /* background-color: #0099cc; */
            color: white;
            font-size: 15px;
            border-radius: .5vw;
            text-align: center;
        }

        .tableHolder
        {
            /* padding: 10px; */
            margin-left: auto;
            margin-right: auto;
            width: 70vw;
            max-height: 80vh;
            overflow-x: auto;
            overflow-y: auto;
        }

        .hider
        {
            background-color: #e9effd;
            z-index: 999;
            top: 0;
            left: 0;
        }

        .lt-name
        {
            background-color: #e9effd;
            color: black;
            font-size: 20px;
            font-weight: 900;
            white-space: nowrap;
            z-index: 999;
            position: sticky;
            left: 0;
            border-radius: 0;
        }

        .date-btn
        {
            display: flex;
            gap: 2vw;
            justify-content: center;
        }

        .ok-btn
        {
            padding: 8px;
            border-radius: 5px;
            padding: 8px;
            border: 0;
            background-color: #494cf3;
            transition: all 0.2s ease-in-out 0ms;
            color: #e9effd;
            text-decoration: none;
            font-size: 18px;
        }

        .log-out {
            width: fit-content;
            min-width: 100px;
            font-size: 1vw;
            padding: 8px;
            border-radius: 10px;
            border: 2.5px solid #e9effd;
            box-shadow: 0px 0px 20px -20px;
            cursor: pointer;
            background-color: #494cf3;
            transition: all 0.2s ease-in-out 0ms;
            user-select: none;
            /* font-family: 'Poppins', sans-serif; */
            color: #e9effd;
            text-decoration: none;
        }
        .ok-btn:hover
        {
            background-color: #3f41d8;
            color: #e9effd;
            cursor: pointer;
        }

    </style>
</head>
<body>

    
    <div class="header">
    <div class="user-name">Hi {{Session::get('User')}}!</div>
      <a id = 'btnlogout' href='../logout' style="text-decoration: none; text-align: center;">
        <div   class="log-out">
          Log Out
        </div>
      </a>
    </div>
    
    <br>
    <br>
    <br>
    <div class="date-btn">
        <input type="date" id = 'date1' class="date-select">
        <button class="ok-btn">ok</button>
    </div>

    <div class="tableHolder">
    <table id="myTable">
        <tr class="time-header">
            <th class="hider"></th>
            <th>10 - 11</th>
            <th>11 - 12</th>
            <th>12 - 13</th>
            <th>13 - 14</th>
            <th>14 - 15</th>
            <th>15 - 16</th>
            <th>16 - 17</th>
            <th>17 - 18</th>
            <th>18 - 19</th>
            <th>19 - 20</th>
            <th>20 - 21</th>
            <th>21 - 22</th>
            <th>22 - 23</th>
            <!-- <th>1</th> -->
        </tr>
    </table>
    </div>
    
    <script>
        $(document).ready(function () {
        console.log("hi");
        document.getElementById('btnlogout').href = window.location.pathname+'/logout';

        var currentDateIST = new Date().toLocaleString('en-CA', { timeZone: 'Asia/Kolkata', dateStyle: 'short' });

        // Set the value of the input element with id 'date1'
        document.getElementById('date1').value = currentDateIST;
        $( ".ok-btn" ).click();
        });
    for(var i = 1; i <= 10; i++)
    {
        var row = document.getElementById("myTable").insertRow(i);
        for(var j = 0; j < 14; j++)
        {
            if(j == 0)
            {
                row.insertCell(j).innerHTML = "LT " + i;    
            }
            else
            {
                row.insertCell(j).innerHTML = "";
            }
            row.cells[j].bgColor = "#6c757d";
        }
        row.cells[0].classList.add("lt-name");
    }

        

    $( ".ok-btn" ).on( "click", function() {
        for(var i = 1; i <= 10; i++)
        {
            var row = document.getElementById("myTable").rows[i];
            for(var j = 0; j < 14; j++)
            {
                row.cells[j].bgColor = "#6c757d";
                if (j != 0) {
                    row.cells[j].innerHTML = "";
                    row.cells[j].setAttribute("colspan", "1");
                    row.cells[j].style.display = "table-cell";   
                }
            }
        }

        if($(".date-select").val() == "")
        {
            alert("select correct date");
        }
        
        else
        {
            console.log($(".date-select").val())
        // }
            $.ajax({
                type:"GET", 
                url: window.location.pathname+"/data", 
                success: function(data) {
                        var data = JSON.parse(data).data;
                        console.log(data);

                        for (let i = 0; i < data.length; i++) {
                            if(data[i].BookedDate == $(".date-select").val())
                            {
                                console.log(data[i]);
                                var endDate = data[i].endTime.split(":")[0];
                                var startDate = data[i].startTime.split(":")[0];
                                document.getElementById("myTable").rows[data[i].LT].cells[(Number(startDate) - 9)].bgColor = "#198754";
                                document.getElementById("myTable").rows[data[i].LT].cells[(Number(startDate) - 9)].innerHTML = data[i].BookedEvent;
                                document.getElementById("myTable").rows[data[i].LT].cells[(Number(startDate) - 9)].setAttribute("colspan", (endDate - startDate));
                                for (let j = 1; j < (endDate - startDate); j++) {
                                    console.log("hi");
                                    document.getElementById("myTable").rows[data[i].LT].cells[(Number(startDate) + j - 9)].style.display = "none";                         
                                }
                            }
                        }
                    }, 
                error: function(jqXHR, textStatus, errorThrown) {
                        alert(jqXHR.status);
                    },
            })
    }

    } );

    </script>
</body>

</html>