
<html>
<head lang="en">
    <meta charset="UTF-8">

    <title>Duo Weather App</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>
<body>
<div id="app">
    <div ng-app="myApp" ng-controller="myCtrl">
        <div id="chart_div_lines"></div>
        <div id="chart_div"></div>

        <input type="text" ng-model="search" ng-bind="selected">
<!--        <select ng-model="myColor" ng-options="color.name group by color.country for color in colors"></select>-->
        <select ng-model="selected" ng-options="item.country for item in resp.data | filter:search"></select>
        <select ng-model="selected" ng-options="item.name for item in resp.data | filter:search"></select>
        <select ng-model="selected" ng-options="item.name group by item.country for item in resp.data | filter:search" ></select>
        {{ selected.data.name }}

    </div>
</div>
<script>
    let app = angular.module('myApp', []).controller('myCtrl', function($scope, $http) {
        $http({
            method:"GET",
            url:"http://localhost:8888/cities/"
        }).then(function (response) {
            $scope.resp = response;
            console.log($scope.resp);

            $scope.selected = $scope.resp;
            console.log($scope.selected);

        });
        $http({
            method:"GET",
            url:"http://api.openweathermap.org/data/2.5/forecast?q=zwolle&APPID=&units=metric&lang=nl"
        }).then(function (respond) {
            $scope.weather = respond.data.list;
            console.log(respond.data.list);
        });

        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages':['corechart']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);
        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.

        function drawChart() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Time');
            data.addColumn('number', 'Temp');
            data.addColumn('number', 'Temp max');
            data.addColumn('number', 'Humidity');
            for (var i = 0; i < $scope.weather.length; i++) {
                data.addRows([
                    [$scope.weather[i].dt_txt, $scope.weather[i].main.temp, $scope.weather[i].main.temp_max, $scope.weather[i].main.humidity]
                ]);
            }

            // Set chart options
            var options = {'title':'weather in 5 days Zwolle',
                'width':1400,
                'height':400
            };

            // Instantiate and draw our chart, passing in some options.
            var Linechart = new google.visualization.LineChart(document.getElementById('chart_div_lines'));
            var SteppedAreaChart = new google.visualization.SteppedAreaChart(document.getElementById('chart_div'));
            Linechart.draw(data, options);
            SteppedAreaChart.draw(data, options);
        }


    });
</script>
</body>
</html>
