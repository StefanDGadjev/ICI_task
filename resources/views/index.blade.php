<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/public.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <div id="cell" class="row">
        <div class="col-md-3">
            <div class="card ccard radius-t-0 h-100">
                <div class="position-tl w-102 border-t-3 brc-primary-tp3 ml-n1px mt-n1px"></div>
                <!-- the blue line on top -->
                <div class="card-header pb-3 brc-secondary-l3">
                    <h5 class="card-title mb-2 mb-md-0 text-dark-m3">
                        Cell
                    </h5>
                </div>
                <div id="cellData" class="card-body pt-2 pb-1"></div>
            </div>
        </div>
    </div>
    <br>
    <div id="users" class="row">
        <div class="col-md-3">
            <div class="card ccard radius-t-0 h-100">
                <div class="position-tl w-102 border-t-3 brc-primary-tp3 ml-n1px mt-n1px"></div>
                <!-- the blue line on top -->
                <div class="card-header pb-3 brc-secondary-l3">
                    <h5 class="card-title mb-2 mb-md-0 text-dark-m3">
                        User
                    </h5>
                </div>
                <div id="userData" class="card-body pt-2 pb-1"></div>
            </div>
        </div>
    </div>
</div>
</body>
    <script>
        // URL that we need to get the data for displaying
        const url = '{{ route('api.data') }}';
        // The period in milliseconds that we want to refresh the information
        const time = 4000;
        // Calling the Data function fist to populate the information in the HTML
        getData();
        // Looping trough the function by the time set so we can refresh the data
        setInterval(function(){
            getData();
        }, time);

        // the function that we get the information from the api and map it to the HTML
        async function getData() {
            // Get the response of the api
            const response = await fetch(url)
            // Gets the data from the Json and saves in the variable
            const data = await response.json();
            console.log(data);
            // going through the cell data and mapping the information to the HTML
            if (data.cell){
                // Refreshes the fields on the update
                document.getElementById('cellData').innerHTML = '';

                // Fills the fields with the Cell information from the APi data
                Object.entries(data.cell).forEach(([key, value]) => {
                    document.getElementById('cellData').innerHTML += ' <div class="d-flex flex-wrap align-items-center my-2 bgc-secondary-l4 bgc-h-secondary-l3 radius-1 p-25 d-style"> <span class="text-default-d3 text-90 text-600">'+ key +'</span> <span class="ml-auto text-dark-l2 text-nowrap">'+ value +'</span> </div>';
                });

            }else{
                // If no information is provided for the cell prints "no cell information"
                document.getElementById("cell").innerHTML = "No cell information";
            }
            // going through the users data and mapping the information to the HTML
            if (data.users) {
                // Refreshes the users on the update
                document.getElementById('users').innerHTML = '';
                // Loops through the users and creates the exact users provided
                Object.entries(data.users).forEach(([user_id, user]) => {
                    // Creates the users models
                    document.getElementById('users').innerHTML += '<div class="col-md-3"> <div class="card ccard radius-t-0 h-100"> <div class="position-tl w-102 border-t-3 brc-primary-tp3 ml-n1px mt-n1px"></div> <div class="card-header pb-3 brc-secondary-l3"> <h5 class="card-title mb-2 mb-md-0 text-dark-m3">User '+ user_id +' </h5> </div> <div id="userData'+ user_id +'" class="card-body pt-2 pb-1"></div> </div> </div>'

                    // Fills the fields with the User information from the APi data
                    Object.entries(user).forEach(([key, value]) => {
                        document.getElementById('userData'+user_id).innerHTML += ' <div class="d-flex flex-wrap align-items-center my-2 bgc-secondary-l4 bgc-h-secondary-l3 radius-1 p-25 d-style"> <span class="text-default-d3 text-90 text-600">'+ key +'</span> <span class="ml-auto text-dark-l2 text-nowrap">'+ value +'</span> </div>';
                    });
                });
            }else{
                // If no information is provided for the users prints "no user information"
                document.getElementById("users").innerHTML = "No user information";
            }
        }
    </script>
</html>
