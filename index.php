
<html>
<head lang="en">
    <meta charset="UTF-8">

    <title>Duo Weather App</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
</head>
<body>
<div id="app">
    <div ng-app="myApp" ng-controller="myCtrl">

        <p ng-repeat="x in myWelcome">{{x}}</p>
<!--        <p>{{ myWelcome['56'].id }}</p>-->

    </div>
</div>
<script>
    let app = angular.module('myApp', []).controller('myCtrl', function($scope, $http) {
        $http.get("http://localhost:8888/cities/", ).then(function (response) {
            $scope.myWelcome = response.data;
            console.log(response.data);
        });
    });
</script>
</body>
</html>
