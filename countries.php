<!DOCTYPE html>
  <html>
   <head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
   </head>
   <body>

        <div class="container">
            <?php

            $json = file_get_contents("https://api.covid19api.com/summary");
            $data = json_decode($json, true);

            usort($data["Countries"], function($a, $b) {
                return $a["TotalConfirmed"] > $b["TotalConfirmed"] ? -1 : 1;
            });

            echo "<br><h1>As06</h1>";

            echo "<br><h3>Top 10 Covid-19 Countries:</h3><br>";

            // print_r($data);
            echo "<table border='3'>";
            echo "<tr><th>Country</th><th># of Cases</th></tr>";

            $i = 0;

            $top10 = array();

            foreach($data["Countries"] as $country) {

                $top10[] = array(
                    'Name' => $country["Country"],
                    'Cases' => $country["TotalConfirmed"],
                );

                $i++;

                if ($i == 10) {
                    break;
                }
            }

            //convert array to json object
            $encoded_data = json_encode(array('top10' => $top10));
            //decode json object
            $decoded_data = json_decode($encoded_data);

            foreach($decoded_data->top10 as $country) {
                echo "<tr>";
                echo "<td>" . $country->Name . "</td>";
                echo "<td>" . $country->Cases . "</td>";
                echo "</tr>";
            }

            echo "</table>";

            ?>
            
        </div>

    </body>

</html>
